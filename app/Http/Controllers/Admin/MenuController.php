<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bahasa;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends AdminBaseController
{
    protected string $model = Menu::class;

    protected string $viewPrefix = 'admin.menu';

    protected string $routeName = 'admin.menu';

    protected string $label = 'Menu';

    protected array $validationRules = [
        'url' => 'nullable|string|max:255',
        'urutan' => 'nullable|integer',
        'status' => 'boolean',
    ];

    protected array $translatableRules = [
        'nama' => 'required|string|max:100',
    ];

    protected function extraData(Request $request, bool $creating): array
    {
        if (! $creating) {
            return [];
        }

        $defaultKode = Bahasa::defaultKode();

        return ['slug' => Str::slug($request->input("translations.$defaultKode.nama", '')).'-'.time()];
    }
}
