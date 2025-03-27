<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
    'full_name',
    'age',
    'gender', 
    'diagnosis',
    'admission_date',
    'discharged',
    'room_number'
];
protected $casts = [
    'admission_date'=>'date',
    'discharged' => 'boolean'
];
}
