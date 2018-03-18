<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\Lesson
 *
 * @property int $id
 * @property int $chapter_id
 * @property string $title
 * @property string $description
 * @property string|null $resource
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \LMS\Chapter $chapter
 * @property-read \LMS\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Lesson whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Lesson whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Lesson whereResource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Lesson whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Lesson extends Model
{
    protected $fillable = ['chapter_id','title','description','resource'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
