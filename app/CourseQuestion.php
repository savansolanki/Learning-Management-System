<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\CourseQuestion
 *
 * @property int $id
 * @property int $course_id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \LMS\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\CourseAnswer[] $courseAnswers
 * @property-read \LMS\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseQuestion whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseQuestion whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseQuestion whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseQuestion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseQuestion whereUserId($value)
 * @mixin \Eloquent
 */
class CourseQuestion extends Model
{
    protected $fillable = ['course_id','user_id','title','slug','body'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($question) {
            $question->slug = str_slug($question->title);
        });

    }

    public function course()
    {
       return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseAnswers()
    {
        return $this->hasMany(CourseAnswer::class);
    }
}
