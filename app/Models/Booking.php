<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'student_id',
        'tutor_id',
        'date',
        'start_time',
        'end_time',
        'session_type',
        'status',
        'skill_points_awarded',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'skill_points_awarded' => 'boolean',
        ];
    }

    public function request()
    {
        return $this->belongsTo(LearningRequest::class, 'request_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function reviews()
{
    return $this->hasMany(Review::class);
}

}