<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiController extends AdminBaseController
{
    protected string $model = StrukturOrganisasi::class;

    protected string $viewPrefix = 'admin.struktur';

    protected string $routeName = 'admin.struktur';

    protected string $label = 'Organizational Structure';

    protected array $validationRules = [
        'nama' => 'required|string|max:255',
        'kategori' => 'required|string|in:pimpinan,dewan,bidang,komite,satgas_pokja',
        'sub_kategori' => 'nullable|string|max:50',
        'departemen' => 'nullable|string|max:255',
        'level' => 'nullable|integer|between:1,4',
        'linkedin' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'telepon' => 'nullable|string|max:50',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'jabatan' => 'required|string|max:255',
        'departemen' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = 'foto';

    protected ?string $imagePath = 'struktur';

    public function store(Request $request)
    {
        $defaultKode = Bahasa::defaultKode();
        if ($request->filled("translations.{$defaultKode}.departemen") && ! $request->filled('departemen')) {
            $request->merge([
                'departemen' => $request->input("translations.{$defaultKode}.departemen"),
            ]);
        }

        return parent::store($request);
    }

    public function update(Request $request, $id)
    {
        $defaultKode = Bahasa::defaultKode();
        if ($request->filled("translations.{$defaultKode}.departemen")) {
            $request->merge([
                'departemen' => $request->input("translations.{$defaultKode}.departemen"),
            ]);
        }

        return parent::update($request, $id);
    }

    public function layoutView()
    {
        $defaultKode = Bahasa::defaultKode();

        // 1. Bidang-bidang (kelompokkan berdasarkan departemen unik, diurutkan menurut urutan terkecil)
        $bidangMembers = StrukturOrganisasi::with('translations')
            ->where('kategori', 'bidang')
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('level', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $bidangDepts = [];
        foreach ($bidangMembers as $m) {
            $transId = $m->translations->firstWhere('bahasa', 'id');
            $transEn = $m->translations->firstWhere('bahasa', 'en');
            $deptNameId = $transId?->departemen ?: $m->departemen ?: 'Bidang Umum';
            $deptNameEn = $transEn?->departemen ?: $deptNameId;
            $deptKey = trim($deptNameId);

            if (!isset($bidangDepts[$deptKey])) {
                $bidangDepts[$deptKey] = [
                    'key' => $deptKey,
                    'name_id' => $deptNameId,
                    'name_en' => $deptNameEn,
                    'urutan' => (int) ($m->urutan ?: 999),
                    'members' => [],
                ];
            } else {
                if ($m->urutan && $m->urutan < $bidangDepts[$deptKey]['urutan']) {
                    $bidangDepts[$deptKey]['urutan'] = (int) $m->urutan;
                }
            }

            $bidangDepts[$deptKey]['members'][] = [
                'id' => $m->id,
                'nama' => $m->nama,
                'jabatan_id' => $transId?->jabatan ?: $m->jabatan,
                'jabatan_en' => $transEn?->jabatan ?: ($transId?->jabatan ?: $m->jabatan),
                'level' => $m->level ?: 3,
                'foto_url' => $m->foto_url,
                'urutan' => $m->urutan,
            ];
        }

        // Urutkan bidang berdasarkan urutan ascending
        uasort($bidangDepts, fn($a, $b) => $a['urutan'] <=> $b['urutan']);
        $bidangList = array_values($bidangDepts);

        // 2. Units (Komite, Pokja, Satgas)
        $unitMembers = StrukturOrganisasi::with('translations')
            ->whereIn('kategori', ['komite', 'satgas_pokja'])
            ->where('status', true)
            ->orderBy('urutan', 'asc')
            ->orderBy('level', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $unitDepts = [];
        foreach ($unitMembers as $m) {
            $transId = $m->translations->firstWhere('bahasa', 'id');
            $transEn = $m->translations->firstWhere('bahasa', 'en');
            $deptNameId = $transId?->departemen ?: $m->departemen ?: $m->nama;
            $deptNameEn = $transEn?->departemen ?: $deptNameId;
            $unitKey = trim($deptNameId);

            if (!isset($unitDepts[$unitKey])) {
                $unitDepts[$unitKey] = [
                    'key' => $unitKey,
                    'name_id' => $deptNameId,
                    'name_en' => $deptNameEn,
                    'kategori' => $m->kategori,
                    'sub_kategori' => $m->sub_kategori ?: ($m->kategori === 'komite' ? 'komite' : 'pokja'),
                    'urutan' => (int) ($m->urutan ?: 999),
                    'members' => [],
                ];
            } else {
                if ($m->urutan && $m->urutan < $unitDepts[$unitKey]['urutan']) {
                    $unitDepts[$unitKey]['urutan'] = (int) $m->urutan;
                }
            }

            $unitDepts[$unitKey]['members'][] = [
                'id' => $m->id,
                'nama' => $m->nama,
                'jabatan_id' => $transId?->jabatan ?: $m->jabatan,
                'jabatan_en' => $transEn?->jabatan ?: ($transId?->jabatan ?: $m->jabatan),
                'level' => $m->level ?: 3,
                'foto_url' => $m->foto_url,
                'urutan' => $m->urutan,
            ];
        }

        uasort($unitDepts, fn($a, $b) => $a['urutan'] <=> $b['urutan']);
        $unitList = array_values($unitDepts);

        return view('admin.struktur.layout', compact('bidangList', 'unitList'));
    }

    public function saveLayoutOrder(Request $request)
    {
        $validated = $request->validate([
            'bidang_orders' => 'nullable|array',
            'bidang_orders.*.key' => 'required|string',
            'bidang_orders.*.urutan' => 'required|integer',
            'unit_orders' => 'nullable|array',
            'unit_orders.*.key' => 'required|string',
            'unit_orders.*.urutan' => 'required|integer',
            'member_orders' => 'nullable|array',
            'member_orders.*.id' => 'required|exists:struktur_organisasi,id',
            'member_orders.*.urutan' => 'required|integer',
        ]);

        DB::transaction(function () use ($validated) {
            // Update urutan bidang
            if (!empty($validated['bidang_orders'])) {
                foreach ($validated['bidang_orders'] as $b) {
                    $deptKey = $b['key'];
                    $urutan = (int) $b['urutan'];

                    // Update root departemen
                    StrukturOrganisasi::where('departemen', $deptKey)
                        ->where('kategori', 'bidang')
                        ->update(['urutan' => $urutan]);

                    // Also match via translation departemen
                    $memberIds = DB::table('struktur_organisasi_translations')
                        ->where('departemen', $deptKey)
                        ->pluck('struktur_organisasi_id');

                    if ($memberIds->isNotEmpty()) {
                        StrukturOrganisasi::whereIn('id', $memberIds)
                            ->where('kategori', 'bidang')
                            ->update(['urutan' => $urutan]);
                    }
                }
            }

            // Update urutan units (komite, pokja, satgas)
            if (!empty($validated['unit_orders'])) {
                foreach ($validated['unit_orders'] as $u) {
                    $unitKey = $u['key'];
                    $urutan = (int) $u['urutan'];

                    StrukturOrganisasi::where('departemen', $unitKey)
                        ->whereIn('kategori', ['komite', 'satgas_pokja'])
                        ->update(['urutan' => $urutan]);

                    $memberIds = DB::table('struktur_organisasi_translations')
                        ->where('departemen', $unitKey)
                        ->pluck('struktur_organisasi_id');

                    if ($memberIds->isNotEmpty()) {
                        StrukturOrganisasi::whereIn('id', $memberIds)
                            ->whereIn('kategori', ['komite', 'satgas_pokja'])
                            ->update(['urutan' => $urutan]);
                    }
                }
            }

            // Update specific member orders if provided
            if (!empty($validated['member_orders'])) {
                foreach ($validated['member_orders'] as $m) {
                    StrukturOrganisasi::where('id', $m['id'])
                        ->update(['urutan' => (int) $m['urutan']]);
                }
            }
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Chart layout order has been successfully saved!',
        ]);
    }
}
