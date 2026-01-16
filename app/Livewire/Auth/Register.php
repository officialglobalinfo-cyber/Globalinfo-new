<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rules\Password;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
        ];
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            // Default role is usually handled by db default or unset means 'user'
            // Assuming no role_id means normal user for now as we haven't strictly defined roles table seeding for 'user'
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.auth.register');
    }
}
