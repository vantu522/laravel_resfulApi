<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullName' => $this->full_name, // Chuyển snake_case thành camelCase
            'age' => $this->age,
            'gender' => $this->gender,
            'diagnosis' => $this->diagnosis,
            'admissionDate' => $this->admission_date->format('Y-m-d'), // Format ngày
            'discharged' => (bool)$this->discharged, // Đảm bảo kiểu boolean
            'roomNumber' => $this->room_number,
            
            // Các trường timestamps nếu cần
            'createdAt' => $this->created_at->toDateTimeString(),
            'updatedAt' => $this->updated_at->toDateTimeString(),
            
            // Có thể thêm các trường tính toán
            'status' => $this->discharged ? 'Đã xuất viện' : 'Đang điều trị',
            
            // Quan hệ nếu có (ví dụ với bác sĩ)
            // 'doctor' => new DoctorResource($this->whenLoaded('doctor'))
        ];
    }
     
    /**
     * Thêm metadata vào response nếu cần
     */
    public function with($request)
    {
        return [
            'meta' => [
                'version' => '1.0.0',
                'author' => 'Hospital API'
            ],
        ];
    }
}