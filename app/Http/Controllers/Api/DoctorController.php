<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
        return response()->json([
            'message' => 'Lấy danh sách các bác sĩ thành công',
            'data' => $doctors
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        //
        $validated = $request->validated(); // Kiểm tra dữ liệu đã validate

        $doctor = Doctor::create($validated);
        return response()->json([
            'message' => 'Thêm bác sĩ thành công',
            'data' => $doctor
        ],201);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $doctor = Doctor::find($id);
        if(!$doctor){
            return response()->json([
                'message'=>'Lấy thông tin bác sĩ thất bại!'
            ],404);
        }
        return response()->json([
            'message'=>'Lấy người dùng thành công',
            'data'=> $doctor
        ],200);
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
    public function update(DoctorRequest $request, string $id)
    {
        //
        $doctor = Doctor::find($id);
        if(!$doctor){
            return response()->json([
                'message'=>"Bác sĩ không tồn tại"
            ],404);
        }
        $validated = $request->validated();
        $doctor->update($validated);
        return response()->json([
            'message'=>'Cập nhật thông tin bác sĩ thành công!',
            'data'=>$doctor
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $doctor = Doctor::find($id);
        if(!$doctor){
            return response()->json([
                'message'=>'Bác sĩ không tồn tại'
            ]);
        }
        $doctor->delete();
        return response()->json([
            'message'=>'Xoá thành công bác sĩ'
        ]);
    }
}
