<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shortlink;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ShortlinkController extends AdminBaseController
{
    protected string $model = Shortlink::class;

    protected string $viewPrefix = 'admin.shortlink';

    protected string $routeName = 'admin.shortlink';

    protected string $label = 'Shortlink';

    public function index()
    {
        $items = Shortlink::query()->withCount('qrcodes')->latest()->get();

        return view($this->viewPrefix.'.index', $this->viewData([
            'items' => $items,
            'baseUrl' => Shortlink::baseUrl(),
        ]));
    }

    public function create()
    {
        return view($this->viewPrefix.'.create', $this->viewData([
            'baseUrl' => Shortlink::baseUrl(),
        ]));
    }

    public function store(Request $request)
    {
        $data = $this->validateShortlink($request);
        $data['kode'] = $data['kode'] ?? Shortlink::generateKode();
        $data['created_by'] = $request->user()->id;

        Shortlink::create($data);

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' added successfully');
    }

    public function edit($id)
    {
        $item = Shortlink::query()->withCount('qrcodes')->findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData([
            'item' => $item,
            'baseUrl' => Shortlink::baseUrl(),
        ]));
    }

    public function update(Request $request, $id)
    {
        $item = Shortlink::query()->findOrFail($id);

        $item->update($this->validateShortlink($request, $item));

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' updated successfully');
    }

    public function destroy($id)
    {
        $item = Shortlink::query()->withCount('qrcodes')->findOrFail($id);

        if ($item->qrcodes_count > 0) {
            return redirect()->route($this->routeName.'.index')
                ->with('error', "Shortlink \"{$item->kode}\" is still used by {$item->qrcodes_count} QR code(s). Change or delete those QR codes first.");
        }

        $item->delete();

        return redirect()->route($this->routeName.'.index')
            ->with('success', $this->label.' deleted successfully');
    }

    protected function validateShortlink(Request $request, ?Shortlink $item = null): array
    {
        $kode = Shortlink::normalizeKode($request->input('kode'));
        $request->merge(['kode' => $kode === '' ? null : $kode]);

        $validated = $request->validate([
            // Kode kosong saat create = dibuatkan otomatis.
            'kode' => [
                $item ? 'required' : 'nullable',
                'string',
                'min:3',
                'max:50',
                'regex:'.Shortlink::KODE_PATTERN,
                Rule::notIn((array) config('shortlink.reserved', [])),
                Rule::unique('shortlink', 'kode')->ignore($item?->id),
            ],
            'url_tujuan' => [
                'required',
                'string',
                'max:2048',
                'url:http,https',
                $this->notPointingToShortlink($request->input('kode')),
            ],
            'judul' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
        ], [
            'kode.regex' => 'The code may only contain lowercase letters, numbers, and single hyphens between words.',
            'kode.not_in' => 'This code is reserved by a landing page route. Please choose another code.',
            'kode.unique' => 'This code is already in use by another shortlink.',
        ], [
            'kode' => 'code',
            'url_tujuan' => 'destination URL',
            'judul' => 'title',
        ]);

        $validated['status'] = $request->boolean('status');

        return $validated;
    }

    /**
     * Cegah tujuan yang menunjuk ke shortlink lain di domain yang sama
     * (rantai/loop redirect).
     */
    protected function notPointingToShortlink(?string $currentKode): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail) use ($currentKode) {
            $baseHost = parse_url(Shortlink::baseUrl(), PHP_URL_HOST);
            $destHost = parse_url((string) $value, PHP_URL_HOST);

            if (! $baseHost || ! $destHost || strcasecmp($baseHost, $destHost) !== 0) {
                return;
            }

            $path = Str::lower(trim((string) parse_url((string) $value, PHP_URL_PATH), '/'));

            if ($path !== '' && ($path === $currentKode || Shortlink::query()->where('kode', $path)->exists())) {
                $fail('The destination URL cannot point to a shortlink.');
            }
        };
    }
}
