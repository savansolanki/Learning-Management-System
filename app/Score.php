<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\Score
 *
 * @property int $id
 * @property int $course_id
 * @property int $user_id
 * @property int $score
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \LMS\Course $course
 * @property-read \LMS\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Score whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Score whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Score whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Score whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Score whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Score whereUserId($value)
 * @mixin \Eloquent
 */
class Score extends Model
{
    protected $fillable = ['course_id','user_id','score'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
