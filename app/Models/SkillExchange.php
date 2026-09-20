<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillExchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposer_id',
        'receiver_id',
        'teach_skill_id',
        'learn_skill_id',
        'message',
        'status',
    ];

    public function proposer()
    {
        return $this->belongsTo(User::class, 'proposer_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function teachSkill()
    {
        return $this->belongsTo(Skill::class, 'teach_skill_id');
    }

    public function learnSkill()
    {
        return $this->belongsTo(Skill::class, 'learn_skill_id');
    }
}