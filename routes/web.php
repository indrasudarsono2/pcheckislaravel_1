<?php

use App\Group_member;
use GuzzleHttp\Middleware;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::resource('employes', 'EmployesController');
// Route::get('/users', 'UsersController@index');
// Route::get('/users/create', 'UsersController@create');
// Route::post('/users', 'UsersController@store');
// Route::delete('/users/{user}', 'UsersController@destroy');
// Route::get('/users/{user}/edit', 'UsersController@edit');
// Route::patch('/users/{user}', 'UsersController@update');

Route::post('/', 'otentikasi\OtentikasiController@login');
Route::get('/dummy', 'otentikasi\OtentikasiController@dummy');
Route::get('/', 'otentikasi\OtentikasiController@index')->name('login');
Route::get('logout', 'otentikasi\OtentikasiController@logout')->name('logout');
Route::get('/forgot_password', 'ForgotPasswordController@forgot_password');
Route::post('/forgot_password', 'ForgotPasswordController@forgot');
Route::get('/reset_password/{token}', 'ResetPasswordController@getPassword');
Route::post('/reset_password/{token}', 'ResetPasswordController@resetPassword')->name('reset_password');

Route::group(['middleware' => ['auth', 'checkingremark:1']], function () {
  Route::get('/super', 'otentikasi\OtentikasiController@home');
  Route::get('aplication_ratings/{aplication_rating}/mc_questions/searching_question/{keyword}', 'super\Mc_questionsController@search');
  Route::get('aplication_ratings/{aplication_rating}/essays/searching_question/{keyword}', 'super\EssaysController@search');
  Route::get('aplication_ratings/{aplication_rating}/performance_checks/varian/{varians}', 'super\Performance_checkController@quantity');
  Route::get('/session_gain', 'super\SessionsController@index_gain');

  Route::get('/session_statistic', 'super\SessionsController@index_statistic');
  Route::get('/session_statistic/{session}/aplication_ratings', 'super\Aplication_ratings2Controller@index_statistic')->name('sessions.aplication_ratings.index_statistic')->middleware('checkingSession');
  Route::get('/session_statistic/{session}/aplication_ratings/{aplication_rating}', 'super\StatisticsController@show_statistic')->name('sessions.aplication_ratings.show')->middleware(['checkingSession', 'checkingAplication_rating']);
  Route::get('/session_statistic/{session}/aplication_ratings/{aplication_rating}/statistics/{statistic}', 'super\StatisticsController@show_statistic_detail')->name('sessions.aplication_ratings.statistics.show')->middleware(['checkingSession', 'checkingAplication_rating', 'checkingQuestion']);
  Route::resource('acs_questions', 'super\Acs_questionsController');
  Route::resource('acp_questions', 'super\Acp_questionsController');
  Route::resource('sessions', 'super\SessionsController');
  Route::get('groups_history/{group_history}/group_members', 'super\Group_membersController@history');
  Route::get('groupss_history', 'super\GroupsController@history');
  Route::get('groupss_table', 'super\GroupsController@table');
  Route::get('groupss_print', 'super\GroupsController@print');
  Route::delete('groupss_history/{group}', 'super\GroupsController@delete');
  Route::resource('groups.group_members', 'super\Group_membersController')->except('show')->middleware('checkingBranch');
  Route::resource('groups.group_member', 'super\Group_membersController')->only('show')->middleware(['checkingBranch', 'checkingbranchgm']);
  Route::get('groups/{group}/group_member/{group_member}/form_ratings/{form_rating}/essay', 'super\Group_membersController@essay')->name('groups.group_member.form_ratings')->middleware(['checkingBranch', 'checkingbranchgm', 'checkingbranchfr']);
  Route::post('groups/{group}/group_member/{group_member}/form_ratings/{form_rating}/essay', 'super\EssaysController@show')->name('groups.group_member.form_ratings.essay')->middleware(['checkingBranch', 'checkingbranchgm', 'checkingbranchfr']);
  Route::resource('groups', 'super\GroupsController')->except(['index', 'create', 'store'])->middleware('checkingBranch');
  Route::resource('groupss', 'super\GroupsController')->only(['index', 'create', 'store']);
  Route::get('/gain_table/{session}', 'super\Gain_ratingsController@table');
  Route::get('/gain_print/{session}', 'super\Gain_ratingsController@print')->name('printTable');
  Route::resource('sessions.gain_ratings', 'super\Gain_ratingsController')->except(['index', 'create', 'store'])->middleware('checkingBranchChecker');
  Route::resource('sessions.gain_ratingss', 'super\Gain_ratingsController')->only(['index', 'create', 'store']);
  Route::resource('sessions.gain_ratings.checker_gains', 'super\Checker_gainController')->middleware('checkingBranchChecker');
  Route::resource('aplication_ratings', 'super\Aplication_ratingsController');
  Route::get('aplication_ratings_pc', 'super\Aplication_ratingsController@index_pc')->name('ar_pc.index');
  Route::resource('aplication_ratings.performance_checks', 'super\Performance_checkController');
  Route::resource('aplication_ratings.question_groups', 'super\Question_groupsController');
  Route::resource('aplication_ratings.mc_questions', 'super\Mc_questionsController');
  Route::resource('aplication_ratings.essay_groups', 'super\Essay_groupsController');
  Route::resource('aplication_ratings.essays', 'super\EssaysController');
  Route::resource('schedules', 'super\SchedulesController');
  Route::resource('provisions', 'super\ProvisionsController');
});

