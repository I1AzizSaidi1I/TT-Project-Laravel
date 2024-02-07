<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function showClients(){
        $clients = User::where('role_id' , 2)->where('status', 1)->get();
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
        $user->update(['status' => 0]);

        return response()->json(['message' => 'Client deleted successfully' ], 200);
    }

    public function showInvoices($clientId)
    {
        // Fetch the client based on the provided client ID and role_id = 3
        $client = User::where('id', $clientId)
                      ->where('role_id', 3)
                      ->firstOrFail();

        // Fetch only the invoices associated with the client
        $clientInvoices = $client->invoices;

        return view('invoices.index', compact('clientInvoices'));
    }

    public function showCalls($clientId){
        return response()->json(Call::where('user_id', $clientId)->get(), 200);
    }

    public function handleSaveCall(Request $request){
        $data = $request->validate([
            'user_id' => 'required',
            'status' => 'required',
            'date' => 'required',
            'comment' => 'nullable|string',
        ]);


        $client = User::findOrFail($data['user_id']);

        $call = new Call();
        $call->user_id = $client->id;
        $call->status = $data['status'];
        $call->date = Carbon::parse($data['date']);
        $call->comment = $data['comment'];
        $call->save();

        return response()->json(['message' => 'Call saved successfully'], 201);
    }


}
