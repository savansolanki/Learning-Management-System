<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\EnrolledCourse
 *
 * @property int $user_id
 * @property int $course_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Course[] $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\User[] $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\EnrolledCourse whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\EnrolledCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\EnrolledCourse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\EnrolledCourse whereUserId($value)
 * @mixin \Eloquent
 */
class EnrolledCourse extends Model
{
    protected $fillable = ['user_id','course_id'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function course()
    {
        return $this->belongsToMany(Course::class);
    }
}
