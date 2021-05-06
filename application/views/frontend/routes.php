<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|  example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|  https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|  $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|  $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|  $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:  my-controller/index  -> my_controller/index
|    my-controller/my-method  -> my_controller/my_method
*/
$route['default_controller']   = 'frontend/index';
$route['404_override']         = 'common/PageNotFound';
$route['translate_uri_dashes'] = FALSE;

/*******************************************************************
| Instructor Admin Panel
| Routes Definations 
********************************************************************/

//$route['site'] = 'frontend/index';
$route['login']                 = 'login/checkAdminLogin';
$route['logout']                = 'common/Logout';
$route['signup']                = 'frontend/StudentSignup';
$route['about']                 = 'frontend/about';
$route['pricing']               = 'frontend/pricing';
$route['modules']               = 'frontend/allModules';
$route['placements']            = 'frontend/placements';
$route['contact']               = 'frontend/contact';
$route['course/details/(:any)'] = 'frontend/singleModuleDetails';
$route['view-cart']             = 'frontend/viewCartPage';
$route['send/enquiry']          = 'frontend/sendEnquiry';
$route['getdistrict']           = 'frontend/getDistrict';
$route['newstudentAjaxcall']    = 'frontend/createNewStudentAjaxCall';
$route['checkemail']            = 'frontend/StudentCheckEmail';
$route['allcourses']            = 'frontend/allcourses';
$route['whyipb']                = 'frontend/whyipb';
$route['how_it_works']          = 'frontend/how_it_works';
$route['faq']                   = 'frontend/faq';
$route['vision']                = 'frontend/vision';
$route['mission']               = 'frontend/mission';
$route['banking-as-career']     = 'frontend/bankingAsCareer';
$route['all/courses']           = 'frontend/coursesforbankers';
$route['complete-package']      = 'frontend/complete_package';
// razorpay payment gateway.
$route['razorpay']              = 'razorpay/index';
$route['checkout/(:any)']       = 'razorpay/checkout';
//Student login/registration from checkout page 
$route['check/ifuserexists']    = 'frontend/ifuserexists';
$route['sendotp']               = 'frontend/loginVerification';
$route['check-out/(:any)']      = 'razorpay/loginregistercheckout';



/*******************************************************************
| Superadmin Admin Panel
| Routes Definations 
********************************************************************/

$route['admin']                 = 'login/checkAdminLogin';
$route['admin/logout']          = 'common/Logout';
$route['recover/password']      = 'login/recoverPassword';
$route['admin/account']         = 'adminDashboard/LoginUserDetails';
$route['admin/home']            = 'adminDashboard/index';
$route['updateRequestPath']     = 'adminDashboard/UpdateLoggedInUserDetails';
$route['admin/update/details']  = 'adminDashboard/UpdateAdminDetails';
$route['admin/update/password'] = 'adminDashboard/UpdateAdminPassword';
$route['admin/update/image']    = 'adminDashboard/UpdateAdminImage';

/*
 * Instructor Management Routes
 */
$route['instructor/list']           = 'instructor/listAllInstructors';
$route['instructor/create']         = 'instructor/createNewInstructor';
$route['instructor/checkemail']     = 'instructor/uniqueEmailID';
$route['instructor/delete']         = 'instructor/deleteInstructor_byID';
$route['instructor/profile/(:any)'] = 'instructor/SingleInstructorDetails';
$route['instructor/update/(:any)']  = 'instructor/UpdateInstructorDetails';

/*
 * Module Management Routes
 */
$route['module/list']          = 'modules/listAllModules';
$route['module/create']        = 'modules/createNewModule';
$route['module/update/(:any)'] = 'modules/UpdateModuleDetails';
$route['module/delete']        = 'modules/deleteModule';
$route['module/detail/(:any)'] = 'modules/single_moduleDetail';

/*
 * Final Exam Management Routes
 */
$route['finalexam/settings'] = 'modules/FinalexamDefaultSettings';
$route['finalexam/create']   = 'modules/createNewInstructor';
$route['finalexam/update']   = 'modules/UpdateInstructorDetails';

/*
 * Chapter Management Routes
 */
$route['chapter/list']                  = 'chapters/listAllChapters';
$route['chapter/create']                = 'chapters/createNewChapter';
$route['chapter/update/(:any)']         = 'chapters/UpdateChapterDetails';
$route['chapter/details/(:any)']        = 'chapters/singleChapterDetails';
$route['chapter/discussionform/(:any)'] = 'chapters/singleDiscussionforum';
$route['chapter/delete']                = 'chapters/deleteChapter';

