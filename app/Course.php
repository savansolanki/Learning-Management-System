<?php

namespace LMS;

use Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * LMS\Course
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $category
 * @property int $sub_category
 * @property string $level Cource Level
 * @property string $question_1 What knowledge & tools are required?
 * @property string $question_2 Who should take this course?
 * @property string $question_3 What will students achieve after taking your course?
 * @property string $course_image
 * @property int $status 0 = In-Active , 1 = Active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Chapter[] $chapters
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\CourseQuestion[] $courseQuestions
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\User[] $enrolledUser
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Lesson[] $lessons
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\QuizQuestion[] $quizQuestions
 * @property-read \LMS\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course owner()
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereCourseImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereQuestion1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereQuestion2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereQuestion3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereSubCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Course whereUserId($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
    protected $fillable = ['user_id','title','slug','description','category','sub_category','level','question_1','question_2','question_3','course_image'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = str_slug($course->title);
        });

    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrolledUser()
    {
        return $this->belongsToMany(User::class, 'enrolled_courses');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Chapter::class);
    }

    public function courseQuestions(){
        return $this->hasMany(CourseQuestion::class);
    }

    public function quizQuestions(){
        return $this->hasMany(QuizQuestion::class);
    }

    public function scores(){
        return $this->hasMany(Score::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeOwner($query)
    {
        if ( Auth::check()) {
            $userId = Auth::user()->id;
        }
        return $query->where('courses.user_id', $userId);
    }

}
