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
/* service Container */

/* admin panel */
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {    // Ignores notices and reports all other kinds... and warnings    
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
/* get current location of user */
Route::get('get-location-from-ip',function(){
    $ip= \Request::ip();
    $data = \Location::get($ip);
    dd($data);
});

Route::get('/event','Home@sendMessage');
Route::get('/listen',function(){
	return view('broadcoast');
});
Route::post('read/likes/{type}','frontend\Home@likes');
Route::get('verifyUser/{verificationCode}','frontend\Home@verifyUser');
Route::get('readCat','frontend\Home@readCat');
Route::post('addreadCat','frontend\Home@addreadCat');
Route::post('deletereadCat','frontend\Home@deletereadCat');
Route::get('getfeedback','frontend\Home@getfeedback');
Route::post('feedback','frontend\Home@feedback');
Route::post('editfeedback','frontend\Home@editfeedback');
Route::post('deletefeedback','frontend\Home@deletefeedback');
Route::post('RemCompProImage','frontend\Home@removeCompanyProPic');
Route::post('cropProfileImage','frontend\Home@changepropic');
Route::post('cropCompanyProfileImage','frontend\Home@changecompanypropic');
Route::post('deactiveUser','frontend\Home@deactiveUser');
Route::post('passwordValidate','frontend\Home@regvalpass');

Route::group(['prefix' => 'admin'], function () {
	Auth::routes();
    Route::match(['get','post'],'/','admin\Home@login');
    Route::match(['get','post'],'','admin\Home@login');
	Route::match(['get','post'],'login','admin\Home@login');
	Route::get('logout','admin\Home@logout');
	Route::match(['get','post'],'register','admin\Home@register');

	Route::get('dashboard','admin\Dashboard@index');
	Route::get('orders','admin\Dashboard@home');
	Route::get('receivepayment','admin\Dashboard@receive');
	Route::post('cms/jobs/delete','admin\Cms@deleteJob');
	Route::get('cms/jobs/update/{id}','admin\Cms@editjob');

	/* setting */
	Route::match(['get','post'],'settings/profile','admin\Setting@profile');
	Route::match(['get','post'],'settings/website','admin\Setting@website');
	Route::get('settings/accounts','admin\Setting@accounts');
	Route::post('settings/mailgun/save','admin\Setting@saveMailgun');
	Route::post('settings/paypal/save','admin\Setting@savePaypal');

	/* user management */
	Route::match(['get','post'],'users/view','admin\Users@viewUsers');
	Route::match(['get','post'],'users/add','admin\Users@addEditUser');
	Route::match(['get','post'],'users/edit/{id}','admin\Users@addEditUser');
	Route::get('users/view/{id}','admin\Users@viewSingleUser');

	Route::delete('user/delete','admin\Users@deleteUser');
	
	Route::match(['get','post'],'users/company','admin\Users@companies');
	Route::match(['get','post'],'users/company/add','admin\Users@addEditCompany');
	Route::match(['get','post'],'users/company/edit/{id}','admin\Users@addEditCompany');
	Route::get('users/company/{id}','admin\Users@viewCompany');
	Route::delete('company/delete','admin\Users@deleteCompany');

	/* cms */
	/* job categories */
	Route::match(['get','post'],'cms/category','admin\Cms@viewCategories');
	Route::match(['get','post'],'cms/alljobs','admin\Cms@viewjobs');
	Route::match(['get','post'],'cms/publishjobs','admin\Cms@publishjobs');
	Route::match(['get','post'],'cms/draftjobs','admin\Cms@draftjobs');
	Route::post('cms/category/save','admin\Cms@saveCategory');
	Route::get('cms/category/get/{id}','admin\Cms@getCategory');
	Route::delete('cms/category/delete','admin\Cms@deleteCategory');
	Route::match(['get','post'],'cms/category/{id}','admin\Cms@viewSubCategories');
	Route::post('cms/sub-category/save','admin\Cms@saveSubCategory');
	Route::get('cms/sub-category/get/{id}','admin\Cms@getSubCategory');
	Route::delete('cms/sub-category/delete','admin\Cms@deleteSubCategory');
	Route::match(['get','post'],'cms/category/sub/{id}','admin\Cms@viewSubCategories2');
	Route::post('cms/sub-category/save2','admin\Cms@saveSubCategory2');
	Route::get('cms/sub-category/get/{id}/{id2}','admin\Cms@getSubCategory');
	Route::delete('cms/sub-category/delete','admin\Cms@deleteSubCategory');

	/* job shift */
	Route::match(['get','post'],'cms/shift','admin\Cms@viewJobShift');
	Route::post('cms/shift/save','admin\Cms@saveJobShift');
	Route::get('cms/shift/get/{id}','admin\Cms@getJobShift');
	Route::delete('cms/shift/delete','admin\Cms@deleteJobShift');

	/* job type */
	Route::match(['get','post'],'cms/jobtype','admin\Cms@viewJobType');
	Route::post('cms/jobtype/save','admin\Cms@saveJobType');
	Route::get('cms/jobtype/get/{id}','admin\Cms@getJobType');
	Route::delete('cms/jobtype/delete','admin\Cms@deleteJobType');

	/* Package Plan */
	Route::match(['get','post'],'cms/plan','admin\Cms@viewplan');
	Route::post('cms/plan/save','admin\Cms@saveplan');
	Route::get('cms/plan/get/{id}','admin\Cms@getplan');
	Route::delete('cms/plan/delete','admin\Cms@deleteplan');
	Route::get('cms/plan/get','admin\Cms@allpackage');
	Route::get('cms/plan/resume','admin\Cms@resumepackage');
	Route::get('cms/plan/jobpckg','admin\Cms@jobspackage');
	Route::post('cms/pckgstatupdate','admin\Cms@pckgstatupdate');
	
	/* upskill type */
	Route::match(['get','post'],'cms/upskilltype','admin\Cms@viewupskillType');
	Route::post('cms/upskilltype/save','admin\Cms@saveupskillType');
	Route::get('cms/upskilltype/get/{id}','admin\Cms@getupskillType');
	Route::delete('cms/upskill/delete','admin\Cms@deleteupskillType');

	/* pages */
	Route::get('cms/pages','admin\Cms@viewPages');
	Route::match(['get','post'],'cms/pages/new','admin\Cms@addEditPage');
	Route::match(['get','post'],'cms/pages/edit/{id}','admin\Cms@addEditPage');
	Route::delete('cms/pages/delete','admin\Cms@deletePage');
	/* Aprove Writing*/
	Route::get('cms/aprovewriting','admin\Cms@writing');
	Route::post('cms/writestatupdate','admin\Cms@writestatupdate');
	Route::post('cms/jobstatupdate','admin\Cms@jobstatupdate');
	Route::post('cms/viewwriting','admin\Cms@viewwriting');
	Route::post('cms/deletewriting','admin\Cms@deletewriting');
	/*Aprove Upskills*/
	Route::get('cms/aproveskills','admin\Cms@upskills');
	Route::post('cms/viewskill','admin\Cms@viewskill');
	Route::post('cms/deleteskill','admin\Cms@deleteskill');
	Route::post('cms/upskillstatupdate','admin\Cms@upskillstatupdate');
	/*profile pic*/
	
});

/* frontend */
Route::match(['post','get'],'/subscribe', 'frontend\Home@subscribe');
Route::get('/', 'frontend\Home@home');
Route::get('notification', 'frontend\Home@getjobnotifications');
Route::match(['get','post'],'contact','frontend\Home@contactUs');
Route::get('about','frontend\Home@aboutUs');
Route::get('terms-conditions','frontend\Home@termConditions');
Route::get('privacy-policy','frontend\Home@privacyPolicy');
Route::get('companies-advertisement','frontend\Home@advertisement');
Route::get('picture-policy','frontend\Home@picturepolicy');
Route::get('refund-policy','frontend\Home@refundPolicy');
Route::get('howtouse','frontend\Home@howtouse');
Route::get('review-write','frontend\Home@ReviewWrite');
Route::get('video-chat-policy','frontend\Home@videochatpolicy');
Route::match(['get','post'],'account/login','frontend\Home@accountLogin');
Route::match(['get','post'],'account/register','frontend\Home@accountRegister');
Route::get('account/logout','frontend\Home@logout');
Route::get('account/manage','frontend\Home@manageUser');
Route::match(['get','post'],'account/people','frontend\Home@people');
Route::match(['get','post'],'account/peoples','frontend\Home@peoples');
Route::match(['get','post'],'learn','frontend\Home@learn');
Route::match(['get','post'],'read','frontend\Home@read');
Route::get('read/article/{id}','frontend\Home@viewArticle');
Route::get('learn/{id}','frontend\Home@viewUpskill');
Route::get('learn/course/{id}','frontend\Home@viewUpskill');
Route::get('learn/seminar/{id}','frontend\Home@viewUpskill');
Route::get('learn/training/{id}','frontend\Home@viewUpskill');
Route::get('learn/webinar/{id}','frontend\Home@viewUpskill');
Route::get('learn/workshop/{id}','frontend\Home@viewUpskill');
Route::get('learn/exhibition/{id}','frontend\Home@viewUpskill');
Route::get('learn/seminar · exhibition · webinar/{id}','frontend\Home@viewUpskill');
Route::get('learn/forum · conference/{id}','frontend\Home@viewUpskill');
Route::get('learn/training · workshop/{id}','frontend\Home@viewUpskill');
Route::get('learn/course · education · academy/{id}','frontend\Home@viewUpskill');
Route::get('learn/contest · show/{id}','frontend\Home@viewUpskill');
Route::match(['get','post'],'learn/search','frontend\Home@searchSkills');
Route::match(['get','post'],'companies','frontend\Home@companies');
Route::get('companies/company/{id}','frontend\Home@viewCompany');
Route::post('sendquery','frontend\Home@sendquery');

Route::group(['prefix' => 'account'], function () {
	/* generals */
	Route::post('jobs/status','frontend\Employer@jobstatsupdate');
	Route::post('feedback','frontend\Home@feedback');
	Route::post('employer/questionnaires/new','frontend\Employer@addquestionaires');
	Route::post('employer/questionnaires/delete','frontend\Employer@deletequestionaires');
	Route::post('employer/questionnaires/question/new','frontend\Employer@addquestion');
	Route::post('employer/questionnaires/question/delete','frontend\Employer@deletequestion');
	Route::get('employer/questionnaires','frontend\Employer@questionnaires');
	Route::get('employer/questionnaires/edit/{id}','frontend\Employer@editquestionnaires');
	/* evaluation routes*/
	Route::post('employer/evaluation/new','frontend\Employer@addquestionaires');
	Route::post('employer/evaluation/delete','frontend\Employer@deleteevaluationques');
	Route::post('employer/evaluation/question/new','frontend\Employer@addevaluationquestion');
	Route::post('employer/evaluation/question/delete','frontend\Employer@deletequestion');
	Route::get('employer/evaluation','frontend\Employer@evaluation');
	Route::get('employer/evaluation/edit/{id}','frontend\Employer@editevaluation');
	/*end evalutation routes*/
	Route::post('employer/savecompic','frontend\Home@savecompic');
	Route::get('writings','frontend\ExtraSkills@writings');
	Route::match(['get','post'],'writings/article/add','frontend\ExtraSkills@addEditArticle');
	Route::match(['get','post'],'writings/article/edit/{id}','frontend\ExtraSkills@addEditArticle');
	Route::post('writings/article/delete','frontend\ExtraSkills@deleteArticle');
	Route::post('writenicepay','frontend\ExtraSkills@writenicepay');
	Route::post('employer/questionnaire/answer','frontend\Employer@questionnaireAnswer');

	Route::get('upskill','frontend\ExtraSkills@upskill');
	Route::match(['get','post'],'upskill/add','frontend\ExtraSkills@addEditUpskill');
	Route::match(['get','post'],'upskill/edit/{id}','frontend\ExtraSkills@addEditUpskill');
	Route::get('upskill/delete/{id}','frontend\ExtraSkills@deleteUpskill');
	Route::post('upskillnicepay','frontend\ExtraSkills@upskillnicepay');
	Route::post('manage/removeProPic','frontend\Jobseeker@removeProPic');
	/* job seeker */
    Route::get('jobseeker','frontend\Jobseeker@home');
    Route::get('jobseeker/resume','frontend\Jobseeker@resume');
    Route::post('jobseeker/resume/personal/save','frontend\Jobseeker@savePersonalInfo');
    Route::get('get-state/{id}','frontend\Jobseeker@getState');
    Route::get('get-city/{id}','frontend\Jobseeker@getCity');
    Route::get('get-subCategory/{id}','frontend\Jobseeker@getSubCategory');
	Route::get('get-subCategory2/{id}','frontend\Jobseeker@getSubCategory2');
    Route::post('jobseeker/resume/academic/save','frontend\Jobseeker@saveAcademic');
    Route::get('jobseeker/resume/get/{id}','frontend\Jobseeker@getResume');
    Route::get('jobseeker/resume/delete/{id}','frontend\Jobseeker@deleteResume');
    Route::post('jobseeker/resume/certification/save','frontend\Jobseeker@saveCertification');
    Route::post('jobseeker/resume/experience/save','frontend\Jobseeker@saveExperience');
    Route::post('jobseeker/resume/skills/save','frontend\Jobseeker@saveSkills');
	Route::post('jobseeker/resume/refer/save','frontend\Jobseeker@saverefer');
	Route::post('jobseeker/resume/affiliation/save','frontend\Jobseeker@saveaffiliation');
	Route::post('jobseeker/resume/portfolio/save','frontend\Jobseeker@saveportfolio');
	Route::post('jobseeker/resume/publish/save','frontend\Jobseeker@savepublish');
	Route::post('jobseeker/resume/project/save','frontend\Jobseeker@saveproject');
	Route::post('jobseeker/resume/language/save','frontend\Jobseeker@savelanguage');
	Route::post('jobseeker/resume/award/save','frontend\Jobseeker@saveaward');
    Route::post('jobseeker/profile/picture','frontend\Jobseeker@profilePicture');
    Route::post('password/save','frontend\Jobseeker@savePassword');
    Route::post('profile/save','frontend\Jobseeker@saveProfile');
	Route::post('jobseeker/resume/hopeworking/save','frontend\Jobseeker@savehopeworking');
	Route::post('jobseeker/resume/preference/save','frontend\Jobseeker@savepreference');
    Route::get('jobseeker/job/action','frontend\Jobseeker@jobAction');
    Route::get('jobseeker/company/action','frontend\Jobseeker@followAction');
    Route::get('jobseeker/application','frontend\Jobseeker@application');
    Route::get('jobseeker/application/{id}','frontend\Jobseeker@getApplication');
    Route::get('jobseeker/application/remove/{id}','frontend\Jobseeker@removeApplication');
    Route::get('jobseeker/interview/{id}', 'frontend\Jobseeker@showInterview');

    /* employer */
    Route::get('employer','frontend\Employer@home');
    Route::get('getprivcy','frontend\Employer@getprivacyrecord');
    Route::match(['get','post'],'employer/job/new','frontend\Employer@jobPost');
    Route::post('employer/job/save','frontend\Employer@saveJob');
    Route::get('employer/job/share/{id}','frontend\Employer@shareJob');
    Route::get('employer/application','frontend\Employer@application');
    Route::get('employer/application/{id}','frontend\Employer@getApplication');
	Route::get('employer/jobupdate/{id}','frontend\Employer@jobupdate');
	Route::post('completePayment','frontend\Employer@completePayment');

    Route::post('employer/update/application','frontend\Employer@updateApplication');
    Route::get('employer/interview-venues','frontend\Employer@interviewVenues');
    Route::post('employer/interview-venues/save','frontend\Employer@saveInterviewVeneu');
    Route::get('employer/interview-venues/get/{id}','frontend\Employer@getInterviewVenue');
    Route::get('employer/interview-venues/delete/{id}','frontend\Employer@deleteInterviewVenue');
    Route::get('employer/interview-venues/detail/{id}', 'frontend\Employer@viewInterviewVeneu');
    Route::get('employer/application/applicant/{id}','frontend\Employer@viewApplicant');
	Route::get('employer/application/candidate/{id}','frontend\Employer@viewApplicants');
	Route::post('employer/application/candidate/review','frontend\Employer@comment');
	Route::post('employer/application/candidate/offer','frontend\Employer@offerinterview');

    Route::get('employer/organization', 'frontend\Employer@organization');

    Route::post('employer/save','frontend\Employer@savdOrganization');



    Route::post('employer/organization/about', 'frontend\Employer@aboutOrganization');
	Route::post('employer/organization/map', 'frontend\Employer@mapOrganization');
    Route::post('employer/company/logo', 'frontend\Employer@companyLogo');
    Route::post('employer/company/cover', 'frontend\Employer@companyCover');
    Route::post('employer/application/interview/save', 'frontend\Employer@saveJobInterview');
    Route::get('employer/departments','frontend\Employer@departments');
    Route::post('employer/department/save','frontend\Employer@saveDepartment');
    Route::get('employer/department/get/{id}','frontend\Employer@getDepartment');
    Route::get('employer/department/delete/{id}','frontend\Employer@deleteDepartment');
	Route::post('post','frontend\Employer@post');
	Route::post('packageplan','frontend\Employer@package');
	Route::post('packageinfo','frontend\Employer@packageinfo');
	Route::post('cashpackage','frontend\Employer@cashpackage');

	Route::post('nicepay', 'frontend\Employer@getresponse');
	Route::post('pckgnicepay', 'frontend\Employer@nicepaypckg');
	Route::post('cashpayment', 'frontend\Employer@cashpayment');
	Route::get('employer/delete/{id}','frontend\Employer@deletejob');
	Route::match(['get','post'],'employer/orders','frontend\Employer@orders');
	Route::get('employer/setfilter/{id}','frontend\Employer@setfilter');
	Route::get('employer/cashpayment', function () {
    return view('frontend.employer.cashpayment_detail');
});
	Route::get('employer/package_payment', function () {
    return view('frontend.employer.package_payment');
});
Route::get('employer/status/{id}', 'frontend\Employer@viewJobstatus');
Route::post('employer/form/save', 'frontend\Employer@saveEvaluation');
Route::get('employer/form/delete/{id}', 'frontend\Employer@deleteform');

	Route::get('employer/package_plan', function () {
    return view('frontend.employer.package_plan');
});
    Route::get('employer/nice', function () {
    return view('frontend.employer.nice');
});
Route::get('employer/users','frontend\Employer@addUser');
Route::post('employer/useradd','frontend\Employer@useradd');
Route::post('employer/userdel','frontend\Employer@userdel');
Route::get('employer/addevaluation', 'frontend\Employer@allform');
Route::get('employer/form/get/{id}', 'frontend\Employer@getform');



Route::get('employer/job_update/{id}','frontend\Employer@updatejob');
Route::get('employer/download','frontend\Employer@downloadusers');
Route::get('employer/advance_serach', function () {
    return view('frontend.advance-job');
});
Route::get('employer/evalution/{id}','frontend\Employer@viewCandidateEvaluation');


Route::get('employer/nicerequest', function () {
    return view('frontend.employer.nicerequest');
});
Route::get('jobseeker/userHome','frontend\Jobseeker@homefeed');
Route::post('addpost','frontend\Jobseeker@addpost');
Route::post('addcmt','frontend\Jobseeker@addcmt');
Route::post('replycmt','frontend\Jobseeker@replycmt');
Route::get('post','frontend\Jobseeker@post');
Route::post('delpost/{id}','frontend\Jobseeker@deletedata');
Route::post('delcmt/{id}','frontend\Jobseeker@deletecmt');
Route::get('editcmt/{id}','frontend\Jobseeker@editcmt');	
Route::post('like','frontend\Jobseeker@likepost');
Route::post('dislike/{id}','frontend\Jobseeker@dislike');
Route::get('post/{id}','frontend\Jobseeker@perpost');
Route::post('perlike','frontend\Jobseeker@perlikepost');
Route::post('perdislike/{id}','frontend\Jobseeker@perdislike');	
Route::post('addcmtper','frontend\Jobseeker@cmtperpost');	
Route::get('pereditcmt/{id}','frontend\Jobseeker@editcmt');	



Route::get('employer/niceresult', function () {
    return view('frontend.employer.niceresult');
});

    Route::post('notification/save','frontend\Employer@saveNotification');
    Route::post('privacy/save','frontend\Employer@savePrivacy');
});

/* jobs */
Route::get('jobs','frontend\Jobs@home');
Route::get('/ajex/products','frontend\Jobs@ajexhome');
Route::post('jobs/search','frontend\Jobs@searchJobs');

Route::match(['get','post'],'jobs/homeJobSearch','frontend\Jobs@homePageJobSerach');
Route::match(['get','post'],'jobs/{id}','frontend\Jobs@viewJob');

Route::match(['get','post'],'jobs/apply/{id}','frontend\Jobs@jobApply');

Route::get('/not-found','Home@notFound');
Route::get('/send-email','Home@sendEmail');
Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->subject('Mailgun and Laravel are awesome!');
		$message->from('no-reply@peekinternational.com', 'Job Call Me');
		$message->to('mu.cp15@gmail.com');
	});
});
 Route::get('account/jobseeker/cv','frontend\Jobseeker@convertpdf');
 Route::get('account/jobseeker/cv/{id}','frontend\Jobseeker@resume_pckg');
