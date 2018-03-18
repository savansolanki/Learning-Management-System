<?php

namespace LMS;

use Illuminate\Database\Eloquent\Model;

/**
 * LMS\CourseSubCategory
 *
 * @property int $id
 * @property int $course_category_id
 * @property string $sub_category
 * @property-read \LMS\CourseCategory $course_category
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseSubCategory whereCourseCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseSubCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\LMS\CourseSubCategory whereSubCategory($value)
 * @mixin \Eloquent
 */
class CourseSubCategory extends Model
{
    public function course_category()
    {
        return $this->belongsTo(CourseCategory::class);
    }
}
