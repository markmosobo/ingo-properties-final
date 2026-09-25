<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TenantDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $hashedPassword = Hash::make($request->default_password);

        $user = User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'role_id'      => $request->role_id,
            'phone_number' => $request->phone_number,
            'password'     => $hashedPassword,
        ]);

        return response()->json([
            'status'  => true,
            'message' => "User Created successfully!",
            'user'    => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'role_id'      => $request->role_id,
        ]);

        return response()->json([
            'status'  => true,
            'message' => "User Updated successfully!",
            'user'    => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status'  => true,
            'message' => "User Deleted successfully!",
        ], 200);
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 1]);

        return response()->json([
            'status'  => true,
            'message' => "User Activated successfully!",
            'user'    => $user
        ], 200);
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => 2]);

        return response()->json([
            'status'  => true,
            'message' => "User Deactivated successfully!",
            'user'    => $user
        ], 200);
    }

    public function single($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'status'  => true,
            'message' => "Success",
            'user'    => $user
        ], 200);
    }

    public function attachDocument(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|exists:users,id',
            'type'        => 'required|string|max:50',
            'file'        => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        $tenant = User::findOrFail($request->tenant_id);

        $file = $request->file('file');

        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

        // ✅ IMPORTANT FIX: store in PUBLIC disk
        $path = $file->storeAs(
            "tenants/{$tenant->id}/documents",
            $filename,
            'public'
        );

        TenantDocument::create([
            'tenant_id' => $tenant->id,
            'type'        => $request->type,
            'file_name'   => $filename,
            'file_path'   => $path,
            'uploaded_by' => auth()->id(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Document uploaded successfully',
            'path'    => $path,
        ]);
    }      
}
