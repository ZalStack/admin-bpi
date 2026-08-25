<?php

namespace App\Http\Controllers\Admin;

use App\Models\Berita;
use App\Models\BeritaGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaGaleriController extends AdminBaseController
{
    protected string $model = BeritaGaleri::class;

    protected string $viewPrefix = 'admin.berita.galeri';

    protected string $routeName = 'admin.berita.galeri';

    protected string $label = 'Galeri berita';

    protected array $validationRules = [
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $updateValidationRules = [
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'judul' => 'nullable|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    protected ?string $imageField = 'gambar';

    protected ?string $imagePath = 'berita/galeri';

    public function index($berita_id = null)
    {
        $berita = Berita::findOrFail($berita_id);
        $items = BeritaGaleri::where('berita_id', $berita_id)->orderBy('urutan')->get();

        return view($this->viewPrefix.'.index', $this->viewData(['berita' => $berita, 'items' => $items]));
    }

    public function create($berita_id = null)
    {
        $berita = Berita::findOrFail($berita_id);

        return view($this->viewPrefix.'.create', $this->viewData(['berita' => $berita]));
    }

    public function store(Request $request, $berita_id = null)
    {
        $validated = $request->validate($this->buildValidationRules(false));

        $item = $this->model::create(array_merge(
            ['berita_id' => $berita_id],
            $this->neutralData($validated, $request),
            $this->uploadedImage($request)
        ));

        if ($this->usesTranslations()) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        return redirect()->route($this->routeName.'.index', $berita_id)
            ->with('success', $this->label.' berhasil ditambahkan');
    }

    public function edit($berita_id = null, $id = null)
    {
        $berita = Berita::findOrFail($berita_id);
        $item = BeritaGaleri::findOrFail($id);

        return view($this->viewPrefix.'.edit', $this->viewData(['berita' => $berita, 'galeri' => $item]));
    }

    public function update(Request $request, $berita_id = null, $id = null)
    {
        $item = BeritaGaleri::findOrFail($id);

        $validated = $request->validate($this->buildValidationRules(true));

        $item->update(array_merge(
            $this->neutralData($validated, $request),
            $this->uploadedImage($request, $item)
        ));

        if ($this->usesTranslations() && $request->has('translations')) {
            $item->storeTranslations((array) $request->input('translations', []));
        }

        return redirect()->route($this->routeName.'.index', $berita_id)
            ->with('success', $this->label.' berhasil diupdate');
    }

    public function destroy($berita_id = null, $id = null)
    {
        $item = BeritaGaleri::findOrFail($id);

        if ($item->gambar) {
            Storage::disk('public')->delete($this->imagePath.'/'.$item->gambar);
        }

        $item->delete();

        return redirect()->route($this->routeName.'.index', $berita_id)
            ->with('success', $this->label.' berhasil dihapus');
    }
}
