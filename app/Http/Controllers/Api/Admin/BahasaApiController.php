<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\PengaturanBahasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class BahasaApiController extends BaseApiController
{
    protected $model = PengaturanBahasa::class;

    public function getSettings()
    {
        $settings = PengaturanBahasa::first();

        if (!$settings) {
            return $this->successResponse([
                'bahasa_default' => 'id',
                'bahasa_tersedia' => 'id,en',
                'status' => true
            ]);
        }

        return $this->successResponse($settings);
    }

    public function updateSettings(Request $request)
    {
        $validator = validator($request->all(), [
            'bahasa_default' => 'required|in:id,en',
            'bahasa_tersedia' => 'required|string',
            'status' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        $settings = PengaturanBahasa::first();

        if (!$settings) {
            $settings = new PengaturanBahasa();
        }

        $settings->bahasa_default = $request->bahasa_default;
        $settings->bahasa_tersedia = $request->bahasa_tersedia;
        $settings->status = $request->status ?? true;
        $settings->save();

        Session::put('locale', $request->bahasa_default);
        App::setLocale($request->bahasa_default);

        return $this->successResponse($settings, 'Language settings updated successfully');
    }

    public function switchLanguage($locale)
    {
        if (!in_array($locale, ['id', 'en'])) {
            return $this->errorResponse('Invalid language', 400);
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        return $this->successResponse([
            'locale' => $locale,
            'message' => 'Language switched successfully'
        ]);
    }

    public function getAvailableLanguages()
    {
        $settings = PengaturanBahasa::first();

        $available = ['id' => 'Indonesian', 'en' => 'English'];

        if ($settings && $settings->bahasa_tersedia) {
            $enabled = array_map('trim', explode(',', $settings->bahasa_tersedia));
            $available = array_filter($available, function ($key) use ($enabled) {
                return in_array($key, $enabled);
            }, ARRAY_FILTER_USE_KEY);
        }

        return $this->successResponse($available);
    }
}
