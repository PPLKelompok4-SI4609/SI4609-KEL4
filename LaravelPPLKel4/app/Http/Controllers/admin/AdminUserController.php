<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'user') {
            return back()->with('error', 'Anda tidak dapat menghapus akun ini.');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}