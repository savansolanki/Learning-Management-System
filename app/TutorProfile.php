<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\TutorProfile
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
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereGoogle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereWeb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\TutorProfile whereYoutube($value)
 * @mixin \Eloquent
 */
class TutorProfile extends Model
{
    protected  $fillable = ['user_id','headline','biography','web','google','linkedin','youtube'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
