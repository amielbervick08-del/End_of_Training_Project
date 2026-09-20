<?php

namespace App\Models;

use App\Models\Message;
use App\Models\SkillExchange;
use App\Models\Availability;
use App\Models\LearningRequest;
use App\Models\Skill;
use App\Models\UserSkill;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'location',
    'bio',
    'profile_image',
    'role',
    'skill_points',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function learningRequests()
{
    return $this->hasMany(LearningRequest::class);
}
public function userSkills()
{
    return $this->hasMany(UserSkill::class);
}

public function skills()
{
    return $this->belongsToMany(Skill::class, 'user_skills')
        ->withPivot('type', 'level')
        ->withTimestamps();
}
/**
 * Offers made by this user to learning requests.
 */
public function requestOffers()
{
    return $this->hasMany(RequestOffer::class, 'tutor_id');
}

public function studentBookings()
{
    return $this->hasMany(Booking::class, 'student_id');
}

public function tutorBookings()
{
    return $this->hasMany(Booking::class, 'tutor_id');
}

public function reviewsWritten()
{
    return $this->hasMany(Review::class, 'reviewer_id');
}

public function reviewsReceived()
{
    return $this->hasMany(Review::class, 'reviewee_id');
}

public function availabilities()
{
    return $this->hasMany(Availability::class);
}

public function skillExchangesProposed()
{
    return $this->hasMany(SkillExchange::class, 'proposer_id');
}

public function skillExchangesReceived()
{
    return $this->hasMany(SkillExchange::class, 'receiver_id');
}

public function sentMessages()
{
    return $this->hasMany(Message::class, 'sender_id');
}

public function receivedMessages()
{
    return $this->hasMany(Message::class, 'receiver_id');
}
}
