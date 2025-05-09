<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Loginpage extends Component
{
    public function render()
    {
        return view('livewire.pages.login')->layout('layouts.custom-app'); // Ensure this file exists
    }
}
