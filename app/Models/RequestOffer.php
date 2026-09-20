<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'tutor_id',
        'message',
        'status',
    ];

    /**
     * The learning request this offer belongs to.
     */
    public function request()
    {
        return $this->belongsTo(LearningRequest::class, 'request_id');
    }

    /**
     * The user who made the offer.
     */
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }
}