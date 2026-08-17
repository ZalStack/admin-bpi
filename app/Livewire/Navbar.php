<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Navbar extends Component
{
    public $currentLocale;

    public function mount()
    {
        $this->currentLocale = Session::get('locale', App::getLocale());
    }

    public function switchLanguage($locale)
    {
        if (in_array($locale, ['id', 'en'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
            $this->currentLocale = $locale;
            return redirect()->route('dashboard');
        }
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