/*
 * Chapter Questions Management Routes
 */
$route['question/create']        = 'chapters/CreateChapterQuestions';
$route['question/delete']        = 'chapters/DeleteChapterQuestions';
$route['question/update/(:any)'] = 'chapters/updateChapterQuestion';

/*
 * Chapter Questions Management Routes
 */
$route['module_question/create']        = 'modules/CreateModulesQuestions';
$route['module_question/delete']        = 'modules/DeleteModuleQuestions';
$route['module_question/update/(:any)'] = 'modules/UpdateModuleQuestions';

/*
 * Chapter Test Management Routes
 */
$route['chapter/test/details'] = 'chapters/ChapterTestDefaultSettings';
$route['chapter/test/create']  = 'chapters/createNewChapterTest';
$route['chapter/test/update']  = 'chapters/UpdateChapterTestDetails';

/*
 * Students Management Routes
 */
$route['student/list']                  = 'student/listAllStudents';
$route['student/profile/(:any)']        = 'student/SingleStudentProfile';
$route['student/create']                = 'student/CreateStudentProfile';
$route['student/checkemail']            = 'student/uniqueEmailID';
$route['student/update/(:any)']         = 'student/UpdateStudentProfile';
$route['complete-package/list']         = 'student/CompletePackageStudentList';
$route['complete-package/result']       = 'student/CompletePackageStudentResult';
/*
 * Reports Routes
 */
$route['reports/sales']                 = 'Reports/SalesReport';
$route['reports/getfiltersales']        = 'Reports/getFilterSales';
$route['reports/student/badge']         = 'Reports/StudentBadgeReport';
$route['reports/student/module']        = 'Reports/StudentModulesReport';
$route['invoice/details/(:any)']        = 'Reports/GetInvoiceDetails';
$route['reports/transaction']           = 'Reports/TransactionsReport';
$route['reports/getfiltertransactions'] = 'Reports/getFilterTransactions';
$route['reports/enquery']               = 'Reports/EnqueryReport';
$route['reports/getfilterenquiries']    = 'Reports/GetFilterEnquiries';
$route['reports/getenquerylinechart']   = 'Reports/getEnquiryLineChartContent';

/*
 * Contact Form Management Routes
 */
$route['contact/list']  = 'adminDashboard/listAllContactRequests';
$route['contact/reply'] = 'adminDashboard/ReplyToContactRequest';

/*
 * Enquery Form Management Routes
 */
$route['enquery/list']  = 'adminDashboard/GetAllEnquiries';
$route['enquery/reply'] = 'adminDashboard/SendEnqueryResponse';

/*
 * Other Settings Management Routes
 */
$route['settings/monthly/expenses']  = 'settings/MonthlyExpenses';
$route['settings/invoice/details']   = 'settings/InvoiceDetails';
$route['settings/faq']               = 'settings/FAQ';
$route['settings/faq/create']        = 'settings/FAQ';
$route['settings/faq/update/(:any)'] = 'settings/updateFAQ';
$route['settings/downloads']         = 'settings/DownloadableContent';
$route['settings/downloads/create']  = 'settings/SaveDownloadableFile';
$route['settings/downloads/delete']  = 'settings/DeleteFile';


/*******************************************************************
| Instructor Admin Panel
| Routes Definations 
********************************************************************/

$route['instructor/home']                       = 'instructorPanel/index';
$route['instructor/logout']                     = 'common/Logout';
$route['instructor/account']                    = 'instructorPanel/instructorAccount';
$route['instructor/courses']                    = 'instructorPanel/getInstructorCourses';
$route['instructor/course/details/(:any)']      = 'instructorPanel/GetSingleCourseDetails';
$route['instructor/chapter/details/(:any)']     = 'instructorPanel/GetSingleChapterDetails';
$route['instructor/discussionforums']           = 'instructorPanel/getInstructorDiscussionForums';
$route['instructor/checkPassword']              = 'instructorPanel/check_currPassword';
$route['instructor/forum/details/(:any)']       = 'instructorPanel/DiscussionforumDetails';
$route['instructor/skypeInterview']             = 'instructorPanel/ScheduleSkypeInterview';
$route['instructor/checkusername']              = 'instructorPanel/check_username';
$route['instructor/workingPlan']                = 'instructorPanel/workingPlan';
$route['instructor/appointments']               = 'instructorPanel/appointmentsList';
$route['instructor/saveSchedule']               = 'instructorPanel/insertSchedule';
$route['instructor/discussions/comment/(:any)'] = 'instructorPanel/discussionsForum_comments';
$route['instructor/chapterDiscussion_comments'] = 'instructorPanel/submit_discussionComment';
$route['instructor/skypeAppointment_details']   = 'instructorPanel/skypeAppointment_details';
$route['instructor/complete-package/list']      = 'instructorPanel/CompletePackageStudentList';
$route['instructor/complete-package/result']    = 'instructorPanel/CompletePackageStudentResult';
/*******************************************************************
| Student Panel
| Routes Definations 
********************************************************************/

