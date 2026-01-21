<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller 
{
    /**
     * Define a middleware for the controller.
     */
    public static function Middleware(): array
    {
        return [
            new Middleware('permission:role:Role Management'),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = Role::withCount('permissions')->get();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permissions = Permission::all()->groupBy('group');
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions' => ['required', 'array'],
        ]);

        $role = Role::create([
            'name' => $request->role,
            'guard_name' => 'admin',
        ]);
        $role->syncPermissions($request->permissions);

        AlertService::created();

        return to_route('admin.kyc.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy('group');
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if ($role->name === 'Super Admin') {
            AlertService::error('You can not update Super Admin role.');
            return to_route('admin.role.index');
        }

        $request->validate([
            'role' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'permissions' => ['required', 'array'],
        ]);

        $role->update(['name' => $request->role]);
        $role->syncPermissions($request->permissions);

        AlertService::updated();

        return to_route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->name === 'Super Admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'You can not delete Super Admin role.'
            ]);
        }

        try {
            DB::beginTransaction();
            // Remove role user
            $role->users()->detach();

            // detatch permissoins from role
            $role->permissions()->detach();
            $role->delete();

            DB::commit();

            AlertService::deleted();

            return response()->json(['status' => 'success', 'message' => 'Deleted Successfully']);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Role Delete Error: ', $th);

            return response()->json(
                [
                    'status' => 'error',
                    'message' => $th->getMessage()
                ],
                500
            );
        }
    }
}
