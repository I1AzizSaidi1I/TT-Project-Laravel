<?php

namespace App\Http\Controllers;

use App\Mail\ClientInvoiceMail;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{

    static function generateInvoices(){
        $clients = User::where('role_id', 2)->get();
        foreach($clients as $client){
            try{
                Mail::to($client->mail)->send( new ClientInvoiceMail($client));
            } catch(\Exception $e){
                error_log($e->getMessage());
            }
        }

    }

    // Get invoices for a specific client
    public function getClientInvoices($clientId)
    {

        $client = User::findOrFail($clientId);
        $clientInvoices = $client->invoices;

        return response()->json($clientInvoices);
    }




    // Create a new invoice
    public function create(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'end_time' => 'nullable|date',
        ]);

        // Create the new invoice
        $invoice = Invoice::create([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'end_time' => $request->end_time,
        ]);

        return response()->json($invoice, 201);
    }

    // Get a specific invoice by ID
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return response()->json($invoice);
    }

    // Update an existing invoice
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'total_amount' => 'numeric',
            'paid_amount' => 'numeric',
            'end_time' => 'nullable|date',
        ]);

        // Find the invoice
        $invoice = Invoice::findOrFail($id);

        // Update the invoice
        $invoice->update($request->all());

        return response()->json($invoice, 200);
    }

    // Delete an existing invoice
    public function delete($id)
    {
        // Find the invoice
        $invoice = Invoice::findOrFail($id);

        // Delete the invoice
        $invoice->delete();

        return response()->json(null, 204);
    }
}
