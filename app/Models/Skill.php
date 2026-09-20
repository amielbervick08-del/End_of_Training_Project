<?php

namespace App\Models;

use App\Models\SkillExchange;
use App\Models\LearningRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
    ];

    public function learningRequests()
{
    return $this->hasMany(LearningRequest::class);
}
    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skills')
            ->withPivot('type', 'level')
            ->withTimestamps();
    }

    public function skillExchangesAsTeachSkill()
{
    return $this->hasMany(SkillExchange::class, 'teach_skill_id');
}

public function skillExchangesAsLearnSkill()
{
    return $this->hasMany(SkillExchange::class, 'learn_skill_id');
}
}