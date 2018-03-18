<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\Chapter
 *
 * @property int $id
 * @property int $course_id
 * @property string $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \LMS\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Lesson[] $lessons
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Chapter whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Chapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Chapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Chapter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Chapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    protected $fillable= ['course_id','title'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

}
