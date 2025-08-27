<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            $this->addError('email', 'The provided credentials do not match our records.');
        }
    }

    // public function render()
    // {
    //     return view('livewire.login')
    //     ->layout('layouts.custom-app1');
    // }

    public function render()
    {
        return view('livewire.admin-login')
        ->layout('layouts.custom-app1');
    }
}