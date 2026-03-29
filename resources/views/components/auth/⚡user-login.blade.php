<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component {

    public string $email = '';
    public string $password = '';

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {

            session()->regenerate();

            return $this->redirectRoute('dashboard', navigate: true);
        }

        $this->addError('email', 'Invalid credentials');
    }
};

?>

<div class="max-w-md mx-auto">
    <form wire:submit="login" class="space-y-4">

        <input type="email" wire:model="email" placeholder="User Email" class="w-full border p-2">

        <input type="password" wire:model="password" placeholder="Password" class="w-full border p-2">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 w-full">
            User Login
        </button>

    </form>
</div>