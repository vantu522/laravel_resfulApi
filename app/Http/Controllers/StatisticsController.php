<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    //
    public function totalDoctors()
    {
        $total_doctors = Doctor::count();
        $total_patients= Patient::count();
        $total_appointments= Appointment::count();
        return response()->json([
            'title' => 'Tổng số lượng bác sĩ hiện tại',
            'total_doctors'=>$total_doctors,
            'total_patients'=>$total_patients,
            'total_appointments' => $total_appointments


        ],200);
    }
}
