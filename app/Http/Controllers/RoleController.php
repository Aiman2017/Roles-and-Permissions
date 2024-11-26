<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Exception as ExceptionAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {

       if ( Gate::denies('roles.view')) {
           return redirect()->route('dashboard');
       };
        return view('backend.roles.index', [
            'roles' => Role::query()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        if (Gate::denies('roles.create')) {
            return redirect()->route('admin.roles.index');
        };
        return view('backend.roles.create',
        );
    }

    /**
     * Store a newly created resource in storage.
     * @throws ExceptionAlias
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        if (Gate::denies('roles.create')) {
            return redirect()->route('admin.roles.index');
        };
        Role::createWithRoleAbilities($request);

        return redirect()->route('admin.roles.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::query()->findOrFail($id);
        return view('backend.roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::query()->findOrFail($id);
        $role->update($request->validated());
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index');
    }
}
