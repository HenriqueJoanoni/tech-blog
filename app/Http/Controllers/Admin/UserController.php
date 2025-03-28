<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHandler;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use App\Services\HtmlPurifier;
use App\Services\HtmlPurifierService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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

    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'bio' => 'nullable|string|max:1000',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'permission_id' => 'required|integer|exists:user_permissions,id',
                'password' => 'nullable|string|min:8'
            ]);

            $path = null;
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
            }

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'bio' => $request->bio,
                'avatar' => $path,
                'permission_id' => $request->permission_id,
                'password' => $request->password ? Hash::make($request->password) : Hash::make(config('app.default_user_password')),
            ];

            User::create($userData);

            return $request->ajax()
                ? response()->json([
                    'success' => true,
                    'message' => 'User created successfully',
                    'redirect' => route('admin.users')
                ])
                : redirect()->route('admin.users')->with('success', 'User created!');

        } catch (ValidationException $e) {
            return $request->ajax()
                ? response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $e->errors()
                ], 422)
                : redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            return $request->ajax()
                ? response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 500)
                : redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
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

    public function updateUser(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'bio' => 'nullable|string|max:1000',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'permission_id' => 'required|integer|exists:user_permissions,id',
                'new_password' => 'nullable|confirmed|min:8',
            ]);

            $updateData = $this->normalizeData($request->only('name', 'email', 'bio', 'permission_id'));

            if ($request->hasFile('avatar')) {
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $updateData['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }

            if ($request->filled('new_password')) {
                $updateData['password'] = Hash::make($request->new_password);
            }

            $user->update($updateData);

            return $request->ajax()
                ? response()->json([
                    'success' => true,
                    'message' => 'User updated successfully',
                    'redirect' => route('admin.users')
                ])
                : redirect()->route('admin.users')->with('success', 'User updated successfully');

        } catch (ValidationException $e) {
            return $request->ajax()
                ? response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $e->errors()
                ], 422)
                : redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            return $request->ajax()
                ? response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 500)
                : redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
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
        $purifier = HtmlPurifierService::getInstance();
        $normalized = [
            'name' => htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'bio' => $purifier->purify($data['bio']),
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
