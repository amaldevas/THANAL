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

// Admin routes
// ------------------------


$route['facebook_test'] = 'Testing/facebook';



$route['admin/login'] = 'AdminController/adminLogin';
$route['admin/password-change/(:any)/(:any)'] = 'AdminController/adminPasswordChangeLink';
$route['admin/password-resend'] = 'AdminController/adminPasswordResend';
$route['admin/logout'] = 'AdminController/adminLogout';
$route['admin/birthday'] = 'AdminController/showBirthday';
$route['admin/forgot-password'] = 'AdminController/adminForgotPass';
$route['admin/password-change'] = 'AdminController/adminPasswordChange';
$route['admin/password-change-do'] = 'AdminController/adminPasswordChangeDo';

$route['admin/list-inmate'] = 'AdminController/showInmateList';
$route['admin/get-inmate-medicine'] = 'AdminController/sendInmateMedicine';
$route['admin/delete-inmate/(:num)'] = 'AdminController/deleteInmate';
$route['admin/add-inmate'] = 'AdminController/showAdminAddInmate';
$route['admin/inmate-search-medicine'] = 'AdminController/showInmateSearchMedicine';
$route['admin/inmate-add-medicine/(:num)'] = 'AdminController/showInmateAddMedicine';
$route['admin/create-inmate'] = 'AdminController/showAdminCreateInmate';
$route['admin/inmate-edit/(:num)'] = 'AdminController/inmateEdit';
$route['admin/update-inmate/(:num)'] = 'AdminController/updateAdminInmate';
$route['admin/search-results'] = 'AdminController/searchResults';
$route['admin/inmate-profile/(:num)'] = 'AdminController/profileInmate';

// Admin Staff Management
// -----------------------
$route['admin/add-staff'] = 'AdminController/showAdminAddStaff';
$route['admin/update-staff/(:num)'] = 'AdminController/updateAdminStaff';
$route['admin/staff-profile/(:num)'] = 'AdminController/showStaffProfile';
$route['admin/staff-edit/(:num)'] = 'AdminController/editAdminStaff';
$route['admin/create-staff'] = 'AdminController/createAdminStaff';
$route['admin/add-staff-type'] = 'AdminController/showAdminAddStaffType';
$route['admin/staff-type-edit/(:num)'] = 'AdminController/showStaffTypeEdit';
$route['admin/edit-staff-type/(:num)'] = 'AdminController/editStaffList';
$route['admin/delete-staff-type/(:num)'] = 'AdminController/deleteStaffList';
$route['admin/delete-staff/(:num)'] = 'AdminController/deleteStaff';
$route['admin/staff-type-modify/(:num)'] = 'AdminController/saveStaffTypeModify';
$route['admin/list-staff'] = 'AdminController/staffList';
$route['admin/staff-type'] = 'AdminController/staffType';
$route['admin/get-message'] = 'AdminController/getMessageId';
$route['admin/edit-staff/(:num)'] = 'AdminController/editAdminStaff';
$route['admin/staff-detail'] = 'AdminController/staffDetail';
$route['admin/create-message'] = 'AdminController/createMessage';
$route['admin/create-staff-type'] = 'AdminController/createStaffType';
// delete staff
// disable staff

// Admin Medicine Management
// ----------------------------
$route['admin/add-medicine'] = 'AdminController/showAdminAddMedicine';
$route['admin/medicine-schedule-history'] = 'AdminController/showMedicineScheduleHistory';
$route['admin/shift-history'] = 'AdminController/showShiftHistory';
$route['admin/medicine-delete/(:num)'] = 'AdminController/deleteMedicine';
$route['admin/medicine-create'] = 'AdminController/medicineCreate';
$route['admin/list-medicine'] = 'AdminController/medicineList';
$route['admin/medicine-order'] = 'AdminController/medicineOrder';
$route['admin/medicine-edit/(:num)'] = 'AdminController/medicineEdit';
$route['admin'] = 'AdminController/adminLogin';
$route['admin/dashboard'] = 'AdminController/adminDash';
$route['admin/get-result'] = 'AdminController/getResult';
$route['admin/medicine-update/(:num)'] = 'AdminController/medicineUpdate';

// Admin Guardian Management
// ----------------------------
$route['admin/list-guardian'] = 'AdminController/guardianList';
$route['admin/guardian-delete/(:num)'] = 'AdminController/deleteguardian';
$route['admin/guardian-create'] = 'AdminController/createAdminGuardian';
$route['admin/guardian-edit/(:num)'] = 'AdminController/editGuardian';
$route['admin/guardian-profile/(:num)'] = 'AdminController/profileGuardian';
$route['admin/guardian-update/(:num)'] = 'AdminController/guardianUpdate';
$route['admin/add-guardian'] = 'AdminController/showAdminAddguardian';

// Inmate Routes
// ---------------------


// Admin Shift Management
// -----------------------

$route['admin/shift'] = 'AdminController/getShiftDetails';
$route['admin/add-shift'] = 'AdminController/showAdminAddShift';
$route['admin/shift-edit/(:num)'] = 'AdminController/showAdminEditShift';
$route['admin/delete-shift/(:num)'] = 'AdminController/deleteShift';




// Admin Duty Management
// -----------------------

$route['admin/duty'] = 'AdminController/listDuty';
$route['admin/duty-assign'] = 'AdminController/dutyAssign';





