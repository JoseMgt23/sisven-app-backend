<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json(['customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_number' => 'required|string|max:15|unique:customers',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'nullable|string|max:80',
            'birthday' => 'nullable|date',
            'phone_number' => 'nullable|string|max:16',
            'email' => 'nullable|string|email|max:100|unique:customers',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $customer = Customer::create($request->all());

        return response()->json(['customer' => $customer], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        return response()->json(['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'document_number' => 'required|string|max:15|unique:customers,document_number,' . $id,
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'address' => 'nullable|string|max:80',
            'birthday' => 'nullable|date',
            'phone_number' => 'nullable|string|max:16',
            'email' => 'nullable|string|email|max:100|unique:customers,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->update($request->all());

        return response()->json(['customer' => $customer]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}