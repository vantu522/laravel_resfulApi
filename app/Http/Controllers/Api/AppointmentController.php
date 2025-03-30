<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $appointments = Appointment::with(['doctor','patient'])->get();
        return response()->json([
            'message'=>'Lấy danh sách lịch hẹn thành công',
            'data' => $appointments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $validated = $request->validated();
        $appointment = Appointment::create($validated);
        $appointment->load(['doctor','patient']);
        return response()->json([
            'message' => 'Tạo lịch hẹn thành công',
            'data' => $appointment
        ],201);
        

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, string $id)
    {
        //
        $appointment = Appointment::find($id);
        if(!$appointment){
            return response()->json(['message'=>'Lịch hẹn không tồn tại'],404);
        }
        $validated= $request->validated();
        $appointment->update($validated);
        return response()->json([
            'message' => 'Cập nhật lịch hẹn thành công!',
            'data' => $appointment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
            $appointment = Appointment::find($id);
            if(!$appointment){
                return response()->json(['message'=> 'Không tìm thấy lịch hẹn']);
            }

            $appointment->delete();
            return response()->json([
                'message' => 'Xoá lịch hẹn thành công!'
            ]);
    }
}