Route::group(['middleware' => ['auth', 'checkingremark:1,2']], function () {
  Route::get('/super', 'otentikasi\OtentikasiController@home');
  Route::get('password_', 'PasswordController@user');
  Route::post('password_confirmation', 'PasswordController@confirmation');
  Route::get('password_edit', 'PasswordController@edit');
  Route::patch('password_update', 'PasswordController@editUsr');
  Route::get('searching_ielp/{keyword}', 'super\IelpController@search');
  Route::get('searching_medex/{keyword}', 'super\MedexController@search');
  Route::get('sessions/{session}/remark_ap_files/{remark_ap_file}/aplication_files/searching_file/{keyword}', 'super\Aplication_filesController@search');

  Route::get('find_files', 'super\find_filesController@index');
  Route::get('searching_files/{keyword}', 'super\Find_filesController@search');
  Route::get('searching_users/{keyword}', 'super\UsersController@search');
  Route::get('/searching_scores/{keyword}', 'super\UsersController@searching_score');
  Route::get('aplication_ratings/{aplication_rating}/searching_users/{keyword}', 'super\UsersController@search');
  Route::get('/session_monitor', 'super\SessionsController@index_monitor');
  Route::get('/sessopns_monitor/{session}/remark_ap_files', 'super\Remark_ap_filesController@index_session')->name('sessions.remark_ap_files.index_session')->middleware('checkingSession');
  Route::get('/sessions_monitor/{session}/remark_ap_files/{remark_ap_file}/aplication_ratings', 'super\Aplication_ratings2Controller@index_session')->name('sessions.remark_ap_files.aplication_ratings.index_session')->middleware('checkingSession');
  Route::get('/sessions_monitor/{session}/remark_ap_files/{remark_ap_file}/aplication_ratings/{aplication_rating}', 'super\Aplication_ratings2Controller@show')->name('sessions.remark_ap_files.aplication_ratings.show')->middleware(['checkingSession', 'checkingAplication_rating']);
  Route::get('/sessions_monitor/{session}/remark_ap_files/{remark_ap_file}/aplication_ratings/{aplication_rating}/form_rating/{form_rating}', 'super\Aplication_ratings2Controller@editPracticalExam')->name('editPracticalExam')->middleware(['checkingSession', 'checkingAplication_rating']);
  Route::get('/sessions_monitor/{session}/remark_ap_files/{remark_ap_file}/aplication_ratings/{aplication_rating}/printAll', 'super\Aplication_ratings2Controller@edit')->name('sessions.remark_ap_files.aplication_ratings.printAll')->middleware(['checkingSession', 'checkingAplication_rating']);
  Route::get('score_sessions', 'super\SessionsController@index_score')->name('score_sessions');
  Route::get('/user_scores', 'super\UsersController@user_scores')->name('user_scores');
  Route::get('/user_scores/{user}/sessions', 'super\SessionsController@user_session')->name('user.session.user_sesion');
  Route::get('/user_scores/{user}/sessions/{aplication_file}', 'super\ScoresController@index_participant')->name('user.session.user_sesion.score');
  Route::get('/user_scores/{user}/sessions/{aplication_file}/score/{score}', 'super\ScoresController@print_score')->name('user.session.user_sesion.score.print');
  Route::get('/user_scores/{user}/sessions/{aplication_file}/score/{score}/result', 'super\ScoresController@print_result')->name('user.session.user_sesion.score.result');
  Route::get('/ielp_super', 'super\IelpController@index');
  Route::get('/ielp_print', 'super\IelpController@print');
  Route::get('/medex_super', 'super\MedexController@index');
  Route::get('/medex_print', 'super\MedexController@print');
  Route::get('/sessions_history', 'super\SessionsController@index_history')->name('sessions_history');
  Route::post('/sessions/{session}/activities/{activity}/remark_ap_files/{remark_ap_file}/aplication_ratings/{aplication_rating}/attendance', 'super\ScoresController@attendance')->name('score_attendance');
  Route::post('/sessions/{session}/remark_ap_files/{remark_ap_file}/printAll', 'super\Aplication_filesController@printAll')->name('sessions.remark_ap_files.printAll')->middleware('checkingSession', 'checkingBranchHistory');
  Route::get('/sessions/{session}/remark_ap_files/{remark_ap_file}/aplication_files/{aplication_file}/viewDocument', 'super\Aplication_filesController@viewDocument')->name('viewDocumentSuper')->middleware('checkingSession', 'checkingBranchHistory');
  Route::get('/sessions/{session}/remark_ap_files/{remark_ap_file}/aplication_files/{aplication_file}/print_checklist', 'super\Aplication_filesController@print_checklist')->name('printChecklist_admin')->middleware('checkingSession', 'checkingBranchHistory');
  Route::patch('/sessions_monitor/{session}/remark_ap_files/{remark_ap_file}/aplication_ratings/{aplication_rating}/form_rating/{form_rating}/practical_exam', 'super\Aplication_ratings2Controller@updatePracticalExam')->name('updatePracticalExam')->middleware(['checkingSession', 'checkingAplication_rating']);

  Route::post('completeness_files/{user}/index', 'super\Completeness_filesController@index');
  Route::resource('completeness_files', 'super\Completeness_filesController');
  Route::resource('users', 'super\UsersController')->only(['index', 'create', 'store']);
  Route::resource('user', 'super\UsersController')->except(['index', 'create', 'store'])->middleware('checkingUser');
  Route::resource('sessions.activities', 'super\ActivitiesController')->middleware('checkingSession');
  Route::resource('sessions.activities.remark_ap_files', 'super\Remark_ap_filesController')->middleware('checkingSession');
  Route::resource('sessions.activities.remark_ap_files.aplication_ratings2', 'super\Aplication_ratings2Controller')->middleware('checkingSession');
  Route::resource('sessions.activities.remark_ap_files.aplication_ratings.scoress', 'super\ScoresController')->only(['index', 'create', 'store'])->middleware(['checkingSession', 'checkingAplication_rating']);
  Route::resource('sessions.activities.remark_ap_files.aplication_ratings.scores', 'super\ScoresController')->except(['index', 'create', 'store'])->middleware(['checkingSession', 'checkingAplication_rating', 'checkingScore']);
  Route::resource('sessions.remark_ap_files', 'super\Remark_ap_filesController')->middleware('checkingSession');
  Route::resource('sessions.remark_ap_files.aplication_files', 'super\Aplication_filesController')->middleware('checkingSession', 'checkingBranchHistory');
});

