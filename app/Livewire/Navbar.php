<?php

namespace App\Livewire;

use App\Models\Bahasa;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Navbar extends Component
{
    public $currentLocale;

    public $languages;

    public function mount()
    {
        $this->currentLocale = Session::get('locale', Bahasa::defaultKode());
        $this->languages = Bahasa::activeLanguages();
    }

    public function switchLanguage($locale)
    {
        if (Bahasa::query()->where('kode', $locale)->where('aktif', true)->exists()) {
            Session::put('locale', $locale);
            $this->currentLocale = $locale;

            return redirect()->route('dashboard');
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
