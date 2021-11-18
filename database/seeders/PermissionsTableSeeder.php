<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'employee_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'setup_access',
            ],
            [
                'id'    => 24,
                'title' => 'division_create',
            ],
            [
                'id'    => 25,
                'title' => 'division_edit',
            ],
            [
                'id'    => 26,
                'title' => 'division_show',
            ],
            [
                'id'    => 27,
                'title' => 'division_delete',
            ],
            [
                'id'    => 28,
                'title' => 'division_access',
            ],
            [
                'id'    => 29,
                'title' => 'district_create',
            ],
            [
                'id'    => 30,
                'title' => 'district_edit',
            ],
            [
                'id'    => 31,
                'title' => 'district_show',
            ],
            [
                'id'    => 32,
                'title' => 'district_delete',
            ],
            [
                'id'    => 33,
                'title' => 'district_access',
            ],
            [
                'id'    => 34,
                'title' => 'thana_create',
            ],
            [
                'id'    => 35,
                'title' => 'thana_edit',
            ],
            [
                'id'    => 36,
                'title' => 'thana_show',
            ],
            [
                'id'    => 37,
                'title' => 'thana_delete',
            ],
            [
                'id'    => 38,
                'title' => 'thana_access',
            ],
            [
                'id'    => 39,
                'title' => 'education_create',
            ],
            [
                'id'    => 40,
                'title' => 'education_edit',
            ],
            [
                'id'    => 41,
                'title' => 'education_show',
            ],
            [
                'id'    => 42,
                'title' => 'education_delete',
            ],
            [
                'id'    => 43,
                'title' => 'education_access',
            ],
            [
                'id'    => 44,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 45,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 46,
                'title' => 'user_category_create',
            ],
            [
                'id'    => 47,
                'title' => 'user_category_edit',
            ],
            [
                'id'    => 48,
                'title' => 'user_category_show',
            ],
            [
                'id'    => 49,
                'title' => 'user_category_delete',
            ],
            [
                'id'    => 50,
                'title' => 'user_category_access',
            ],
            [
                'id'    => 51,
                'title' => 'alert_message_access',
            ],
            [
                'id'    => 52,
                'title' => 'institute_management_access',
            ],
            [
                'id'    => 53,
                'title' => 'circular_management_access',
            ],
            [
                'id'    => 54,
                'title' => 'circular_create',
            ],
            [
                'id'    => 55,
                'title' => 'circular_edit',
            ],
            [
                'id'    => 56,
                'title' => 'circular_show',
            ],
            [
                'id'    => 57,
                'title' => 'circular_delete',
            ],
            [
                'id'    => 58,
                'title' => 'circular_access',
            ],
            [
                'id'    => 59,
                'title' => 'academic_year_create',
            ],
            [
                'id'    => 60,
                'title' => 'academic_year_edit',
            ],
            [
                'id'    => 61,
                'title' => 'academic_year_show',
            ],
            [
                'id'    => 62,
                'title' => 'academic_year_delete',
            ],
            [
                'id'    => 63,
                'title' => 'academic_year_access',
            ],
            [
                'id'    => 64,
                'title' => 'academic_level_create',
            ],
            [
                'id'    => 65,
                'title' => 'academic_level_edit',
            ],
            [
                'id'    => 66,
                'title' => 'academic_level_show',
            ],
            [
                'id'    => 67,
                'title' => 'academic_level_delete',
            ],
            [
                'id'    => 68,
                'title' => 'academic_level_access',
            ],
            [
                'id'    => 69,
                'title' => 'government_office_create',
            ],
            [
                'id'    => 70,
                'title' => 'government_office_edit',
            ],
            [
                'id'    => 71,
                'title' => 'government_office_show',
            ],
            [
                'id'    => 72,
                'title' => 'government_office_delete',
            ],
            [
                'id'    => 73,
                'title' => 'government_office_access',
            ],
            [
                'id'    => 74,
                'title' => 'ministry_division_create',
            ],
            [
                'id'    => 75,
                'title' => 'ministry_division_edit',
            ],
            [
                'id'    => 76,
                'title' => 'ministry_division_show',
            ],
            [
                'id'    => 77,
                'title' => 'ministry_division_delete',
            ],
            [
                'id'    => 78,
                'title' => 'ministry_division_access',
            ],
            [
                'id'    => 79,
                'title' => 'level_wise_class_create',
            ],
            [
                'id'    => 80,
                'title' => 'level_wise_class_edit',
            ],
            [
                'id'    => 81,
                'title' => 'level_wise_class_show',
            ],
            [
                'id'    => 82,
                'title' => 'level_wise_class_delete',
            ],
            [
                'id'    => 83,
                'title' => 'level_wise_class_access',
            ],
            [
                'id'    => 84,
                'title' => 'institute_type_create',
            ],
            [
                'id'    => 85,
                'title' => 'institute_type_edit',
            ],
            [
                'id'    => 86,
                'title' => 'institute_type_show',
            ],
            [
                'id'    => 87,
                'title' => 'institute_type_delete',
            ],
            [
                'id'    => 88,
                'title' => 'institute_type_access',
            ],
            [
                'id'    => 89,
                'title' => 'financial_institute_management_access',
            ],
            [
                'id'    => 90,
                'title' => 'educational_institute_create',
            ],
            [
                'id'    => 91,
                'title' => 'educational_institute_edit',
            ],
            [
                'id'    => 92,
                'title' => 'educational_institute_show',
            ],
            [
                'id'    => 93,
                'title' => 'educational_institute_delete',
            ],
            [
                'id'    => 94,
                'title' => 'educational_institute_access',
            ],
            [
                'id'    => 95,
                'title' => 'discipline_create',
            ],
            [
                'id'    => 96,
                'title' => 'discipline_edit',
            ],
            [
                'id'    => 97,
                'title' => 'discipline_show',
            ],
            [
                'id'    => 98,
                'title' => 'discipline_delete',
            ],
            [
                'id'    => 99,
                'title' => 'discipline_access',
            ],
            [
                'id'    => 100,
                'title' => 'department_create',
            ],
            [
                'id'    => 101,
                'title' => 'department_edit',
            ],
            [
                'id'    => 102,
                'title' => 'department_show',
            ],
            [
                'id'    => 103,
                'title' => 'department_delete',
            ],
            [
                'id'    => 104,
                'title' => 'department_access',
            ],
            [
                'id'    => 105,
                'title' => 'exam_version_create',
            ],
            [
                'id'    => 106,
                'title' => 'exam_version_edit',
            ],
            [
                'id'    => 107,
                'title' => 'exam_version_show',
            ],
            [
                'id'    => 108,
                'title' => 'exam_version_delete',
            ],
            [
                'id'    => 109,
                'title' => 'exam_version_access',
            ],
            [
                'id'    => 110,
                'title' => 'policy_create',
            ],
            [
                'id'    => 111,
                'title' => 'policy_edit',
            ],
            [
                'id'    => 112,
                'title' => 'policy_show',
            ],
            [
                'id'    => 113,
                'title' => 'policy_delete',
            ],
            [
                'id'    => 114,
                'title' => 'policy_access',
            ],
            [
                'id'    => 115,
                'title' => 'fund_disbursement_mgt_access',
            ],
            [
                'id'    => 116,
                'title' => 'student_management_access',
            ],
            [
                'id'    => 117,
                'title' => 'upazila_create',
            ],
            [
                'id'    => 118,
                'title' => 'upazila_edit',
            ],
            [
                'id'    => 119,
                'title' => 'upazila_show',
            ],
            [
                'id'    => 120,
                'title' => 'upazila_delete',
            ],
            [
                'id'    => 121,
                'title' => 'upazila_access',
            ],
            [
                'id'    => 122,
                'title' => 'union_create',
            ],
            [
                'id'    => 123,
                'title' => 'union_edit',
            ],
            [
                'id'    => 124,
                'title' => 'union_show',
            ],
            [
                'id'    => 125,
                'title' => 'union_delete',
            ],
            [
                'id'    => 126,
                'title' => 'union_access',
            ],
            [
                'id'    => 127,
                'title' => 'general_info_create',
            ],
            [
                'id'    => 128,
                'title' => 'general_info_edit',
            ],
            [
                'id'    => 129,
                'title' => 'general_info_show',
            ],
            [
                'id'    => 130,
                'title' => 'general_info_delete',
            ],
            [
                'id'    => 131,
                'title' => 'general_info_access',
            ],
            [
                'id'    => 132,
                'title' => 'family_status_create',
            ],
            [
                'id'    => 133,
                'title' => 'family_status_edit',
            ],
            [
                'id'    => 134,
                'title' => 'family_status_show',
            ],
            [
                'id'    => 135,
                'title' => 'family_status_delete',
            ],
            [
                'id'    => 136,
                'title' => 'family_status_access',
            ],
            [
                'id'    => 137,
                'title' => 'occupation_create',
            ],
            [
                'id'    => 138,
                'title' => 'occupation_edit',
            ],
            [
                'id'    => 139,
                'title' => 'occupation_show',
            ],
            [
                'id'    => 140,
                'title' => 'occupation_delete',
            ],
            [
                'id'    => 141,
                'title' => 'occupation_access',
            ],
            [
                'id'    => 142,
                'title' => 'document_create',
            ],
            [
                'id'    => 143,
                'title' => 'document_edit',
            ],
            [
                'id'    => 144,
                'title' => 'document_show',
            ],
            [
                'id'    => 145,
                'title' => 'document_delete',
            ],
            [
                'id'    => 146,
                'title' => 'document_access',
            ],
            [
                'id'    => 147,
                'title' => 'account_info_create',
            ],
            [
                'id'    => 148,
                'title' => 'account_info_edit',
            ],
            [
                'id'    => 149,
                'title' => 'account_info_show',
            ],
            [
                'id'    => 150,
                'title' => 'account_info_delete',
            ],
            [
                'id'    => 151,
                'title' => 'account_info_access',
            ],
            [
                'id'    => 152,
                'title' => 'selection_create',
            ],
            [
                'id'    => 153,
                'title' => 'selection_edit',
            ],
            [
                'id'    => 154,
                'title' => 'selection_show',
            ],
            [
                'id'    => 155,
                'title' => 'selection_delete',
            ],
            [
                'id'    => 156,
                'title' => 'selection_access',
            ],
            [
                'id'    => 157,
                'title' => 'disbursement_create',
            ],
            [
                'id'    => 158,
                'title' => 'disbursement_edit',
            ],
            [
                'id'    => 159,
                'title' => 'disbursement_show',
            ],
            [
                'id'    => 160,
                'title' => 'disbursement_delete',
            ],
            [
                'id'    => 161,
                'title' => 'disbursement_access',
            ],
            [
                'id'    => 162,
                'title' => 'institut_legal_status_create',
            ],
            [
                'id'    => 163,
                'title' => 'institut_legal_status_edit',
            ],
            [
                'id'    => 164,
                'title' => 'institut_legal_status_show',
            ],
            [
                'id'    => 165,
                'title' => 'institut_legal_status_delete',
            ],
            [
                'id'    => 166,
                'title' => 'institut_legal_status_access',
            ],
            [
                'id'    => 167,
                'title' => 'institute_bank_account_create',
            ],
            [
                'id'    => 168,
                'title' => 'institute_bank_account_edit',
            ],
            [
                'id'    => 169,
                'title' => 'institute_bank_account_show',
            ],
            [
                'id'    => 170,
                'title' => 'institute_bank_account_delete',
            ],
            [
                'id'    => 171,
                'title' => 'institute_bank_account_access',
            ],
            [
                'id'    => 172,
                'title' => 'banking_type_create',
            ],
            [
                'id'    => 173,
                'title' => 'banking_type_edit',
            ],
            [
                'id'    => 174,
                'title' => 'banking_type_show',
            ],
            [
                'id'    => 175,
                'title' => 'banking_type_delete',
            ],
            [
                'id'    => 176,
                'title' => 'banking_type_access',
            ],
            [
                'id'    => 177,
                'title' => 'final_selection_create',
            ],
            [
                'id'    => 178,
                'title' => 'final_selection_edit',
            ],
            [
                'id'    => 179,
                'title' => 'final_selection_show',
            ],
            [
                'id'    => 180,
                'title' => 'final_selection_delete',
            ],
            [
                'id'    => 181,
                'title' => 'final_selection_access',
            ],
            [
                'id'    => 182,
                'title' => 'pmeat_approval_access',
            ],
            [
                'id'    => 183,
                'title' => 'recommendation_access',
            ],
            [
                'id'    => 184,
                'title' => 'final_selection_criterion_create',
            ],
            [
                'id'    => 185,
                'title' => 'final_selection_criterion_edit',
            ],
            [
                'id'    => 186,
                'title' => 'final_selection_criterion_show',
            ],
            [
                'id'    => 187,
                'title' => 'final_selection_criterion_delete',
            ],
            [
                'id'    => 188,
                'title' => 'final_selection_criterion_access',
            ],
            [
                'id'    => 189,
                'title' => 'family_info_create',
            ],
            [
                'id'    => 190,
                'title' => 'family_info_edit',
            ],
            [
                'id'    => 191,
                'title' => 'family_info_show',
            ],
            [
                'id'    => 192,
                'title' => 'family_info_delete',
            ],
            [
                'id'    => 193,
                'title' => 'family_info_access',
            ],
            [
                'id'    => 194,
                'title' => 'education_institute_info_create',
            ],
            [
                'id'    => 195,
                'title' => 'education_institute_info_edit',
            ],
            [
                'id'    => 196,
                'title' => 'education_institute_info_show',
            ],
            [
                'id'    => 197,
                'title' => 'education_institute_info_delete',
            ],
            [
                'id'    => 198,
                'title' => 'education_institute_info_access',
            ],
            [
                'id'    => 199,
                'title' => 'payroll_create',
            ],
            [
                'id'    => 200,
                'title' => 'payroll_edit',
            ],
            [
                'id'    => 201,
                'title' => 'payroll_show',
            ],
            [
                'id'    => 202,
                'title' => 'payroll_delete',
            ],
            [
                'id'    => 203,
                'title' => 'payroll_access',
            ],
            [
                'id'    => 204,
                'title' => 'payment_history_create',
            ],
            [
                'id'    => 205,
                'title' => 'payment_history_edit',
            ],
            [
                'id'    => 206,
                'title' => 'payment_history_show',
            ],
            [
                'id'    => 207,
                'title' => 'payment_history_delete',
            ],
            [
                'id'    => 208,
                'title' => 'payment_history_access',
            ],
            [
                'id'    => 209,
                'title' => 'banking_service_provider_create',
            ],
            [
                'id'    => 210,
                'title' => 'banking_service_provider_edit',
            ],
            [
                'id'    => 211,
                'title' => 'banking_service_provider_show',
            ],
            [
                'id'    => 212,
                'title' => 'banking_service_provider_delete',
            ],
            [
                'id'    => 213,
                'title' => 'banking_service_provider_access',
            ],
            [
                'id'    => 214,
                'title' => 'bank_branch_create',
            ],
            [
                'id'    => 215,
                'title' => 'bank_branch_edit',
            ],
            [
                'id'    => 216,
                'title' => 'bank_branch_show',
            ],
            [
                'id'    => 217,
                'title' => 'bank_branch_delete',
            ],
            [
                'id'    => 218,
                'title' => 'bank_branch_access',
            ],
            [
                'id'    => 219,
                'title' => 'application_tracking_create',
            ],
            [
                'id'    => 220,
                'title' => 'application_tracking_edit',
            ],
            [
                'id'    => 221,
                'title' => 'application_tracking_show',
            ],
            [
                'id'    => 222,
                'title' => 'application_tracking_delete',
            ],
            [
                'id'    => 223,
                'title' => 'application_tracking_access',
            ],
            [
                'id'    => 224,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