$route['student/logout']                  = 'common/Logout';
$route['student/home']                    = 'studentPanel/index';
$route['student/courses']                 = 'studentPanel/courseDetails';
$route['student/faqs']                    = 'studentPanel/GetFAQsDetails';
$route['student/exams']                   = 'studentPanel/GetExamsDetails';
$route['student/downloads']               = 'studentPanel/GetDownloadsData';
$route['student/payments']                = 'studentPanel/GetPaymentDetails';
$route['student/invoice/(:any)']          = 'studentPanel/GetInvoiceDetails';
$route['student/support']                 = 'studentPanel/GetSupportContent';
$route['student/results']                 = 'studentPanel/GetResultsDetails';
$route['student/forums']                  = 'studentPanel/GetDiscussionForums';
$route['student/account']                 = 'studentPanel/studentProfileDetails';
$route['check/currentpassword']           = 'studentPanel/MatchCurrentPassword';
$route['student/course/details/(:any)']   = 'studentPanel/GetSingleModuleDetails';
$route['student/read/more/(:any)']        = 'studentPanel/GetSingleModuleAllContent';
$route['student/chapter/details/(:any)']  = 'studentPanel/GetChapterDetails';
$route['student/qa']                      = 'studentPanel/qa';
$route['student/forum/details/(:any)']    = 'studentPanel/DiscussionforumDetails';
$route['student/checkusername']           = 'studentPanel/check_username';
$route['student/skypeInterview']          = 'studentPanel/ScheduleSkypeInterview';
$route['student/appointmentID']           = 'studentPanel/get_appointmentID';
$route['student/availableSlots']          = 'studentPanel/getAvailableSlots';
$route['student/chapterDiscussion']       = 'studentPanel/chapterDiscussion';
$route['chapter/title/discussion/(:any)'] = 'studentPanel/ChapterTitle_discussion';
$route['chapterDiscussion_comments']      = 'studentPanel/chapterDiscussion_comments';
$route['student/chapterTest/(:any)']      = 'studentPanel/chapter_test';
$route['student/examQuestions']           = 'studentPanel/exam_questionsDetail';
$route['student/chapterExamResult']       = 'studentPanel/chapterExam_Result';
$route['student/examAttempt']             = 'studentPanel/updateExam_attempt';
$route['student/review_module']           = 'studentPanel/addModuleReviews';
$route['check/chapterStatus']             = 'studentPanel/check_chapter_Status';
$route['student/CourseExam/(:any)']       = 'studentPanel/module_finalExam';
$route['student/finalExam']               = 'studentPanel/finalExam_questions';
$route['student/examResult/(:any)']       = 'studentPanel/finalexamResult';
$route['student/exam_status']             = 'studentPanel/update_finalExam_status';
$route['student/result']                  = 'studentPanel/final_exam_res';
$route['student/check_appointment']       = 'studentPanel/check_skypeAppointment';
$route['student/chapter_content/(:any)']  = 'studentPanel/chapter_video';

/*
 * Announcement Routes
 */
$route['announcement/headline']  = 'Announcement/headline';
$route['announcement/news']      = 'Announcement/createNews';
$route['announcement/banner']    = 'Announcement/createBanner';
$route['banner/delete']          = 'Announcement/bannerDelete';
$route['news/delete']            = 'Announcement/newsDelete';
$route['headline/delete']        = 'Announcement/headlineDelete';
$route['banner/update/(:any)']   = 'Announcement/bannerUpdate';
$route['news/update/(:any)']     = 'Announcement/newsUpdate';
$route['headline/update/(:any)'] = 'Announcement/headlineUpdate';
$route['headline/UpdateDisplay'] = 'Announcement/updateDisplay_Value';

/*
 * skype interview calendar 
 */
$route['instructor/backendResource'] = 'instructorPanel/backend_resources';

/*
 * Common Controllers 
 */
$route['common/checkusername'] = 'Common/check_username';
$route['search/(:any)']        = 'frontend/googleSearchCall';