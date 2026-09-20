<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningRequest extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'skill_id',
        'title',
        'description',
        'location',
        'session_type',
        'duration',
        'preferred_date',
        'preferred_time',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'preferred_date' => 'date',
        ];
    }

    /**
     * The user who created the learning request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The skill the user wants to learn.
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
    /**
 * Offers made by tutors for this learning request.
 */
public function offers()
{
    return $this->hasMany(RequestOffer::class, 'request_id');
}

public function bookings()
{
    return $this->hasMany(Booking::class, 'request_id');
}
}