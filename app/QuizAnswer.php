<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\QuizAnswer
 *
 * @property int $id
 * @property int $quiz_question_id
 * @property int $user_id
 * @property int $answer
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \LMS\QuizQuestion $quizQuestions
 * @property-read \LMS\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizAnswer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizAnswer whereQuizQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizAnswer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\QuizAnswer whereUserId($value)
 * @mixin \Eloquent
 */
class QuizAnswer extends Model
{
    protected $fillable = ['quiz_question_id','user_id','answer'];

    public function quizQuestions()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