// Route::get('account/jobseeker/download/{id}','frontend\Jobseeker@resume_pckg');

Route::get('afterpayment/{id}','frontend\Home@after_payment');
Route::post('makepayment','frontend\Home@make_payment');

Route::get('career-tab', function () {
    return view('frontend.employer.career-tab');
});
Route::get('test', function () {
    return view('welcome');
});

Route::get('skillpayment', function () {
    return view('frontend.skillpayment');
});
Route::get('writingpayment', function () {
    return view('frontend.writingpayment');
});
Route::get('messages', function () {
    return view('frontend.employer.employerMessenger');
});
Route::post('skillcashpayment', 'frontend\ExtraSkills@cashpayment');
Route::post('writecashpayment', 'frontend\ExtraSkills@writecashpayment');

/// Package Plan ////

Route::post('packagepaypal', array('as' => 'addmoney.packagepaypal','uses' => 'frontend\Employer@packagePayment',));
Route::get('packagepaypal', array('as' => 'payment.packagestatus','uses' => 'frontend\Employer@packageStatus',));



//upskill
Route::post('skillpaypal', array('as' => 'addmoney.skillpaypal','uses' => 'frontend\ExtraSkills@postPayment',));
Route::get('skillpaypal', array('as' => 'payment.skillstatus','uses' => 'frontend\ExtraSkills@getStatus',));

