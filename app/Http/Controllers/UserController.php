<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHandler;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function Webmozart\Assert\Tests\StaticAnalysis\email;

class UserController extends Controller
{
    /** SEE USER PROFILE */
    public function userProfile(): View|Factory|Application
    {
        return view('admin.user-profile',[
            'user' => auth()->user()
        ]);
    }

    /** INSERT NEW USER */
    public function users(): Factory|Application|View
    {
        $users = User::all();
        $permissions = Permission::all();

        return \view('admin.users', [
            'users' => $users,
            'permissions' => $permissions
        ]);
    }

    public function createUser(): View|Factory|Application
    {
        $permissions = Permission::all();

        return \view('admin.create-user', [
            'permissions' => $permissions
        ]);
    }

    public function storeUser(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'permission_id' => 'required|integer|exists:user_permissions,id'
        ]);

        $path = '';
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
        }

        $hashedPassword = '';
        if ($request->filled('password')) {
            $hashedPassword = Hash::make($request->password);
        }

        $normalizedData = $this->normalizeData($request->only('name', 'email', 'bio', 'avatar', 'permission_id'));

        $created = User::create([
            'name' => $normalizedData['name'],
            'email' => $normalizedData['email'],
            'bio' => $normalizedData['bio'],
            'avatar' => $path,
            'password' => $hashedPassword ?? Hash::make(config('app.default_user_password')),
            'permission_id' => $normalizedData['permission_id'],
        ]);

        if (!$created) {
            return back()->withErrors(['error' => 'user not created'])->withInput();
        }

        return redirect()->route('admin.users')->with('success', 'User created!');
    }

    public function deleteUser(Request $request): JsonResponse
    {
        try {
            User::destroy($request->id);
            return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete the user.'], 500);
        }
    }

    public function updatePermissions(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission_id' => 'required|exists:user_permissions,id',
        ]);

        $user = User::findOrFail($request->input('user_id'));

        $user->permission_id = $request->input('permission_id');
        $user->save();

        return redirect()->back()->with('success', 'Permissions updated successfully!');
    }

    public function editUser(Request $request): View|Factory|Application
    {
        $permissions = Permission::all();
        $user = User::find($request->id);

        return view('admin.edit-user-profile', [
            'user' => $user,
            'permissions' => $permissions
        ]);
    }

    public function updateUser(Request $request): RedirectResponse
    {
        $user = User::find($request->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'permission_id' => 'required|integer|exists:user_permissions,id',
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

        $sanitizedData = $this->normalizeData($request->only('name', 'email', 'bio', 'permission_id'));

        $user->update($sanitizedData);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        try {
            $user = User::find($request->id);
            if ($user) {
                $user->password = Hash::make(config('app.default_user_password'));
                $user->save();
            }
            return redirect()->route('admin.users')->with('success', 'Password reset successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', 'Failed to reset the password.');
        }
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'bio' => 'nullable|string|max:1000',
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

        $sanitizedData = $this->normalizeData($request->only('name', 'email', 'bio'));

        $user->update($sanitizedData);

        return back()->with('success', 'Profile updated successfully');
    }

    private function normalizeData(array $data): array
    {
        $normalized = [
            'name' => htmlspecialchars($data['name']),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'bio' => htmlspecialchars($data['bio'])
        ];

        if (isset($data['permission_id'])) {
            $normalized['permission_id'] = GeneralHandler::onlyNumbers($data['permission_id']);
        }

        if (isset($data['new_password'])) {
            $normalized['new_password'] = $data['new_password'];
        }

        if (isset($data['new_password_confirmation'])) {
            $normalized['new_password_confirmation'] = $data['new_password_confirmation'];
        }

        return $normalized;
    }
}
