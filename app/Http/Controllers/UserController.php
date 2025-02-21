<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class UserController extends Controller
{
    public function userProfile(): View|Factory|Application
    {
        return view('admin.user-profile',[
            'user' => auth()->user()
        ]);
    }

    public function updateProfile(Request $request)
    {
//        dd($request->all());
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'new_password' => 'nullable|confirmed|min:8',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->update($request->only('name', 'email', 'bio'));

        return back()->with('success', 'Profile updated successfully');
    }

    private function normalizeData(array $data): array
    {
        $normalized = [
            'name' => htmlspecialchars($data['name']),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'bio' => htmlspecialchars($data['bio']),
        ];

        if (isset($data['new_password'])) {
            $normalized['new_password'] = $data['new_password'];
        }

        if (isset($data['new_password_confirmation'])) {
            $normalized['new_password_confirmation'] = $data['new_password_confirmation'];
        }

        return $normalized;
    }
}
