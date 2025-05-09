<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        $users=User::where('role', 2)->paginate(10);

        return view('livewire.users.users',compact('users'));
    }
}