Route::post('writepaypal', array('as' => 'addmoney.writepaypal','uses' => 'frontend\ExtraSkills@writePayment',));
Route::get('writepaypal', array('as' => 'payment.writestatus','uses' => 'frontend\ExtraSkills@writeStatus',));
Route::get('account/employer/job/share', array('as' => 'addmoney.account/employer/job/share','uses' => 'frontend\Employer@jobupdate',));
Route::post('employer/update', array('as' => 'addmoney.paypal','uses' => 'frontend\Employer@update',));
Route::get('employer/update', array('as' => 'payment.edit','uses' => 'frontend\Employer@updateStatus',));

Route::get('account/employer/job/share', array('as' => 'addmoney.account/employer/job/share','uses' => 'frontend\Employer@payWithPaypal',));
Route::get('account/employer/payment', array('as' => 'addmoney.account/employer/payment','uses' => 'frontend\Employer@payWithPaypals',));
Route::post('paypals', array('as' => 'addmoney.paypals','uses' => 'frontend\Employer@postPaymentWithpaypals'));
Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'frontend\Employer@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'payment.status','uses' => 'frontend\Employer@getPaymentStatus',));


Route::post('updatepaypals', array('as' => 'addmoney.updatepaypals','uses' => 'frontend\Employer@updatepostPaymentWithpaypals'));
Route::post('updatepaypal', array('as' => 'addmoney.update','uses' => 'frontend\Employer@updatepostPaymentWithpaypal',));
Route::get('updatepaypal', array('as' => 'payment.updatestatus','uses' => 'frontend\Employer@updategetPaymentStatus',));


