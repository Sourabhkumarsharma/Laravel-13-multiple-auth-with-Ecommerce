<?php 
namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        if (Auth::guard('admin')->attempt([
            'email' => $this->email,
            'password' => $this->password
        ])) {
            return redirect()->route('admin.dashboard');
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
         
        return view('livewire.admin.login');
    }
}