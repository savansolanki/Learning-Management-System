<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\CourseAnswer
 *
 * @property int $id
 * @property int $course_question_id
 * @property int $user_id
 * @property string $body
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \LMS\CourseQuestion $courseQuestions
 * @property-read \LMS\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseAnswer whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseAnswer whereCourseQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseAnswer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseAnswer whereUserId($value)
 * @mixin \Eloquent
 */
class CourseAnswer extends Model
{
    protected $fillable = ['course_question_id','user_id','body'];

    public function courseQuestions(){
        return $this->belongsTo(CourseQuestion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
