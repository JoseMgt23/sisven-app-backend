<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Paymode;


class PayModeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymodes = Paymode::all();
        return response()->json(['paymodes' => $paymodes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:paymodes',
            'observation' => 'nullable|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $paymode = Paymode::create($request->all());

        return response()->json(['paymode' => $paymode], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymode = Paymode::find($id);
        if (is_null($paymode)) {
            return response()->json(['message' => 'Paymode not found'], 404);
        }

        return response()->json(['paymode' => $paymode]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:paymodes,name,' . $id,
            'observation' => 'nullable|string|max:200',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $paymode = Paymode::find($id);
        if (is_null($paymode)) {
            return response()->json(['message' => 'Paymode not found'], 404);
        }

        $paymode->update($request->all());

        return response()->json(['paymode' => $paymode]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymode = Paymode::find($id);
        if (is_null($paymode)) {
            return response()->json(['message' => 'Paymode not found'], 404);
        }

        $paymode->delete();
        return response()->json(['message' => 'Paymode deleted successfully']);
    }
}
