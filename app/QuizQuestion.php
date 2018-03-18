<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\QuizQuestion
 *
 * @property int $id
 * @property int $course_id
 * @property string $question
 * @property string $choice_1
 * @property string $choice_2
 * @property string $choice_3
 * @property string $choice_4
 * @property string $correct_answer
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \LMS\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereChoice1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereChoice2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereChoice3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereChoice4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereCorrectAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizQuestion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QuizQuestion extends Model
{
    protected $fillable = ['course_id','question','choice_1','choice_2','choice_3','choice_4','correct_answer'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
