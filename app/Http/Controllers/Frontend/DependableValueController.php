<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BankBranch;
use App\Models\District;
use App\Models\EducationalInstitute;
use App\Models\LevelWiseClass;
use App\Models\Circular;
use App\Models\Union;
use App\Models\Upazila;
use Carbon\Carbon;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;

class DependableValueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function findCircularName(Request $request)
    {

        $id = preg_replace('/[^a-z\d ]/i', '', $request->id);

        if (is_numeric($id) && $id != '')
            $data = Circular::select('reference_number', 'cirucular_name ', 'id')->whereDate('application_deadline', '<', Carbon::today()->toDateString())->where('circular_type',  $request->id)->get();
        else
            $data = '';

        return response()->json($data); //then sent this data to ajax success
    }

    public function findDistrictName(Request $request)
    {

        $id = preg_replace('/[^a-z\d ]/i', '', $request->id);

        if (is_numeric($id) && $id != '')
            $data = District::select('district_name', 'id')->where('division_name_id',  $request->id)->get();
        else
            $data = '';

        return response()->json($data); //then sent this data to ajax success
    }

    public function findUpazilaName(Request $request)
    {
        $id = preg_replace('/[^a-z\d ]/i', '', $request->id);

        if (is_numeric($id) && $id != '')
            $data = Upazila::select('upazila_name', 'id')->where('district_id', $request->id)->take(100)->get();
        else
            $data = '';
        return response()->json($data); //then sent this data to ajax success
    }

    public function findUnionName(Request $request)
    {
        $id = preg_replace('/[^a-z\d ]/i', '', $request->id);

        if (is_numeric($id) && $id != '')

            $data = Union::select('union_name', 'id')->where('upazila_id', $request->id)->take(100)->get();
        else
            $data = '';

        return response()->json($data); //then sent this data to ajax success
    }


    public function findUpazilaWiseInstitute(Request $request)
    {

        if ($request->institute_name_id) {
            if (is_numeric($request->institute_name_id) && $request->institute_name_id != '') {
                $data = EducationalInstitute::select('id', 'institution_eiin_no')->where('id', $request->institute_name_id)->first();
            } else
                $data = '';
        } else if ($request->upazila_id) {
            if (is_numeric($request->upazila_id) && $request->upazila_id != '')
                $data = EducationalInstitute::select('id', 'institution_name', 'institution_eiin_no')->where('upazila_id', $request->upazila_id)->take(100)->get();
            else
                $data = '';
        } else
            $data = '';

        return response()->json($data); //then sent this data to ajax success
    }

    public function findLevelWiseClass(Request $request)
    {
        $id = preg_replace('/[^a-z\d ]/i', '', $request->id);

        if (is_numeric($id) && $id != '') {
            $data = LevelWiseClass::select('id', 'class_name', 'academic_level_id')->where('academic_level_id', $request->id)->get();
        } else
            $data = '';

        return response()->json($data);
    }

    public function findBankName(Request $request)
    {
        $id = preg_replace('/[^a-z\d ]/i', '', $request->id);

        // if (is_numeric($id) && $id != '') {
        //     $data = LevelWiseClass::select('id', 'class_name', 'academic_level_id')->where('academic_level_id', $request->id)->get();
        // } else
        $data = 'Entered';

        return response()->json($data);
    }

    public function findBankBranchName(Request $request)
    {

        if (is_numeric($request->district_id) && $request->district_id != '' && $request->bank_id != '' && is_numeric($request->bank_id)) {
            $data = BankBranch::select('id', 'branch_name', 'routing_number')->where('bank_name_id', $request->bank_id)->where('district_id', $request->district_id)->take(100)->get();
        } else if ($request->district_id == '' && $request->bank_id != '' && is_numeric($request->bank_id)) {
            $data = BankBranch::select('id', 'branch_name', 'routing_number')->where('bank_name_id', $request->bank_id)->take(100)->get();
        } else
            $data = '';
        return response()->json($data);
    }

    public function findBankRoutingNumber(Request $request)
    {

        if ($request->bank_branch_id != '' && is_numeric($request->bank_branch_id)) {
            $data = BankBranch::select('id', 'routing_number', 'branch_code')->where('id', $request->bank_branch_id)->first();
        } else
            $data = '';
        return response()->json($data);
    }
}
