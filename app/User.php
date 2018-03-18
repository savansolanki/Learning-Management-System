<?php

namespace LMS;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * LMS\User
 *
 * @property int $id
 * @property int $role 0 = Student , 1 = Tutor
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\CourseQuestion[] $courseQuestions
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Course[] $courses
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\EnrolledCourse[] $enrolled_course
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Lesson[] $lessons
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\QuizAnswer[] $quizAnswers
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\QuizQuestion[] $quizQuestions
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Score[] $scores
 * @property-read \LMS\StudentProfile $student_profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Course[] $tutorCourses
 * @property-read \LMS\TutorProfile $tutor_profile
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User role()
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    const STUDENT = 0, TUTOR = 1;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password', 'avatar', 'role',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->slug = str_slug($user->name) . date("jnYgsz");
        });

    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $query
     */
    public function scopeRole($query)
    {
        return $query->where('role', self::TUTOR);
    }

    public function tutor_profile()
    {
        return $this->hasOne(TutorProfile::class);
    }

    public function student_profile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function tutorCourses()
    {
        return $this->hasMany(Course::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrolled_courses');
    }

    public function enrolled_course()
    {
        return $this->hasMany(EnrolledCourse::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }

    public function courseQuestions()
    {
        return $this->hasMany(CourseQuestion::class);
    }

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function quizAnswers()
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
