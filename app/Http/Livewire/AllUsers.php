<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AllUsers extends Component
{
    public $users;

    public function render()
    {
        return view('livewire.all-users');
    }

    public function deactivateUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->is_active = 0;
            $user->save();
            return redirect()->to('/dashboard');
        } 
    }

    public function activateUser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->is_active = 1;
            $user->save();
            return redirect()->to('/dashboard');
        } 
    }

}
