<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.profile.show')
            ->with('success', 'Password updated successfully.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        try {
            // Delete old avatar if exists
            if ($user->avatar) {
                $this->deleteAvatarFile($user->avatar);
            }

            // Get the uploaded file
            $file = $request->file('avatar');

            // Generate unique filename
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Store the file using storeAs for more control
            $path = $file->storeAs('avatars', $filename, 'public');

            // Verify the file was actually stored
            if (!Storage::disk('public')->exists($path)) {
                throw new \Exception('File was not stored successfully.');
            }

            // Update user record
            $user->update(['avatar' => $path]);

            return redirect()->route('admin.profile.show')
                ->with('success', 'Avatar updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.profile.show')
                ->with('error', 'Failed to update avatar: ' . $e->getMessage());
        }
    }

    public function clearAvatar(Request $request)
    {
        $user = Auth::user();

        try {
            if ($user->avatar) {
                $this->deleteAvatarFile($user->avatar);
            }

            $user->update(['avatar' => null]);

            return redirect()->route('admin.profile.show')
                ->with('success', 'Avatar cleared successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.profile.show')
                ->with('error', 'Failed to clear avatar: ' . $e->getMessage());
        }
    }

    /**
     * Helper method to delete avatar file
     */
    private function deleteAvatarFile($avatarPath)
    {
        if (Storage::disk('public')->exists($avatarPath)) {
            Storage::disk('public')->delete($avatarPath);
        }
    }

    /**
     * Manual file upload method - alternative approach
     */
    public function updateAvatarManual(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        try {
            // Delete old avatar
            if ($user->avatar) {
                $this->deleteAvatarFile($user->avatar);
            }

            $file = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Manual file handling - more explicit
            $avatarsPath = storage_path('app/public/avatars');

            // Ensure directory exists
            if (!file_exists($avatarsPath)) {
                mkdir($avatarsPath, 0755, true);
            }

            // Move file manually
            $file->move($avatarsPath, $filename);

            $path = 'avatars/' . $filename;

            // Verify file was moved
            if (!file_exists($avatarsPath . '/' . $filename)) {
                throw new \Exception('File move failed.');
            }

            $user->update(['avatar' => $path]);

            return redirect()->route('admin.profile.show')
                ->with('success', 'Avatar updated successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.profile.show')
                ->with('error', 'Failed to update avatar: ' . $e->getMessage());
        }
    }
}
