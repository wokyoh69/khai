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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = "home";
//$route['default_controller'] = "check";
$route['404_override'] = 'error';


/*********** USER DEFINED ROUTES *******************/

$route['accountInvoice'] = "user/accountInvoice";
$route['addInvoice'] = "user/addInvoice";

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['loginHistory'] = 'user/loginHistory';
$route['inActive'] = 'user/userListing_inactive';
$route['inActive/(:num)'] = "user/userListing_inactive/$1";

$route['familyListing'] = 'user/familyListing';
$route['familyListing/(:num)'] = "user/familyListing/$1";
$route['addNew'] = "user/addNew";
$route['paymentListing'] = 'payment/paymentListing';
$route['paymentListing/(:num)'] = "payment/paymentListing/$1";
$route['paymentDetail'] = "payment/paymentDetail";
$route['paymentUpdate'] = 'payment/update';
$route['paymentUpdate/(:num)'] = "payment/update/$1";

$route['regUser'] = "register/regUser";
$route['registerMe'] = "register/registerMe";
$route['registerDetail'] = "register/registerDetail";
$route['regFamily'] = "register/regFamily";
$route['regFamilyAdd'] = "register/regFamilyAdd";
$route['regFamilyDelete/(:num)'] = "register/regFamilyDelete/$1";
$route['regKhairat'] = "user/regKhairat";

$route['checkMe'] = "check/checkMe";
$route['checkDetail'] = "check/checkDetail";
$route['applicantDetail'] = "user/applicantDetail";
$route['applicantFamilyDetail'] = "user/applicantFamilyDetail";
$route['applicantApprove'] = "user/applicantApprove";
$route['applicantReject'] = "user/applicantReject";

$route['addNewUser'] = "user/addNewUser";
$route['editUsers'] = "user/editUsers";
$route['editUsers/(:num)'] = "user/editUsers/$1";
$route['editUser'] = "user/editUser";
$route['editProfile'] = "user/editProfile";
$route['deleteUser'] = "user/deleteUser";
$route['addFamily'] = "user/addFamily";
$route['addFamilyProfile'] = "user/addFamilyProfile";
$route['deleteFamilyProfile'] = "user/deleteFamilyProfile";
$route['deleteFamily'] = "user/deleteFamily";
$route['familyDetail'] = "user/familyDetail";
$route['familyDetailMembers'] = "user/familyDetailMembers";
$route['updateFamily'] = "user/updateFamily";
$route['updateFamilyMembers'] = "user/updateFamilyMembers";
$route['addDocument'] = "user/addDocument";
$route['addDocumentUser'] = "user/addDocumentUser";
$route['deleteDocument'] = "user/deleteDocument";
$route['deleteDocumentUser'] = "user/deleteDocumentUser";
$route['addPayment'] = "payment/addPayment";
$route['deleteAllRecords'] = "user/deleteAllRecords";

//Toyyibpay
$route['paymentStatus'] = 'payment/paymentStatus';
$route['paymentUser'] = 'payment/paymentUser';
$route['FPXPayment'] = 'check/FPXPayment';
$route['FPXprocess'] = 'check/FPXprocess';
$route['FPXstatus'] = 'check/FPXstatus';


$route['downloadAll'] = "laporan/downloadAll";
$route['policy'] = "home/policy";

$route['loadChangePass'] = "user/loadChangePass";
$route['loadChangeProfile'] = "user/loadChangeProfile";
$route['changePassword'] = "user/changePassword";
$route['loadPolicy'] = "user/loadPolicy";
$route['loadWarning'] = "user/loadWarning";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:num)'] = "user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

$route['forget'] = "login/forget";
$route['forgetMe'] = "login/forgetMe";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

$route['whatsappDetail'] = "payment/whatsappDetail";
$route['whatsappSend'] = "payment/whatsappSend";
$route['saveAdminPhone'] = "whatsapp/saveAdminPhone";

$route['smsDetail'] = "sms/smsDetail";
$route['smsDetail_open'] = "sms/smsDetail_open";
$route['smsSend'] = "sms/smsSend";
$route['smsSend_bulk360'] = "sms/smsSend_bulk360";
$route['smsEwalletDetail'] = "sms/smsEwalletDetail";
$route['paymentSms'] = 'sms/paymentSms';
$route['smsStatus'] = 'sms/smsStatus';



/* End of file routes.php */
/* Location: ./application/config/routes.php */