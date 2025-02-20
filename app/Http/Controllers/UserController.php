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
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class UserController extends Controller
{
    public function userProfile(): View|Factory|Application
    {
        return view('admin.user-profile',[
            'user' => auth()->user()
        ]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $data = $this->normalizeData($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'bio' => 'nullable|string|max:1000',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->bio = $data['bio'];

        if (!empty($data['new_password'])) {
            $user->password = Hash::make($data['new_password']);
        }

        $user->save();

        return redirect()
            ->route('admin.user-profile', [auth()->id()])
            ->with('success', 'Profile updated successfully!');
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
