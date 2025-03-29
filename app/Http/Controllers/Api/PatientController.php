<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Hiển thị danh sách bệnh nhân.
     */
    public function index()
    {
        $patients = Patient::all();
        return response()->json([
            'message' => 'Danh sách bệnh nhân được lấy thành công',
            'data' => $patients
        ], 200);
    }

    /**
     * Lưu một bệnh nhân mới.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:male,female,other',
            'diagnosis' => 'required|string',
            'admission_date' => 'required|date',
            'discharged' => 'boolean',
            'room_number' => 'required|string'
        ]);

        $patient = Patient::create($validated);
        return response()->json([
            'message' => 'Thêm bệnh nhân thành công',
            'data' => $patient
        ], 201);
    }

    /**
     * Hiển thị thông tin chi tiết bệnh nhân.
     */
    public function show(string $id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Bệnh nhân không tồn tại'], 404);
        }
        return response()->json([
            'message' => 'Lấy thông tin bệnh nhân thành công',
            'data' => $patient
        ], 200);
    }

    /**
     * Cập nhật thông tin bệnh nhân.
     */
    public function update(Request $request, string $id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Bệnh nhân không tồn tại'], 404);
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|in:male,female,other',
            'diagnosis' => 'required|string',
            'admission_date' => 'required|date',
            'discharged' => 'boolean',
            'room_number' => 'required|string'
        ]);

        $patient->update($validated);
        return response()->json([
            'message' => 'Cập nhật thông tin bệnh nhân thành công',
            'data' => $patient
        ], 200);
    }

    /**
     * Xóa bệnh nhân.
     */
    public function destroy(string $id)
    {
        $patient = Patient::find($id);
        if (!$patient) {
            return response()->json(['message' => 'Bệnh nhân không tồn tại'], 404);
        }

        $patient->delete();
        return response()->json([
            'message' => 'Xóa bệnh nhân thành công'
        ], 200);
    }
}