// Guardian Routes
// ------------------
$route['guardian/login'] = 'GuardianController/loginGuardian';
$route['guardian/update'] = 'GuardianController/guardianUpdate';
$route['guardian/edit'] = 'GuardianController/editGuardian';
$route['guardian/list-medicine'] = 'GuardianController/medicineList';
$route['guardian/logout'] = 'GuardianController/guardianLogout';
$route['guardian/dashboard'] = 'GuardianController/dashboardGuardian';
$route['guardian/forgot-password'] = 'GuardianController/forgotPasswordGuardian';
$route['guardian/get-message'] = 'GuardianController/getMessageId';
$route['guardian/profile'] = 'GuardianController/showGuardianProfile';
$route['guardian/inmate-profile'] = 'GuardianController/showInmateProfile';
$route['guardian/password-change'] = 'GuardianController/guardianPasswordChange';
$route['guardian/password-change-do'] = 'GuardianController/guardianPasswordChangeDo';
$route['guardian/get-message'] = 'GuardianController/getMessageId';
$route['guardian/create-message'] = 'GuardianController/createMessage';
$route['guardian/get-result'] = 'GuardianController/getResult';
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Test Routes - Need to be removed before deployment
$route['sample'] = 'AdminController/showSample';


//Facebook

$route['facebook'] = 'FacebookController/facebook';



                                     // Routes For Staff:
//.............................................................................................

 //Routes For Login Change ,Forgot paasword details:
//.................................................

$route['staff/login'] = 'StaffController/loginStaff';
$route['staff/logout'] = 'StaffController/logoutStaffsession';
$route['staff/forgot-password'] = 'StaffController/forgotpasswordStaff';
$route['staff/password-change/(:any)/(:any)'] = 'StaffController/staffPasswordChangeLink';
$route['staff/password-resend'] = 'StaffController/staffPasswordResend';
$route['staff/change-password'] = 'StaffController/changePasswordStaff';
$route['staff/password-change-do'] = 'StaffController/staffPasswordChangeDo';
$route['staff/search-results'] = 'StaffController/searchResults';
$route['staff/dashboard'] = 'StaffController/dashboardStaff';

// Routes for Staff Profile details:
//..................................

$route['staff/profile'] = 'StaffController/profileStaff';
$route['staff/edit'] = 'StaffController/editStaffProfile';
$route['staff/upload-pic']='StaffController/uploadPhotoAction';
$route['staff/update-staff'] = 'StaffController/updateStaffProfile';

// Routes for Adding Inmate:
//.........................
$route['staff/create-inmate'] = 'StaffController/addInmateDo';
$route['staff/list-inmate'] = 'StaffController/listInmate';
$route['staff/addinmate'] = 'StaffController/addInmate';
$route['staff/inmate/profile/(:num)'] = 'StaffController/loginProfileInmate';
$route['staff/inmate-delete/(:num)'] = 'StaffController/deleteInmateDetails';
$route['staff/inmate-edit/(:num)'] = 'StaffController/editInmateDetails';
$route['staff/update-inmate/(:num)'] = 'StaffController/updateInmateDetails';

$route['staff/medicineSchedule'] = 'StaffController/medicineSchedule';

// Routes for Adding Guardian:
//.........................
$route['staff/list-guardian'] = 'StaffController/listGuardian';
$route['staff/create-guardian'] = 'StaffController/addGuardianDo';
$route['staff/add-guardian'] = 'StaffController/addGuardian';
$route['staff/guardian-delete/(:num)'] = 'StaffController/deleteGuardianDetails';
$route['staff/guardian-edit/(:num)'] = 'StaffController/editGuardianDetails';
$route['staff/update-guardian/(:num)'] = 'StaffController/updateGuardianDetails';
$route['staff/get-message'] = 'StaffController/getMessageId';
$route['staff/create-message'] = 'StaffController/createMessage';
$route['staff/get-result'] = 'StaffController/getResult';


// Routes for Adding Medicine :
//.........................
$route['staff/list-medicine'] = 'StaffController/listMedicine';
$route['staff/add-medicine'] = 'StaffController/addMedicine';
$route['staff/create-medicine'] = 'StaffController/addMedicineDo';
$route['staff/medicine-delete/(:num)'] = 'StaffController/deleteMedicineDetails';
$route['staff/medicine-edit/(:num)'] = 'StaffController/editMedicineDetails';
$route['staff/update-medicine/(:num)'] = 'StaffController/updateMedicineDetails';


                                  //Routes for Inmate:
//...................................................................

 //Routes For Login Change ,Forgot paasword details:
//.................................................

$route['inmate/schedule'] = 'InmateController/scheduleHistory';
$route['inmate/login'] = 'InmateController/loginInmate';
$route['inmate/medicine'] = 'InmateController/medicineList';
$route['inmate/forgot-password'] = 'InmateController/forgotpasswordInmate';
$route['inmate/change-password'] = 'InmateController/changePasswordInmate';
$route['inmate/logout'] = 'InmateController/logoutInmatesession';
$route['inmate/dashboard'] = 'InmateController/dashboardInmate';


// Routes for Staff Profile details:
//..................................

$route['inmate/profile'] = 'InmateController/profileInmate';
$route['inmate/edit-profile'] = 'InmateController/editInmateprofile';
$route['inmate/update-profile'] = 'InmateController/updateInmateProfile';
$route['inmate/get-message'] = 'InmateController/getMessageId';
$route['inmate/create-message'] = 'InmateController/createMessage';
$route['inmate/get-result'] = 'InmateController/getResult';


$route['inmate/list-staff'] = 'InmateController/listStaff';

?>