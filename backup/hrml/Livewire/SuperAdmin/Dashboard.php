<?php

namespace App\Http\Livewire\SuperAdmin;

use Livewire\Component;

class Dashboard extends Component
{
    public $message = 'Welcome to the SuperAdmin Dashboard!';

    public function render()
    {
        return view('livewire.super-admin.dashboard');
    }
}
