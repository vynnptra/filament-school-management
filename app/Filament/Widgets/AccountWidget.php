<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AccountWidget extends Widget
{
    protected static string $view = 'filament.widgets.account-widget';

    public $localEn;
    public $localId;

    public function mount()
    {
        $locals = App::getLocale();
        if ($locals == 'id') {
            $this->localEn = 'id';
        } else {
            $this->localId = 'en';
        }

    }

    public function switchLocale ($locale)
    {
        if ($locale == 'id') {
           $this->localEn ='';
        } else {
            $this->localId = '';
        }

        $validLocals = ['en', 'id'];
        if (in_array($locale, $validLocals)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }
    }
}
