<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $patients = Patient::all();
        return PatientResource::collection($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age'=> 'required|integer|min:0',
            'gender' => 'required|in:male,female,other',
            'diagnosis' => 'required|string',
            'admission_date' => 'required|date',
            'discharged' => 'boolean',
            'room_number' => 'required|string'
        ]);

        $patient = Patient::create($validated);
        return new PatientResource($patient);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