Route::get('/fbApi', 'SocialAuthFacebookController@fbApi');
Route::get('/fbCallback/{provider?}', 'SocialAuthFacebookController@callback');

Route::get('/googleApi', 'SocialAuthFacebookController@googleApi');
Route::get('/googleCallback/{provider?}', 'SocialAuthFacebookController@gCallback');

Route::get('/instaApi', 'SocialAuthFacebookController@instaApi');
Route::get('/instaCallback/{provider?}', 'SocialAuthFacebookController@instaCallback');

Route::get('/lnApi', 'SocialAuthFacebookController@lnApi');
Route::get('/lnCallback/{provider?}', 'SocialAuthFacebookController@lnCallback');
Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::post('jobCallMePayResult','Home@jobCallMePayResult');
Route::get('/paymentCompleted', 'Home@paymentCompleted');

Route::get('/testCron', 'Home@testCron'); 
Route::get('nice', function () {
    return view('frontend.nice');
});
Route::get('/safety', function () {
    return view('frontend.neverpay');
});
//Language 
Route::get('locale', function () {
    return \App::getLocale();
});

Route::get('/locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});
/* muhammad sajid routes */
Route::get('account/employeer/companies/company/review', 'frontend\Employer@companyreview');
Route::get('account/employeer/companies/company/delete/{id}', 'frontend\Employer@deletecompanyreview');
Route::post('account/employer/company/addreview', 'frontend\Employer@addreview');
Route::post('sajid', 'frontend\Jobseeker@downloadmulticv');
Route::post('delcv', 'frontend\Jobseeker@deletedownloadedcv');
Route::post('evaluation/candidate/save','frontend\Employer@candidateEvaluation');
Route::post('jobseeker/resume/review/delete','frontend\Employer@deleteResumeReview');
Route::post('jobseeker/resume/offer/delete','frontend\Employer@deleteoffer');
/* comment system url */
Route::post('read/article/comment/save','sajidController@savecomment');
Route::get('employer/status/reviews/{id}','sajidController@jobreviews');
Route::get('employer/status/offer/all','sajidController@offersinterview');
Route::get('jobseeker/status/offer/all','sajidController@offers_interview');
/*comment delete url*/
Route::post('delete/record','sajidController@delete');
Route::post('update/record','sajidController@update');
Route::post('offerdelete/record','sajidController@offerdelete');
Route::post('offerupdate/record','sajidController@offerupdate');