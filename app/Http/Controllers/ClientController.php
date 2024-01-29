<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function showClients(){
        $clients = User::where('role_id' , 2)->get();
        return $clients;
    }

    public function handleCreateClient(Request $request){

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Client created successfully', 'data' => $user], 201);
    }

    public function handleUpdateClient(Request $request, $user_id){

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'password' => 'string',
        ]);


        $user = User::findOrFail($user_id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Client updated successfully', 'data' => $user], 200);
    }

    public function handleDeleteClient($user_id){
        $user = User::findOrFail($user_id);
        $user->delete();

        return response()->json(['message' => 'Client deleted successfully' ], 200);
    }
}
