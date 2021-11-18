<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController');

    // Division
    Route::apiResource('divisions', 'DivisionApiController');

    // District
    Route::apiResource('districts', 'DistrictApiController');

    // Thana
    Route::apiResource('thanas', 'ThanaApiController');

    // Education
    Route::apiResource('education', 'EducationApiController');

    // User Category
    Route::post('user-categories/media', 'UserCategoryApiController@storeMedia')->name('user-categories.storeMedia');
    Route::apiResource('user-categories', 'UserCategoryApiController');

    // Circular
    Route::post('circulars/media', 'CircularApiController@storeMedia')->name('circulars.storeMedia');
    Route::apiResource('circulars', 'CircularApiController');

    // Academic Year
    Route::apiResource('academic-years', 'AcademicYearApiController');

    // Academic Level
    Route::apiResource('academic-levels', 'AcademicLevelApiController');

    // Government Office
    Route::apiResource('government-offices', 'GovernmentOfficeApiController');

    // Ministry Division
    Route::apiResource('ministry-divisions', 'MinistryDivisionApiController');

    // Level Wise Class
    Route::apiResource('level-wise-classes', 'LevelWiseClassApiController');

    // Institute Type
    Route::apiResource('institute-types', 'InstituteTypeApiController');

    // Educational Institute
    Route::apiResource('educational-institutes', 'EducationalInstituteApiController');

    // Discipline
    Route::apiResource('disciplines', 'DisciplineApiController');

    // Department
    Route::apiResource('departments', 'DepartmentApiController');

    // Exam Version
    Route::apiResource('exam-versions', 'ExamVersionApiController');

    // Policy
    Route::apiResource('policies', 'PolicyApiController');

    // Upazila
    Route::apiResource('upazilas', 'UpazilaApiController');

    // Union
    Route::apiResource('unions', 'UnionApiController');

    // General Info
    Route::apiResource('general-infos', 'GeneralInfoApiController');

    // Family Status
    Route::apiResource('family-statuses', 'FamilyStatusApiController');

    // Occupation
    Route::apiResource('occupations', 'OccupationApiController');

    // Documents
    Route::post('documents/media', 'DocumentsApiController@storeMedia')->name('documents.storeMedia');
    Route::apiResource('documents', 'DocumentsApiController');

    // Account Info
    Route::apiResource('account-infos', 'AccountInfoApiController');

    // Selection
    Route::apiResource('selections', 'SelectionApiController');

    // Disbursement
    Route::apiResource('disbursements', 'DisbursementApiController');

    // Institut Legal Status
    Route::apiResource('institut-legal-statuses', 'InstitutLegalStatusApiController');

    // Institute Bank Account
    Route::apiResource('institute-bank-accounts', 'InstituteBankAccountApiController');

    // Banking Type
    Route::apiResource('banking-types', 'BankingTypeApiController');

    // Final Selection
    Route::apiResource('final-selections', 'FinalSelectionApiController');

    // Final Selection Criteria
    Route::apiResource('final-selection-criteria', 'FinalSelectionCriteriaApiController');

    // Family Info
    Route::apiResource('family-infos', 'FamilyInfoApiController');

    // Education Institute Info
    Route::apiResource('education-institute-infos', 'EducationInstituteInfoApiController');

    // Payroll
    Route::apiResource('payrolls', 'PayrollApiController');

    // Payment History
    Route::apiResource('payment-histories', 'PaymentHistoryApiController');

    // Banking Service Provider
    Route::apiResource('banking-service-providers', 'BankingServiceProviderApiController');

    // Bank Branch
    Route::post('bank-branches/media', 'BankBranchApiController@storeMedia')->name('bank-branches.storeMedia');
    Route::apiResource('bank-branches', 'BankBranchApiController');

    // Application Tracking
    Route::apiResource('application-trackings', 'ApplicationTrackingApiController');
});