Route::group(['middleware' => ['auth', 'checkingexaminee:3,4']], function () {
  Route::get('/examinee', 'otentikasi\OtentikasiController@examinee');
  Route::get('aplication_files/searching/{ojti_id}', 'examinee\Aplication_filesController@search');
  Route::get('/provisionss_token/{token}', 'examinee\ProvisionsController@token');
  Route::get('files', 'examinee\FileController@index')->name('files');
  Route::get('acs_check', 'examinee\Acs_checkController@index');
  Route::post('acs_check', 'examinee\Acs_checkController@validation');
  Route::resource('aplication_files', 'examinee\Aplication_filesController')->except(['index', 'create', 'store'])->middleware('checkingaplicationfiles');
  Route::get('aplication_files/{aplication_file}/released', 'examinee\Aplication_filesController@released')->middleware('checkingaplicationfiles');
  Route::get('practical_exams', 'examinee\Practical_examsController@index')->name('practical_exams.index');
  Route::get('password_usr', 'PasswordController@user');
  Route::post('passwordusr_confirmation', 'PasswordController@confirmation');
  Route::get('passwordusr_edit', 'PasswordController@edit');
  Route::patch('passwordusr_update', 'PasswordController@editUsr');
  Route::get('/aplication_files/{aplication_file}/checklist', 'examinee\Aplication_filesController@print_checklist')->name('print_checklist')->middleware('checkingaplicationfiles');
  Route::get('/sessionss/{sessionss}/remark_ap_files/{remark_ap_file}/aplication_files/{aplication_file}/checklist_checker', 'examinee\Aplication_filesController@print_checklist_checker')->name('print_checklist_checker');

  // Route::resource('af', 'examinee\Aplication_filesController')->only(['index', 'create', 'store'])->middleware('checkingAplication_file');
  Route::resource('af', 'examinee\Aplication_filesController')->only(['index', 'create', 'store']);
  Route::resource('medex', 'examinee\MedexController')->except(['index', 'create', 'store'])->middleware('checkingMedex');
  Route::resource('med', 'examinee\MedexController')->only(['index', 'create', 'store']);
  Route::resource('ielp', 'examinee\IelpController')->except(['index', 'create', 'store'])->middleware('checkingIelp');
  Route::resource('ielpp', 'examinee\IelpController')->only(['index', 'create', 'store']);
  Route::resource('formal_educations', 'examinee\Formal_educationsController')->middleware('checkingFormal_education');
  Route::resource('competence_sertificates', 'examinee\Competence_sertificatesController')->middleware('checkingCompetenceSertificate');
  Route::resource('profil', 'examinee\ProfilController');
  Route::resource('form_ratings.performance_checks', 'examinee\Performance_checksController')->middleware('checkingFormRating');
  Route::resource('form_ratings.performance_checks.question_varians', 'examinee\Question_variansController');
  Route::resource('scoress', 'examinee\ScoresController')->only(['index', 'create', 'store']);
  Route::resource('scores', 'examinee\ScoresController')->except(['index', 'create', 'store'])->middleware('checkingScoreUser');
  Route::resource('licenses', 'examinee\LicensesController')->except(['index', 'create', 'store'])->middleware('checkingLicense');
  Route::resource('licensess', 'examinee\LicensesController')->only(['index', 'create', 'store']);
  Route::resource('logbooks', 'examinee\LogbooksController')->except(['index', 'create', 'store'])->middleware('checkingLogbook');
  Route::resource('logbookss', 'examinee\LogbooksController')->only(['index', 'create', 'store']);
});

