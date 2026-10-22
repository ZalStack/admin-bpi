<?php

namespace App\Http\Controllers\Admin;

use App\Models\Qrcode;
use App\Models\Shortlink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class QrcodeController extends AdminBaseController
{
    protected string $model = Qrcode::class;

    protected string $viewPrefix = 'admin.qrcode';

    protected string $routeName = 'admin.qrcode';

    protected string $label = 'QR Code';

    protected ?string $imageField = 'logo';

    protected ?string $imagePath = 'qrcode';

    public function index()
    {
        $items = Qrcode::query()->with('shortlink')->latest()->get();

        return view($this->viewPrefix.'.index', $this->viewData(['items' => $items]));
    }

    public function create()
    {
        // ?shortlink={id} dari tombol "Customize" di daftar Shortlink.
        return view($this->viewPrefix.'.create', $this->viewData([
            'shortlinks' => $this->shortlinkOptions(),
            'selectedShortlink' => request()->integer('shortlink') ?: null,
        ]));
    }

    public function store(Request $request)
    {
        $data = $this->validateQrcode($request);
        $data['created_by'] = $request->user()->id;

        if ($data['logo_mode'] === 'upload') {
            $data = array_merge($data, $this->uploadedImage($request));
        }

        Qrcode::create($data);

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' added successfully');
    }

    public function edit($id)
    {
        $item = Qrcode::query()->with('shortlink')->findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData([
            'item' => $item,
            'shortlinks' => $this->shortlinkOptions(),
        ]));
    }

    public function update(Request $request, $id)
    {
        $item = Qrcode::query()->findOrFail($id);
        $data = $this->validateQrcode($request, $item);

        if ($data['logo_mode'] === 'upload') {
            $data = array_merge($data, $this->uploadedImage($request, $item));
        } elseif ($item->logo) {
            // Logo unggahan tidak dipakai lagi: buang filenya.
            Storage::disk('public')->delete($this->imagePath.'/'.$item->logo);
            $data['logo'] = null;
        }

        $item->update($data);

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' updated successfully');
    }

    protected function validateQrcode(Request $request, ?Qrcode $item = null): array
    {
        $hex = ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'];

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'sumber' => ['required', Rule::in(['shortlink', 'url'])],
            'shortlink_id' => ['nullable', 'required_if:sumber,shortlink', 'integer', Rule::exists('shortlink', 'id')],
            'url_tujuan' => ['nullable', 'required_if:sumber,url', 'string', 'max:2048', 'url:http,https'],
            'warna_depan' => $hex,
            'warna_latar' => $hex,
            'logo_mode' => ['required', Rule::in(Qrcode::LOGO_MODES)],
            'logo' => [
                Rule::requiredIf(fn () => $request->input('logo_mode') === 'upload' && ! $item?->logo),
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:1024',
            ],
            'caption' => ['nullable', 'string', 'max:60'],
        ], [
            'shortlink_id.required_if' => 'Please select a shortlink.',
            'url_tujuan.required_if' => 'Please fill in the destination URL.',
            'logo.required' => 'Please upload a logo image, or choose another logo option.',
        ], [
            'judul' => 'title',
            'sumber' => 'QR source',
            'shortlink_id' => 'shortlink',
            'url_tujuan' => 'destination URL',
            'warna_depan' => 'foreground color',
            'warna_latar' => 'background color',
        ]);

        $fromShortlink = $validated['sumber'] === 'shortlink';

        return [
            'judul' => $validated['judul'],
            'shortlink_id' => $fromShortlink ? (int) $validated['shortlink_id'] : null,
            'url_tujuan' => $fromShortlink ? null : $validated['url_tujuan'],
            'warna_depan' => strtoupper($validated['warna_depan']),
            'warna_latar' => strtoupper($validated['warna_latar']),
            'logo_mode' => $validated['logo_mode'],
            'caption' => $validated['caption'] ?? null,
        ];
    }

    /**
     * Opsi dropdown shortlink untuk form + data pratinjau QR di browser.
     */
    protected function shortlinkOptions(): array
    {
        return Shortlink::query()
            ->orderBy('kode')
            ->get(['id', 'kode', 'judul', 'url_tujuan', 'status'])
            ->map(fn (Shortlink $s) => [
                'id' => $s->id,
                'kode' => $s->kode,
                'judul' => $s->judul,
                'url_tujuan' => $s->url_tujuan,
                'status' => $s->status,
                'short_url' => $s->short_url,
            ])
            ->all();
    }
}
