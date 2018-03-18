<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\CourseCategory
 *
 * @property int $id
 * @property string $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\Course[] $courses
 * @property-read \Illuminate\Database\Eloquent\Collection|\LMS\CourseSubCategory[] $subcategories
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseCategory whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseCategory whereId($value)
 * @mixin \Eloquent
 */
class CourseCategory extends Model
{
    public function subcategories()
    {
        return $this->hasMany(CourseSubCategory::class);
    }

    public function courses(){
        return $this->hasMany(Course::class,'category');
    }
}
