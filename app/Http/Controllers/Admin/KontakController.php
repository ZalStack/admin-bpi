<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends AdminBaseController
{
    protected string $model = Kontak::class;

    protected string $viewPrefix = 'admin.kontak';

    protected string $routeName = 'admin.kontak';

    protected string $label = 'Contact';

    protected string $indexOrderColumn = 'id';

    protected array $validationRules = [
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'status' => 'boolean',
        'social_media' => 'nullable|array',
        'email' => 'nullable|array',
        'phone' => 'nullable|array',
    ];

    protected array $translatableRules = [
        'judul' => 'required|string|max:255',
    ];

    public function index()
    {
        $items = $this->model::query()
            ->with(['social_media', 'email', 'phone', 'translations'])
            ->orderBy($this->indexOrderColumn, $this->indexOrderDirection)
            ->get();

        return view($this->viewPrefix.'.index', $this->viewData(['items' => $items]));
    }

    public function create()
    {
        return view($this->viewPrefix.'.create', $this->viewData());
    }

    public function edit($id)
    {
        $item = $this->model::query()
            ->with([
                'social_media' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'email' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'phone' => fn ($q) => $q->orderBy('urutan', 'asc'),
                'translations',
            ])
            ->findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData(['item' => $item]));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, true),
            $this->uploadedImage($request)
        ));

        if ($this->usesTranslations()) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        $this->syncKontakRelations($item, $request);

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' added successfully');
    }

    public function update(Request $request, $id)
    {
        $item = $this->model::query()->findOrFail($id);

        $validated = $request->validate($this->buildValidationRules(true));

        $item->update(array_merge(
            $this->neutralData($validated, $request),
            $this->extraData($request, false),
            $this->uploadedImage($request, $item)
        ));

        if ($this->usesTranslations() && $request->has('translations')) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        $this->syncKontakRelations($item, $request);

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' updated successfully');
    }

    protected function syncKontakRelations(Kontak $item, Request $request): void
    {
        // 1. Sync Social Media
        $item->social_media()->delete();
        $socialMediaItems = (array) $request->input('social_media', []);
        $urutanSm = 1;
        foreach ($socialMediaItems as $sm) {
            if (! empty($sm['platform']) && ! empty($sm['username'])) {
                $url = trim($sm['url'] ?? '');
                if (empty($url)) {
                    $cleanUser = ltrim($sm['username'], '@');
                    $platform = strtolower($sm['platform']);
                    if ($platform === 'instagram') {
                        $url = "https://instagram.com/{$cleanUser}";
                    } elseif ($platform === 'youtube') {
                        $url = "https://youtube.com/@{$cleanUser}";
                    } elseif ($platform === 'facebook') {
                        $url = "https://facebook.com/{$cleanUser}";
                    } elseif ($platform === 'linkedin') {
                        $url = "https://linkedin.com/company/{$cleanUser}";
                    } elseif ($platform === 'tiktok') {
                        $url = "https://tiktok.com/@{$cleanUser}";
                    } elseif ($platform === 'twitter' || $platform === 'x') {
                        $url = "https://x.com/{$cleanUser}";
                    }
                }

                $item->social_media()->create([
                    'platform' => strtolower($sm['platform']),
                    'username' => $sm['username'],
                    'url' => $url ?: $sm['username'],
                    'urutan' => $sm['urutan'] ?? $urutanSm++,
                    'status' => true,
                ]);
            }
        }

        // 2. Sync Email
        $item->email()->delete();
        $emailItems = (array) $request->input('email', []);
        $urutanEmail = 1;
        foreach ($emailItems as $em) {
            if (! empty($em['email'])) {
                $url = trim($em['url'] ?? '');
                if (empty($url)) {
                    $url = "mailto:{$em['email']}";
                }

                $item->email()->create([
                    'email' => $em['email'],
                    'description' => $em['description'] ?? null,
                    'url' => $url,
                    'urutan' => $em['urutan'] ?? $urutanEmail++,
                    'status' => true,
                ]);
            }
        }

        // 3. Sync Phone
        $item->phone()->delete();
        $phoneItems = (array) $request->input('phone', []);
        $urutanPhone = 1;
        foreach ($phoneItems as $ph) {
            if (! empty($ph['number'])) {
                $type = strtolower($ph['type'] ?? 'whatsapp');
                $url = trim($ph['url'] ?? '');
                if (empty($url)) {
                    $cleanNum = preg_replace('/[^0-9]/', '', $ph['number']);
                    if (str_starts_with($cleanNum, '0')) {
                        $cleanNum = '62' . substr($cleanNum, 1);
                    }
                    if ($type === 'whatsapp') {
                        $url = "https://wa.me/{$cleanNum}";
                    } else {
                        $url = "tel:{$ph['number']}";
                    }
                }

                $item->phone()->create([
                    'number' => $ph['number'],
                    'type' => $type,
                    'url' => $url,
                    'urutan' => $ph['urutan'] ?? $urutanPhone++,
                    'status' => true,
                ]);
            }
        }
    }
}
