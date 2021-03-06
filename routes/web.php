<?php

// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index');

Auth::routes(['verify'=>true]);

Route::get('/profile', 'HomeController@showProfilePage')->name('home');
Route::get('/profile/edit/{id}', 'HomeController@editProfile')->name('users.edit-profile');
Route::PATCH('/profile/update/{id}', 'HomeController@updateProfile')->name('users.update-profile');

Route::get('/users/logout', 'Auth\LoginController@userlogout')->name('user.logout');


// Employers Routes

Route::prefix('vacancy')->group(function(){
Route::get('/all-vacancy', 'EmployerController@allVacancies')->name('all-vacancies');
Route::post('/search-vacancy', 'EmployerController@searchForVacancy')->name('search-vacancies');

Route::get('/create_job', 'EmployerController@create')->name('employer.create_job');

Route::post('/store', 'EmployerController@store')->name('employer.store');
Route::get('/edit/{id}', 'EmployerController@edit')->name('employer.edit');
Route::PATCH('/update/{id}', 'EmployerController@update')->name('employer.update');
Route::get('/all-vacancies/{id}', 'EmployerController@EmployerJobsLIstings')->name('employer.all-vacancies');
Route::get('/delete/{id}', 'EmployerController@destroy')->name('employer.delete-vacancy');
});


// Vacancies
Route::get('vacancies/{id}/{category_id}/{title}', 'EmployerController@show')->name('vacancy.details');
Route::get('/get-job-details/{id}',"EmployerController@getvacancyDetails");
// Employers age
Route::get('vacancies/{id}/{title}', 'EmployerController@show')->name('vacancy-employer.details');


// Admin route
Route::any('/users/{type}/{name}', 'HomeController@userType')->name('dashboard');

// changing password
Route::get('/users/change-password', 'ChangePasswordController@changePassword')->name('users.change.passwrod');

Route::PATCH('/users/updatepassword', 'ChangePasswordController@updatePassword')->name('users.update.passwrod');

Route::get('/users/switch-usage', 'ProfileSettingController@switchUsage')->name('users.switch.usage');

Route::PATCH('/users/switch-user-type', 'ProfileSettingController@saveSwitchUsage');

Route::prefix('admin')->group(function(){

Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');

Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::get('/', 'AdminController@index')->name('admin.dashboard');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

// Reset password

Route::post('/password/email', "Auth\AdminForgotPasswordController@sendResetLinkEmail")->name('admin.password.email') ;
Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request') ;

Route::post('/password/reset', "Auth\AdminResetPasswordController@reset");
Route::get('/password/reset/{token}', "Auth\AdminResetPasswordController@showResetForm")->name('admin.password.reset') ;
});

// saving applicants information
Route::prefix('applicants')->group(function(){
    Route::post('/personal-data', 'ApplicantController@storePeronalData')->name('applicant.peronal.data');

    Route::get('/creating-profile/{id}/personal-create-data', 'ApplicantController@createApplicant')->name('applicant.data-create');

    Route::get('edit-profile/{id}/{applicant_id}/personal-edit-data', 'ApplicantController@createApplicant')->name('applicant.data-edit');

    Route::PATCH('/{id}/personal-update-data', 'ApplicantController@updatePersonalData')->name('applicant.data-update');

    Route::get('/creating-experience/{id}/{user}/experienc-create', 'ExperienceController@createApplicantExperience')->name('applicant.experience-add');

    Route::post('/{id}/{user}/experience', 'ExperienceController@storeExperirnce')->name('applicant.experience-save');

    Route::get('/managing-eperience/{id}/{user}/experience-all', 'ExperienceController@allApplicantExperience')->name('applicant.experience-all');

    Route::get('/editing-experience/{id}/{applicant_id}/', 'ExperienceController@editExperience')->name('applicant.experience-edit');

    Route::PATCH('/updating-experience/{id}/{applicant_id}/', 'ExperienceController@updateExperience')->name('applicant.experience-update');

    Route::get('/detail-experience/{experience_id}/{applicant_id}', 'ExperienceController@detailExperience')->name('details.experience');

    Route::get('/delete-experience/{experience_id}/{applicant_id}', 'ExperienceController@deleteExperience')->name('delete.experience');


    Route::get('/creating-education/{id}/{user}/education', 'EducationController@createApplicantEducation')->name('applicant.education-create');

    Route::get('/editing-education/{id}/{user}/education', 'EducationController@editEducation')->name('applicant.education-edit');

    Route::post('/saving-education/{id}/{user}/education', 'EducationController@storeEducation')->name('applicant.education-save');

    Route::PATCH('/update-education/{id}/{user}/education', 'EducationController@updateEducation')->name('applicant.education-update');

    Route::get('/viewing-education/{id}/{user}/education-all', 'EducationController@getAllEducationRecordsByAplicant')->name('applicant.education-all');

    Route::get('/resume/{id}/create-resume', 'ApplicantController@createResume')->name('applicant.create-cv');

    Route::post('/{id}/store-resume', 'ApplicantController@storeResume')->name('applicant.save-cv');

    Route::get('/skills/{id}/create-skills', 'ApplicantController@createSkills')->name('applicant.create-skills');

    Route::post('/{id}/save-skills', 'ApplicantController@saveSkills')->name('applicant.save-skills');
    Route::post('/apply-for-job/{jobId}/{applicantId}', 'ApplicantController@applyForAjob')->name('send-my-application');

    Route::get('/applicant-details/{id}', 'ApplicantController@show')->name('applicant.details');

    Route::get('/applicant-all', 'ApplicantController@index')->name('applicant.all');

    Route::post('/applicant-search', 'ApplicantController@searchForApplicant')->name('search-applicants');

    // create alert preference
    Route::get('/{id}/create/alert-preference', 'ApplicantController@createAlertPreference')->name('create.alert.preference');

    // save alert to databse
    Route::post('/{id}/save/alert-preferecne', 'ApplicantController@storeAlert')->name('save.alert');
    Route::get('delete/{id}', 'ApplicantController@deleteApplicant')->name('delete');

    Route::get('applicant_details/{id}', 'ApplicantController@applicantDetails');
});

// Route for creating profile image
Route::get('auth/create-photo', 'ProfileImageController@createProfileImage')->name('profile-upload');

// save profile photo by all users
Route::post('auth/{id}/save-profile-photo', 'ProfileImageController@storeProfileImage')->name('profile-store');

// reach out to applicant by potential employer
Route::post('employer/reach-out', 'EmployerController@reachOut')->name('reach-out');

Route::get('pages/about', function(){
    $title = "About US";
    return view('pages.about', compact(['title'=>'title']));
})->name('about');
