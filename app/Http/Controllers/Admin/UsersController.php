<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class UsersController extends AdminController
{
    public function index()
    {
        return Inertia::render($this->componentFullPath('Users/Index'), [
            'filters' => Request::all('search', 'role', 'trashed'),
            'users' => User::orderByName()
                ->filter(Request::only('search', 'role', 'trashed'))
                ->get()
                ->transform(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'owner' => $user->owner,
                        'photo' => $user->photoUrl(['w' => 40, 'h' => 40, 'fit' => 'crop']),
                        'deleted_at' => $user->deleted_at,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render($this->componentFullPath('Users/Create'));
    }

    public function store(StoreUserRequest $request)
    {
        User::create(
            array_merge($request->except(['photo']),  ['photo_path' => $request->file('photo') ? $request->file('photo')->store('users') : null])
        );

        return Redirect::route('users')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return Inertia::render($this->componentFullPath('Users/Edit'), [
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'admin' => $user->admin,
                'photo' => $user->photoUrl(['w' => 60, 'h' => 60, 'fit' => 'crop']),
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->only('first_name', 'last_name', 'email', 'owner'));

        if ($request->file('photo')) {
            $user->update(['photo_path' => Request::file('photo')->store('users')]);
        }

        if ($request->get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return Redirect::back()->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::back()->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }
}
