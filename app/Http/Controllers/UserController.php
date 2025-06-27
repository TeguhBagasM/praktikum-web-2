<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);
        return view('users.index', compact('users'));
    }
    public function create() {
        return view('users.create');
    }

    public function store()  {
        $validatedData = request()->validate([
            'name' => 'required|max:100',
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        User::create($validatedData);
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }

}
