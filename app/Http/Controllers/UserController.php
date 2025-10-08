<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'rfc' => 'nullable|string|max:14',
            'curp' => 'nullable|string|max:22',
            'sexo' => 'nullable|in:f,m',
            'nivel' => 'nullable|integer|min:1|max:7',
            'puesto' => 'nullable|string|max:70',
            'estatus' => 'nullable|boolean',
            'theme' => 'nullable|in:dark,light',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['estatus'] = $validated['estatus'] ?? false;
        $validated['nivel'] = $validated['nivel'] ?? 7;
        $validated['theme'] = $validated['theme'] ?? 'dark';

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'rfc' => 'nullable|string|max:14',
            'curp' => 'nullable|string|max:22',
            'sexo' => 'nullable|in:f,m',
            'nivel' => 'nullable|integer|min:1|max:7',
            'puesto' => 'nullable|string|max:70',
            'estatus' => 'nullable|boolean',
            'theme' => 'nullable|in:dark,light',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
