<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('admin.profile', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.auth()->id(),
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->forceFill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ])->save();

        if (! empty($validated['password'])) {
            if (! Hash::check($validated['current_password'] ?? '', $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.'])->withInput();
            }

            $user->forceFill(['password' => Hash::make($validated['password'])])->save();

            return redirect()->route('profile.edit')->with('success', 'Profile dan password berhasil diperbarui.');
        }

        return redirect()->route('profile.edit')->with('success', 'Profile berhasil diperbarui.');
    }
}
