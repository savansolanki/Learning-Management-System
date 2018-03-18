<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\StudentProfile
 *
 * @property int $id
 * @property int $user_id
 * @property string $headline
 * @property string|null $biography
 * @property string|null $web
 * @property string|null $google
 * @property string|null $linkedin
 * @property string|null $youtube
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \LMS\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereGoogle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\StudentProfile whereYoutube($value)
 * @mixin \Eloquent
 */
class StudentProfile extends Model
{
    protected  $fillable = ['user_id','headline','biography','web','google','linkedin','youtube'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
