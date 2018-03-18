<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use LMS\CourseSubCategory;

Route::get('/', 'HomeController@index');
Route::get('/tutorList', 'HomeController@show');

Route::group([
    'namespace' => 'Tutor',
    'prefix' => 'tutor',
    'as' => 'tutor.'
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('students/{course}', 'DashboardController@show')->name('studentList.show');
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('profile', 'ProfileController@store')->name('profile');
    Route::patch('update', 'ProfileController@update')->name('update');
    Route::get('profile/{profile}', 'ProfileController@show')->name('profile.show');
    Route::resource('course', 'CourseController');
    Route::group([
        'prefix' => '{course}',
    ], function () {
        Route::resource('chapter', 'ChapterController');
        Route::resource('lesson', 'LessonController');
        Route::resource('answer', 'CourseAnswerController');
        Route::get('quiz','QuizQuestionController@index')->name('quiz');
        Route::post('quiz','QuizQuestionController@store')->name('quiz');
        Route::delete('quiz/{question}','QuizQuestionController@destroy')->name('quiz.destroy');
        Route::patch('quiz/{question}','QuizQuestionController@update')->name('quiz.update');
    });
    Route::get('/ajax-subcategory', function (Request $request) {
        $cat_id = $request->cat_id;
        $sub_categories = CourseSubCategory::where('course_category_id', $cat_id)->get();
        return Response::json($sub_categories);
    })->name('ajax');
});

Route::group([
    'namespace' => 'Student',
    'prefix' => 'student',
    'as' => 'student.'
], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('profile', 'ProfileController@store')->name('profile');
    Route::patch('update', 'ProfileController@update')->name('update');
    Route::get('enroll', 'EnrolledCourseController@index')->name('index');
    Route::patch('enroll/{course}', 'EnrolledCourseController@store')->name('enroll_course');
    Route::get('enroll/{course}', 'EnrolledCourseController@show')->name('enrolled_course');
    Route::get('profile/{profile}', 'ProfileController@show')->name('profile.show');
    Route::get('{course}/chapter/{chapter}', 'ChapterController@show')->name('chapter.show ');
    Route::get('{course}/questions', 'CourseQuestionController@index')->name('questions');
    Route::post('{course}/questions', 'CourseQuestionController@store')->name('questions.store');
    Route::get('{course}/questions/{question}', 'CourseQuestionController@show')->name('questions.show');
    Route::patch('{course}/questions/{question}', 'CourseQuestionController@update')->name('questions.update');
    Route::delete('{course}/questions/{question}', 'CourseQuestionController@destroy')->name('questions.destroy');
    Route::get('{course}/quiz', 'QuizAnswerController@index')->name('quiz.questions');
    Route::get('{course}/start/', 'QuizAnswerController@show')->name('quiz.show');
    Route::post('{course}/start/{question}', 'QuizAnswerController@store')->name('quiz.store');
    Route::get('{course}/finish', 'QuizAnswerController@submitQuiz')->name('quiz.submit');
});

Auth::routes();

Route::any('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

