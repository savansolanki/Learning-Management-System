<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\LessonUser
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Lesson[] $lessons
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\User[] $user
 * @mixin \Eloquent
 */
class LessonUser extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }
}