Route::group(['middleware' => ['auth', 'checkingexaminee:4']], function () {
  Route::get('/sessionss/{sessionss}/remark_ap_files/{remark_ap_file}/aplication_files', 'examinee\Aplication_filesController@index_verification')->name('aplication_file.verification');
  Route::POST('/sessionss/{sessionss}/remark_ap_files/{remark_ap_file}/aplication_files/{aplication_file}', 'examinee\Aplication_filesController@verification')->name('aplication_file.verification_proses');
  Route::get('/sessionss/{sessionss}/remark_ap_files/{remark_ap_file}/aplication_files/{aplication_file}/verificaition', 'examinee\Aplication_filesController@verification_data')->name('verification_data');
  Route::get('/sessionss/{sessionss}/remark_ap_files/{remark_ap_file}/aplication_files/{aplication_file}/view', 'examinee\Aplication_filesController@viewDocument')->name('viewDocument');
  Route::get('/sessionss/{sessionss}/group_members/{group_member}/practical_exams', 'examinee\Practical_examsController@index_rate_member')->name('group_members.practical_exams.index_rate_member');
  Route::get('/sessionss/{sessionss}/group_members/{group_member}/practical_examss/{practical_exam}/edit', 'examinee\Practical_examsController@edit_group_member')->name('sessionss.group_members.practical_exams.edit');
  Route::patch('/sessionss/{sessionss}/group_members/{group_member}/practical_examss/{practical_exam}', 'examinee\Practical_examsController@update_group_member')->name('sessionss.group_members.practical_examss.update');
  Route::get('/sessionss/{sessionss}/group_members/{group_member}/form_ratings/{form_rating}/edit_gm', 'examinee\Form_ratingsController@edit_gm')->name('sessionss.group_members.form_ratings.edit_gm');
  Route::get('/session_practice', 'examinee\SessionsController@index_practice')->name('session_practice');
  Route::get('/session_getingRating', 'examinee\SessionsController@index_getingRating')->name('session_getingRating');
  Route::get('/sessionss/{sessionss}/group_members/{group_member}/{score}', 'examinee\Group_membersController@edit')->name('printScoreExaminee');

  Route::resource('sessionss', 'examinee\SessionsController');
  Route::resource('sessionss.remark_ap_files', 'examinee\Remark_ap_filesController');
  Route::resource('sessionss.group_members', 'examinee\Group_membersController');
  Route::resource('sessionss.group_members.form_ratings', 'examinee\Form_ratingsController');
  Route::resource('sessionss.group_members.form_ratings.essay_corrections', 'examinee\Essay_correctionsController');
  Route::resource('sessionss.checker_gains.form_ratings', 'examinee\Form_ratingsController');
  Route::resource('sessionss.checker_gains.form_ratings.essay_corrections', 'examinee\Essay_correctionsController');
  Route::resource('sessionss.checker_gains', 'examinee\Checker_gainsController');
  Route::resource('sessionss.checker_gains.practical_exams', 'examinee\Practical_examsController');
  Route::get('sessionss/{sessionss}/checker_gains/{checker_gain}/practical_exams', 'examinee\Practical_examsController@index_rate_gain')->name('checker_gains.practical_exams.index_rate_gain');
});
