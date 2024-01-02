<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusReportModel;
use App\Models\ClassroomModel;
use App\Models\CnsrListModel;
use App\Models\DistrictModel;
use App\Models\HfaModel;
use App\Models\MasterListModel;
use App\Models\SchoolModel;
use App\Models\PupilModel;
use App\Models\SchoolYearModel;
use App\Models\NsrListModel;
use App\Models\NutritionalAssessmentModel;
use App\Models\ReferralModel;
use App\Models\User;
use App\Models\BeneficiaryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StatusReportController extends Controller
{
    private function instantiateModels() 
    {
        return [
            'masterListModel' => app(MasterListModel::class),
            'classroomModel' => app(ClassroomModel::class),
            'schoolModel' => app(SchoolModel::class),
            'districtModel' => app(DistrictModel::class),
            'schoolYearModel' => app(SchoolYearModel::class),
            'pupilModel' => app(PupilModel::class),
            'nsrListModel' => app(NsrListModel::class),
            'nutritionalAssessmentModel' => app(NutritionalAssessmentModel::class),
            'referralModel' => app(ReferralModel::class),
            'userModel' => app(User::class),
            'nsrModel' => app(NsrListModel::class),
            'cnsrModel' => app(CnsrListModel::class),
            'statusReportModel' => app(StatusReportModel::class),
            'beneficiaryModel' => app(BeneficiaryModel::class),
        ];
    }

    public function calculateHfaCategory($age, $sex, $height)
    {
        // Extract years from DateInterval object
        $age_in_years = $age->y;

        // Fetch HFA standards based on age and sex
        $hfaStandards = HfaModel::where('age', $age_in_years)
            ->where('sex', $sex)
            ->first();

        if ($hfaStandards) {
            // Calculate Z-score
            $zScore = ($height - $hfaStandards->median) / $hfaStandards->negative_firstSD;

            // Set age-specific thresholds for Z-scores
            $thresholds = [
                'severely_stunted' => -3,
                'stunted' => -2,
                'normal' => 2,
                'tall' => 3,
            ];

            // Determine the HFA category based on the Z-score
            if ($zScore < $thresholds['severely_stunted']) {
                $hfaCategory = 'Severely Stunted';
            } elseif ($zScore < $thresholds['stunted']) {
                $hfaCategory = 'Stunted';
            } elseif ($zScore < $thresholds['normal']) {
                $hfaCategory = 'Normal';
            } else {
                $hfaCategory = 'Tall';
            }

            // Return both HFA category and Z-score
            return ['hfaCategory' => $hfaCategory, 'zScore' => $zScore];
        } else {
            // Handle the case when HFA standards are not found
            return ['hfaCategory' => 'Age is below 5 or above 19', 'zScore' => null];
        }
    }

    function getBmiCategory($bmi) {
        if ($bmi < 16.5) {
            return 'Severely Wasted';
        } elseif ($bmi >= 16.5 && $bmi < 18.5) {
            return 'Wasted';
        } elseif ($bmi >= 18.5 && $bmi < 23) {
            return 'Normal';
        } elseif ($bmi >= 23 && $bmi < 24.9) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }

    function getSpinnerColorClass($bmiCategory)
    {
        switch ($bmiCategory) {
            case 'Severely Wasted':
                return 'text-danger'; 
            case 'Wasted':
                return 'text-warning';
            case 'Normal':
                return 'text-success';
            case 'Overweight':
                return 'text-warning';
            case 'Obese':
                return 'text-danger';
            default:
                return '';
        }
    }

    public function cnsr()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Nutritional Status Reports",
                'headerTitle1' => "Nutritional Status Reports",
                'headerTable1' => "Reports",
                'headerMessage1' => "This action is irreversible. Please review the 
                nutritional assessments of the pupils before proceeding.",
                'skipMessage' => "You can skip this"
            ];

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            // Get current user information
            $currentUser = Auth::user()->id;
            $user = Auth::user();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();

            // Get and filter class records for the current user
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();

            $schoolNurseId = collect($dataSchools['getList'])->pluck('school_nurse_id', 'id')->first();

            $filteredRecords = $dataClass['classRecords'];

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Get class records
            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecord();

            // Get list of pupil records
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();

            $classAdviserNames = collect($classAdviserName['getList'])->pluck('name', 'id')->toArray();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $classSchoolId = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();

            $dataNSRLists['getRecord'] = $models['nsrListModel']->getNSRLists();
            $dataMasterListRecord['getRecord'] = $models['masterListModel']->getMasterLists();

            $sectionIds = collect($dataNSRLists['getRecord'])->pluck('section_id');
            $classIds = collect($dataMasterListRecord['getRecord'])->pluck('class_id');

            foreach ($dataClassRecord['getRecord'] as $value) {
                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
                $sex = $dataPupilSex[$value->pupil_id];

                // Calculate BMI
                $bmi = $value->weight / ($value->height * $value->height);
                $value->bmi = number_format($bmi, 2);
                $value->height_squared = $value->height * $value->height;

                // Add BMI category and color to the $value object
                $value->bmiCategory = $this->getBmiCategory($bmi);
                $value->bmiColorSpinner = $this->getSpinnerColorClass($value->bmiCategory);

                // Calculate HFA category and add to the $value object
                $hfaInfo = $this->calculateHfaCategory($age, $sex, $value->height);
                $value->hfaCategory = $hfaInfo['hfaCategory'];
                $value->zscore = $hfaInfo['zScore'];
            }

            return view('school_nurse.school_nurse.cnsr', compact(
                'data',
                'user',
                'head',
                'permitted',
                'filteredRecords',
                'schoolName',
                'activeSchoolYear',
                'dataClassRecord',
                'dataPupilNames',
                'dataPupilBDate',
                'dataPupilSex',
                'classSchoolId',
                'className',
                'classAdviserNames',
                'classGradeLevel',
                'sectionIds',
                'classIds'
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function cnsrFragment()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Nutritional Status Report",
                'headerTitle1' => "Nutritional Status Report",
                'headerTable1' => "Report",
                'headerMessage1' => "This action is irreversible. Please review the 
                nutritional assessments of the pupils before proceeding.",
                'skipMessage' => "You can skip this"
            ];

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            // Get current user information
            $currentUser = Auth::user()->id;
            $user = Auth::user();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();

            // Get and filter class records for the current user
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();

            $schoolNurseId = collect($dataSchools['getList'])->pluck('school_nurse_id', 'id')->first();

            $filteredRecords = $dataClass['classRecords'];

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Get class records
            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecord();

            // Get list of pupil records
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();

            $classAdviserNames = collect($classAdviserName['getList'])->pluck('name', 'id')->toArray();

            $nsrCode['getList'] = $models['nsrModel']->getNSRLists();

            $nsrCodes = collect($nsrCode['getList'])->pluck('nsr_code', 'id')->toArray();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $classSchoolId = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();

            $dataNSRLists['getRecord'] = $models['nsrListModel']->getNSRLists();
            $dataMasterListRecord['getRecord'] = $models['masterListModel']->getMasterLists();

            $sectionIds = collect($dataNSRLists['getRecord'])->pluck('section_id');
            $classIds = collect($dataMasterListRecord['getRecord'])->pluck('class_id');

            foreach ($dataClassRecord['getRecord'] as $value) {
                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
                $sex = $dataPupilSex[$value->pupil_id];

                // Calculate BMI
                $bmi = $value->weight / ($value->height * $value->height);
                $value->bmi = number_format($bmi, 2);
                $value->height_squared = $value->height * $value->height;

                // Add BMI category and color to the $value object
                $value->bmiCategory = $this->getBmiCategory($bmi);
                $value->bmiColorSpinner = $this->getSpinnerColorClass($value->bmiCategory);

                // Calculate HFA category and add to the $value object
                $hfaInfo = $this->calculateHfaCategory($age, $sex, $value->height);
                $value->hfaCategory = $hfaInfo['hfaCategory'];
                $value->zscore = $hfaInfo['zScore'];
            }

            return view('school_nurse.school_nurse.cnsr_fragment', compact(
                'data',
                'user',
                'head',
                'permitted',
                'filteredRecords',
                'schoolName',
                'activeSchoolYear',
                'dataClassRecord',
                'dataPupilNames',
                'dataPupilBDate',
                'dataPupilSex',
                'classSchoolId',
                'className',
                'classAdviserNames',
                'classGradeLevel',
                'sectionIds',
                'classIds',
                'nsrCodes'
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertNSR(Request $request){
        try{
            date_default_timezone_set('Asia/Manila');

            $currentUser = Auth::user()->id;
            $schoolyear_id = $request->schoolyear_id;
            $school_id = $request->school_id;
            $nsr_id = $request->nsr_id;

            $nsr = NsrListModel::find($nsr_id);

            if (!$nsr) {
                return abort(404);
            }

            $nsr->is_approved = '1';
            $nsr->approved_date = now();
            $nsr->save();
            
            $combinedValue = strval($currentUser) . '-' . strval($schoolyear_id) . '-' . strval($school_id);

            $models = $this->instantiateModels();

            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecords();
            $dataNSRLists['getRecord'] = $models['nsrListModel']->getNSRLists();

            // Check if $combinedValue exists in the nsr_code column
            $existingCnsrRecord = CnsrListModel::where('cnsr_code', $combinedValue)->first();

            if ($existingCnsrRecord) {
                // Update the existing record
                $existingCnsrRecord->update([
                    // Add any fields you want to update here
                    'cnsr_code' => $combinedValue,
                    'school_id' => $school_id,
                    'school_nurse_id' => $currentUser,
                    'schoolyear_id' => $schoolyear_id,
                    'is_approved' => '0',
                    'is_deleted' => '0',
                ]);

                // Retrieve the ID of the updated record
                $cnsrId = $existingCnsrRecord->id;
            } else {
                // Create a new record
                $cnsrRecord = CnsrListModel::create([
                    'cnsr_code' => $combinedValue,
                    'school_id' => $school_id,
                    'school_nurse_id' => $currentUser,
                    'schoolyear_id' => $schoolyear_id,
                    'is_approved' => '0',
                    'is_deleted' => '0',
                ]);

                // Retrieve the ID of the newly created record
                $cnsrId = $cnsrRecord->id;
            }

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            NsrListModel::whereIn('id', $dataClassRecord['getRecord']->pluck('id'))
            ->where('schoolyear_id', $schoolyear_id)
            ->update(['cnsr_id' => $cnsrId]);

            $nutritionalStatusReports['getRecord'] = $models['nsrModel']->getNutritionalStatusReports($cnsrId);


            $cnsrUpdateRecord = CnsrListModel::find($cnsrId);

            $cnsrUpdateRecord->no_of_pupils = $nutritionalStatusReports['getRecord']->sum('no_of_pupils');
            $cnsrUpdateRecord->no_of_male_pupils = $nutritionalStatusReports['getRecord']->sum('no_of_male_pupils');
            $cnsrUpdateRecord->no_of_female_pupils = $nutritionalStatusReports['getRecord']->sum('no_of_female_pupils');

            $cnsrUpdateRecord->no_of_severely_stunted = $nutritionalStatusReports['getRecord']->sum('no_of_severely_stunted');
            $cnsrUpdateRecord->no_of_male_severely_stunted = $nutritionalStatusReports['getRecord']->sum('no_of_male_severely_stunted');
            $cnsrUpdateRecord->no_of_female_severely_stunted = $nutritionalStatusReports['getRecord']->sum('no_of_female_severely_stunted');

            $cnsrUpdateRecord->no_of_stunted = $nutritionalStatusReports['getRecord']->sum('no_of_stunted');
            $cnsrUpdateRecord->no_of_male_stunted = $nutritionalStatusReports['getRecord']->sum('no_of_male_stunted');
            $cnsrUpdateRecord->no_of_female_stunted = $nutritionalStatusReports['getRecord']->sum('no_of_female_stunted');

            $cnsrUpdateRecord->no_of_height_normal = $nutritionalStatusReports['getRecord']->sum('no_of_height_normal');
            $cnsrUpdateRecord->no_of_male_height_normal = $nutritionalStatusReports['getRecord']->sum('no_of_male_height_normal');
            $cnsrUpdateRecord->no_of_female_height_normal = $nutritionalStatusReports['getRecord']->sum('no_of_female_height_normal');

            $cnsrUpdateRecord->no_of_tall = $nutritionalStatusReports['getRecord']->sum('no_of_tall');
            $cnsrUpdateRecord->no_of_male_tall = $nutritionalStatusReports['getRecord']->sum('no_of_male_tall');
            $cnsrUpdateRecord->no_of_female_tall = $nutritionalStatusReports['getRecord']->sum('no_of_female_tall');

            // Calculate sum of stunted pupils
            $cnsrUpdateRecord->no_of_stunted_pupils = $cnsrUpdateRecord->no_of_severely_stunted + $cnsrUpdateRecord->no_of_stunted;
            $cnsrUpdateRecord->no_of_male_stunted_pupils = $cnsrUpdateRecord->no_of_male_severely_stunted + $cnsrUpdateRecord->no_of_male_stunted;
            $cnsrUpdateRecord->no_of_female_stunted_pupils = $cnsrUpdateRecord->no_of_female_severely_stunted + $cnsrUpdateRecord->no_of_female_stunted;

            $cnsrUpdateRecord->no_of_severely_wasted = $nutritionalStatusReports['getRecord']->sum('no_of_severely_wasted');
            $cnsrUpdateRecord->no_of_male_severely_wasted = $nutritionalStatusReports['getRecord']->sum('no_of_male_severely_wasted');
            $cnsrUpdateRecord->no_of_female_severely_wasted = $nutritionalStatusReports['getRecord']->sum('no_of_female_severely_wasted');

            $cnsrUpdateRecord->no_of_wasted = $nutritionalStatusReports['getRecord']->sum('no_of_wasted');
            $cnsrUpdateRecord->no_of_male_wasted = $nutritionalStatusReports['getRecord']->sum('no_of_male_wasted');
            $cnsrUpdateRecord->no_of_female_wasted = $nutritionalStatusReports['getRecord']->sum('no_of_female_wasted');

            $cnsrUpdateRecord->no_of_weight_normal = $nutritionalStatusReports['getRecord']->sum('no_of_weight_normal');
            $cnsrUpdateRecord->no_of_male_weight_normal = $nutritionalStatusReports['getRecord']->sum('no_of_male_weight_normal');
            $cnsrUpdateRecord->no_of_female_weight_normal = $nutritionalStatusReports['getRecord']->sum('no_of_female_weight_normal');

            $cnsrUpdateRecord->no_of_overweight = $nutritionalStatusReports['getRecord']->sum('no_of_overweight');
            $cnsrUpdateRecord->no_of_male_overweight = $nutritionalStatusReports['getRecord']->sum('no_of_male_overweight');
            $cnsrUpdateRecord->no_of_female_overweight = $nutritionalStatusReports['getRecord']->sum('no_of_female_overweight');

            $cnsrUpdateRecord->no_of_obese = $nutritionalStatusReports['getRecord']->sum('no_of_obese');
            $cnsrUpdateRecord->no_of_male_obese = $nutritionalStatusReports['getRecord']->sum('no_of_male_obese');
            $cnsrUpdateRecord->no_of_female_obese = $nutritionalStatusReports['getRecord']->sum('no_of_female_obese');

            // Calculate sum of malnourished pupils
            $cnsrUpdateRecord->no_of_malnourished_pupils = $cnsrUpdateRecord->no_of_severely_wasted + $cnsrUpdateRecord->no_of_wasted;
            $cnsrUpdateRecord->no_of_male_malnourished_pupils = $cnsrUpdateRecord->no_of_male_severely_wasted + $cnsrUpdateRecord->no_of_male_wasted;
            $cnsrUpdateRecord->no_of_female_malnourished_pupils = $cnsrUpdateRecord->no_of_female_severely_wasted + $cnsrUpdateRecord->no_of_female_wasted;

            // Update the record
            $cnsrUpdateRecord->update();

            return redirect('school_nurse/school_nurse/cnsr')->with('success', 'Report successfully submitted and approved. This NSR is now assimilated to CNSR');
        }
        catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function consolidatedNSR(){
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Consolidated Nutritional Status Report",
                'headerTitle1' => "Consolidated Nutritional Status Report",
                'headerTable1' => "Reports",
                'headerMessage1' => "his action is irreversible. Please review the 
                nutritional assessments of the pupils before proceeding.",
                'skipMessage' => "You can skip this"
            ];

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYearPhaseName = $activeSchoolYear['getRecord'][0]->phase . ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

            // Get and filter class records for the current user
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();

            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $getNsrList['getList'] = $models['nsrModel']->getNSRListsBySchoolNurse();

            $nsrCategories = $getNsrList['getList']->groupBy('grade_level');

            // Access records for each category
            $kinderRecords = $nsrCategories->get('Kinder', collect());
            $grade1Records = $nsrCategories->get('1', collect());
            $grade2Records = $nsrCategories->get('2', collect());
            $grade3Records = $nsrCategories->get('3', collect());
            $grade4Records = $nsrCategories->get('4', collect());
            $grade5Records = $nsrCategories->get('5', collect());
            $grade6Records = $nsrCategories->get('6', collect());
            $spedRecords = $nsrCategories->get('SPED', collect());

            $getSchoolId = $models['schoolModel']->getSchoolData();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();
            
            return view('school_nurse.school_nurse.consolidated', compact(
                'head', 'activeSchoolYear', 'permitted', 'getNsrList',
                'kinderRecords', 'grade1Records', 'grade2Records', 'grade3Records',
                'grade4Records', 'grade5Records', 'grade6Records', 'spedRecords', 'getSchoolId',
                'schoolName', 'districtId', 'districtName', 'schoolYearPhaseName'
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function listOfBeneficiaries(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Overview and Beneficiaries",
                'headerTitle1' => "Beneficiary List",
                'headerFilter1' => "Filter Beneficiaries",
                'headerTable1' => "Current Beneficiaries",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['referralModel']->getReferralListBySchoolNurse();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecords();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $getMalnourishedList['getRecords'] = $models['nutritionalAssessmentModel']->getMalnourishedList();
            $getStuntedList['getRecords'] = $models['nutritionalAssessmentModel']->getStuntedList();
            $getObesityList['getRecords'] = $models['nutritionalAssessmentModel']->getObesityList();
            $getPermittedAndUndecidedList['getRecords'] = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            $dataCNSR['getData'] = $models['cnsrModel']->getCNSRBySchoolNurse();
            
            $dataCNSRAttribute = $dataCNSR['getData']->first();

            $noOfPupils = $dataCNSRAttribute['no_of_pupils'];
            $noOfSeverelyStunted = $dataCNSRAttribute['no_of_severely_stunted'];
            $noOfStunted = $dataCNSRAttribute['no_of_stunted'];
            $noOfNormalInHeight = $dataCNSRAttribute['no_of_height_normal'];
            $noOfTall = $dataCNSRAttribute['no_of_tall'];
            $noOfStuntedPupils = $dataCNSRAttribute['no_of_stunted_pupils'];
            $noOfSeverelyWasted = $dataCNSRAttribute['no_of_severely_wasted'];
            $noOfWasted = $dataCNSRAttribute['no_of_wasted'];
            $noOfNormalInWeight = $dataCNSRAttribute['no_of_weight_normal'];
            $noOfOverweight = $dataCNSRAttribute['no_of_overweight'];
            $noOfObese = $dataCNSRAttribute['no_of_obese'];
            $noOfMalnourished = $dataCNSRAttribute['no_of_malnourished_pupils'];

            $school = $dataCNSRAttribute['school_id'];

            $chartBySchoolLabels = ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese'];
            $chartBySchoolData = [$noOfSeverelyWasted, $noOfWasted, $noOfNormalInWeight, $noOfOverweight, $noOfObese];
            $totalPupils = [$noOfPupils];

            return view('school_nurse.school_nurse.list_of_beneficiaries', compact('data', 'head', 'activeSchoolYear',
        'permitted', 'getMalnourishedList', 'getStuntedList', 'getObesityList', 'getPermittedAndUndecidedList', 'dataPupilNames', 'className', 'classGradeLevel',
        'chartBySchoolLabels', 'chartBySchoolData', 'school', 'schoolName', 'totalPupils'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function finalListOfBeneficiaries(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Overview and Beneficiaries",
                'headerTitle1' => "Beneficiary List",
                'headerFilter1' => "Filter Beneficiaries",
                'headerTable1' => "Current Beneficiaries",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['beneficiaryModel']->getBeneficiaryListBySchoolNurse();
            $dataProgram['getRecord'] = $models['beneficiaryModel']->getBeneficiaryListBySchoolNurseProgram();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecords();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $getMalnourishedList['getRecords'] = $models['nutritionalAssessmentModel']->getMalnourishedList();
            $getStuntedList['getRecords'] = $models['nutritionalAssessmentModel']->getStuntedList();
            $getObesityList['getRecords'] = $models['nutritionalAssessmentModel']->getObesityList();
            $getPermittedAndUndecidedList['getRecords'] = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $dataClassAdviser['getList'] = $models['userModel']->getClassAdvisers();
            $adviserName = collect($dataClassAdviser['getList'])->pluck('name', 'id')->toArray();

            $dataCNSR['getData'] = $models['cnsrModel']->getCNSRBySchoolNurse();
            
            $dataCNSRAttribute = $dataCNSR['getData']->first();

            $noOfPupils = $dataCNSRAttribute['no_of_pupils'];
            $noOfSeverelyStunted = $dataCNSRAttribute['no_of_severely_stunted'];
            $noOfStunted = $dataCNSRAttribute['no_of_stunted'];
            $noOfNormalInHeight = $dataCNSRAttribute['no_of_height_normal'];
            $noOfTall = $dataCNSRAttribute['no_of_tall'];
            $noOfStuntedPupils = $dataCNSRAttribute['no_of_stunted_pupils'];
            $noOfSeverelyWasted = $dataCNSRAttribute['no_of_severely_wasted'];
            $noOfWasted = $dataCNSRAttribute['no_of_wasted'];
            $noOfNormalInWeight = $dataCNSRAttribute['no_of_weight_normal'];
            $noOfOverweight = $dataCNSRAttribute['no_of_overweight'];
            $noOfObese = $dataCNSRAttribute['no_of_obese'];
            $noOfMalnourished = $dataCNSRAttribute['no_of_malnourished_pupils'];

            $school = $dataCNSRAttribute['school_id'];

            $chartBySchoolLabels = ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese'];
            $chartBySchoolData = [$noOfSeverelyWasted, $noOfWasted, $noOfNormalInWeight, $noOfOverweight, $noOfObese];
            $totalPupils = [$noOfPupils];

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

            return view('school_nurse.school_nurse.final_list_of_beneficiaries', compact('data', 'dataProgram', 'head', 'activeSchoolYear',
        'permitted', 'getMalnourishedList', 'getStuntedList', 'getObesityList', 'getPermittedAndUndecidedList', 'dataPupilNames', 'className', 'classGradeLevel',
        'chartBySchoolLabels', 'chartBySchoolData', 'school', 'schoolName', 'adviserName', 'totalPupils', 'dataPupilNames', 'dataPupilLRNs'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function finalListOfBeneficiariesProgram(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Overview and Beneficiaries",
                'headerTitle1' => "Beneficiary List",
                'headerFilter1' => "Filter Beneficiaries",
                'headerTable1' => "Current Beneficiaries",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $dataProgram['getRecord'] = $models['beneficiaryModel']->getBeneficiaryListBySchoolNurseProgram();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecords();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $getMalnourishedList['getRecords'] = $models['nutritionalAssessmentModel']->getMalnourishedList();
            $getStuntedList['getRecords'] = $models['nutritionalAssessmentModel']->getStuntedList();
            $getObesityList['getRecords'] = $models['nutritionalAssessmentModel']->getObesityList();
            $getPermittedAndUndecidedList['getRecords'] = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $dataClassAdviser['getList'] = $models['userModel']->getClassAdvisers();
            $adviserName = collect($dataClassAdviser['getList'])->pluck('name', 'id')->toArray();

            $dataCNSR['getData'] = $models['cnsrModel']->getCNSRBySchoolNurse();
            
            $dataCNSRAttribute = $dataCNSR['getData']->first();

            $noOfPupils = $dataCNSRAttribute['no_of_pupils'];
            $noOfSeverelyStunted = $dataCNSRAttribute['no_of_severely_stunted'];
            $noOfStunted = $dataCNSRAttribute['no_of_stunted'];
            $noOfNormalInHeight = $dataCNSRAttribute['no_of_height_normal'];
            $noOfTall = $dataCNSRAttribute['no_of_tall'];
            $noOfStuntedPupils = $dataCNSRAttribute['no_of_stunted_pupils'];
            $noOfSeverelyWasted = $dataCNSRAttribute['no_of_severely_wasted'];
            $noOfWasted = $dataCNSRAttribute['no_of_wasted'];
            $noOfNormalInWeight = $dataCNSRAttribute['no_of_weight_normal'];
            $noOfOverweight = $dataCNSRAttribute['no_of_overweight'];
            $noOfObese = $dataCNSRAttribute['no_of_obese'];
            $noOfMalnourished = $dataCNSRAttribute['no_of_malnourished_pupils'];

            $school = $dataCNSRAttribute['school_id'];

            $chartBySchoolLabels = ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese'];
            $chartBySchoolData = [$noOfSeverelyWasted, $noOfWasted, $noOfNormalInWeight, $noOfOverweight, $noOfObese];
            $totalPupils = [$noOfPupils];

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

            return view('school_nurse.school_nurse.final_list_of_beneficiaries_program', compact('dataProgram', 'head', 'activeSchoolYear',
        'permitted', 'getMalnourishedList', 'getStuntedList', 'getObesityList', 'getPermittedAndUndecidedList', 'dataPupilNames', 'className', 'classGradeLevel',
        'chartBySchoolLabels', 'chartBySchoolData', 'school', 'schoolName', 'adviserName', 'totalPupils', 'dataPupilNames', 'dataPupilLRNs'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function healthCareServicesReport(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Overview and Beneficiaries",
                'headerTitle1' => "Beneficiary List",
                'headerFilter1' => "Filter Beneficiaries",
                'headerTable1' => "Current Beneficiaries",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $dataProgram['getRecord'] = $models['beneficiaryModel']->getBeneficiaryListBySchoolNurseProgram();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecords();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $getMalnourishedList['getRecords'] = $models['nutritionalAssessmentModel']->getMalnourishedList();
            $getStuntedList['getRecords'] = $models['nutritionalAssessmentModel']->getStuntedList();
            $getObesityList['getRecords'] = $models['nutritionalAssessmentModel']->getObesityList();
            $getPermittedAndUndecidedList['getRecords'] = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $dataClassAdviser['getList'] = $models['userModel']->getClassAdvisers();
            $adviserName = collect($dataClassAdviser['getList'])->pluck('name', 'id')->toArray();

            $dataCNSR['getData'] = $models['cnsrModel']->getCNSRBySchoolNurse();
            
            $dataCNSRAttribute = $dataCNSR['getData']->first();

            $noOfPupils = $dataCNSRAttribute['no_of_pupils'];
            $noOfSeverelyStunted = $dataCNSRAttribute['no_of_severely_stunted'];
            $noOfStunted = $dataCNSRAttribute['no_of_stunted'];
            $noOfNormalInHeight = $dataCNSRAttribute['no_of_height_normal'];
            $noOfTall = $dataCNSRAttribute['no_of_tall'];
            $noOfStuntedPupils = $dataCNSRAttribute['no_of_stunted_pupils'];
            $noOfSeverelyWasted = $dataCNSRAttribute['no_of_severely_wasted'];
            $noOfWasted = $dataCNSRAttribute['no_of_wasted'];
            $noOfNormalInWeight = $dataCNSRAttribute['no_of_weight_normal'];
            $noOfOverweight = $dataCNSRAttribute['no_of_overweight'];
            $noOfObese = $dataCNSRAttribute['no_of_obese'];
            $noOfMalnourished = $dataCNSRAttribute['no_of_malnourished_pupils'];

            $school = $dataCNSRAttribute['school_id'];

            $chartBySchoolLabels = ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese'];
            $chartBySchoolData = [$noOfSeverelyWasted, $noOfWasted, $noOfNormalInWeight, $noOfOverweight, $noOfObese];
            $totalPupils = [$noOfPupils];

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();
            
            $getSchoolId = $models['schoolModel']->getSchoolData();

            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYearPhaseName = $activeSchoolYear['getRecord'][0]->phase . ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

            return view('school_nurse.school_nurse.healthcare_services_report', compact('dataProgram', 'head', 'activeSchoolYear',
        'permitted', 'getMalnourishedList', 'getStuntedList', 'getObesityList', 'getPermittedAndUndecidedList', 'dataPupilNames', 'className', 'classGradeLevel',
        'chartBySchoolLabels', 'chartBySchoolData', 'school', 'schoolName', 'adviserName', 'totalPupils', 'dataPupilNames', 'dataPupilLRNs', 
        'schoolName', 'districtId', 'districtName', 'getSchoolId', 'schoolYearPhaseName'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function malnutritionReport(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Overview and Beneficiaries",
                'headerTitle1' => "Beneficiary List",
                'headerFilter1' => "Filter Beneficiaries",
                'headerTable1' => "Current Beneficiaries",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $dataProgram['getRecord'] = $models['beneficiaryModel']->getBeneficiaryListBySchoolNurseProgram();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecords();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $getMalnourishedList['getRecords'] = $models['nutritionalAssessmentModel']->getMalnourishedList();
            $getStuntedList['getRecords'] = $models['nutritionalAssessmentModel']->getStuntedList();
            $getObesityList['getRecords'] = $models['nutritionalAssessmentModel']->getObesityList();
            $getPermittedAndUndecidedList['getRecords'] = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $dataClassAdviser['getList'] = $models['userModel']->getClassAdvisers();
            $adviserName = collect($dataClassAdviser['getList'])->pluck('name', 'id')->toArray();

            $dataCNSR['getData'] = $models['cnsrModel']->getCNSRBySchoolNurse();
            
            $dataCNSRAttribute = $dataCNSR['getData']->first();

            $noOfPupils = $dataCNSRAttribute['no_of_pupils'];
            $noOfSeverelyStunted = $dataCNSRAttribute['no_of_severely_stunted'];
            $noOfStunted = $dataCNSRAttribute['no_of_stunted'];
            $noOfNormalInHeight = $dataCNSRAttribute['no_of_height_normal'];
            $noOfTall = $dataCNSRAttribute['no_of_tall'];
            $noOfStuntedPupils = $dataCNSRAttribute['no_of_stunted_pupils'];
            $noOfSeverelyWasted = $dataCNSRAttribute['no_of_severely_wasted'];
            $noOfWasted = $dataCNSRAttribute['no_of_wasted'];
            $noOfNormalInWeight = $dataCNSRAttribute['no_of_weight_normal'];
            $noOfOverweight = $dataCNSRAttribute['no_of_overweight'];
            $noOfObese = $dataCNSRAttribute['no_of_obese'];
            $noOfMalnourished = $dataCNSRAttribute['no_of_malnourished_pupils'];

            $school = $dataCNSRAttribute['school_id'];

            $chartBySchoolLabels = ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese'];
            $chartBySchoolData = [$noOfSeverelyWasted, $noOfWasted, $noOfNormalInWeight, $noOfOverweight, $noOfObese];
            $totalPupils = [$noOfPupils];

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();
            
            $getSchoolId = $models['schoolModel']->getSchoolData();

            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYearPhaseName = $activeSchoolYear['getRecord'][0]->phase . ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

            return view('school_nurse.school_nurse.malnutrition_report', compact('dataProgram', 'head', 'activeSchoolYear',
        'permitted', 'getMalnourishedList', 'getStuntedList', 'getObesityList', 'getPermittedAndUndecidedList', 'dataPupilNames', 'className', 'classGradeLevel',
        'chartBySchoolLabels', 'chartBySchoolData', 'school', 'schoolName', 'adviserName', 'totalPupils', 'dataPupilNames', 'dataPupilLRNs', 
        'schoolName', 'districtId', 'districtName', 'getSchoolId', 'schoolYearPhaseName'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function enlistUnderweightPupils()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $currentUser = Auth::user()->id;

            $getMalnourishedList = $models['nutritionalAssessmentModel']->getMalnourishedList();
            $beneficiariesToSave = [];

            foreach ($getMalnourishedList as $record) {
                $conditions = [
                    'pupil_id' => $record->pupil_id,
                    'schoolyear_id' => $record->schoolyear_id,
                ];

                $data = [
                    'classadviser_id' => $record->class_adviser_id,
                    'school_nurse_id' => $currentUser,
                    'class_id' => $record->class_id,
                    'schoolyear_id' => $record->schoolyear_id,
                    'height' => $record->height,
                    'weight' => $record->weight,
                    'bmi_category' => $record->bmi,
                    'hfa_category' => $record->hfa,
                    'is_feeding_program' => '1',
                    'is_health_wellness_program' => '1',
                ];

                // Use updateOrCreate to update or create the record
                $beneficiary = BeneficiaryModel::updateOrCreate($conditions, $data);

                // Add the beneficiary to the array
                $beneficiariesToSave[] = $beneficiary;
            }

            return redirect('school_nurse/school_nurse/list_of_beneficiaries')
                ->with('success', 'Underweight Pupils successfully enlisted/updated to the list of beneficiaries.');

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function enlistStuntedPupils()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $currentUser = Auth::user()->id;

            $getStuntedList = $models['nutritionalAssessmentModel']->getStuntedList();
            $beneficiariesToSave = [];

            foreach ($getStuntedList as $record) {
                $conditions = [
                    'pupil_id' => $record->pupil_id,
                    'schoolyear_id' => $record->schoolyear_id,
                ];

                $isFeedingProgram = ($record->bmi != 'Overweight' && $record->bmi != 'Obese') ? '1' : '0';

                $data = [
                    'classadviser_id' => $record->class_adviser_id,
                    'school_nurse_id' => $currentUser,
                    'class_id' => $record->class_id,
                    'schoolyear_id' => $record->schoolyear_id,
                    'height' => $record->height,
                    'weight' => $record->weight,
                    'bmi_category' => $record->bmi,
                    'hfa_category' => $record->hfa,
                    'is_feeding_program' => $isFeedingProgram,
                    'is_health_wellness_program' => '1',
                ];

                // Use updateOrCreate to update or create the record
                $beneficiary = BeneficiaryModel::updateOrCreate($conditions, $data);

                // Add the beneficiary to the array
                $beneficiariesToSave[] = $beneficiary;
            }

            return redirect('school_nurse/school_nurse/list_of_beneficiaries')
                ->with('success', 'Stunted Pupils successfully enlisted/updated to the list of beneficiaries.');

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function enlistOverweightPupils()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $currentUser = Auth::user()->id;

            $getObesityList = $models['nutritionalAssessmentModel']->getObesityList();
            $beneficiariesToSave = [];

            foreach ($getObesityList as $record) {
                $conditions = [
                    'pupil_id' => $record->pupil_id,
                    'schoolyear_id' => $record->schoolyear_id,
                ];

                $isFeedingProgram = ($record->bmi != 'Overweight' || $record->bmi != 'Obese') ? '0' : '1';

                $data = [
                    'classadviser_id' => $record->class_adviser_id,
                    'school_nurse_id' => $currentUser,
                    'class_id' => $record->class_id,
                    'schoolyear_id' => $record->schoolyear_id,
                    'height' => $record->height,
                    'weight' => $record->weight,
                    'bmi_category' => $record->bmi,
                    'hfa_category' => $record->hfa,
                    'is_feeding_program' => $isFeedingProgram,
                    'is_health_wellness_program' => '1',
                ];

                // Use updateOrCreate to update or create the record
                $beneficiary = BeneficiaryModel::updateOrCreate($conditions, $data);

                // Add the beneficiary to the array
                $beneficiariesToSave[] = $beneficiary;
            }

            return redirect('school_nurse/school_nurse/list_of_beneficiaries')
                ->with('success', 'Overweight Pupils successfully enlisted/updated to the list of beneficiaries.');

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function enlistDewormingPupils()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $currentUser = Auth::user()->id;

            $getPermittedAndUndecidedList = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();
            $beneficiariesToSave = [];

            foreach ($getPermittedAndUndecidedList as $record) {
                $conditions = [
                    'pupil_id' => $record->pupil_id,
                    'schoolyear_id' => $record->schoolyear_id,
                ];

                $data = [
                    'classadviser_id' => $record->class_adviser_id,
                    'school_nurse_id' => $currentUser,
                    'class_id' => $record->class_id,
                    'schoolyear_id' => $record->schoolyear_id,
                    'height' => $record->height,
                    'weight' => $record->weight,
                    'is_deworming_program' => '1',
                ];

                // Use updateOrCreate to update or create the record
                $beneficiary = BeneficiaryModel::updateOrCreate($conditions, $data);

                // Add the beneficiary to the array
                $beneficiariesToSave[] = $beneficiary;
            }

            return redirect('school_nurse/school_nurse/list_of_beneficiaries')
                ->with('success', 'Pupils for Deworming Program successfully enlisted/updated to the list of beneficiaries.');

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function enlistNew(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Overview and Beneficiaries",
                'headerTitle1' => "Beneficiary List",
                'headerFilter1' => "Filter Beneficiaries",
                'headerTable1' => "Current Beneficiaries",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Get records from the users table
            $data['getRecord'] = $models['pupilModel']->getPupilRecords();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Retrieve pupil data based on LRN
            $beneficiaryData['getList'] = $models['beneficiaryModel']->getBeneficiaryIfExist();

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();

            $dataClassAdvisers['getList'] = $models['userModel']->getClassAdviser();
            $dataSchoolNurse['getList'] = $models['userModel']->getSchoolNurses();
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $dataGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            // Corresponding emails to class adviser IDs
            $classAdvisersNames = collect($dataClassAdvisers['getList'])->pluck('name', 'id')->toArray();

            $getPermittedAndUndecidedList = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();

            return view('school_nurse.school_nurse.enlist_new', 
                compact('data', 'head', 'schoolName', 'activeSchoolYear',
                'beneficiaryData', 'dataPupilNames', 'dataPupilSex', 'classAdvisersNames', 'dataClassNames', 'dataGradeLevel',
                'getPermittedAndUndecidedList'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function enlistNewPost(Request $request){
        try {
            date_default_timezone_set('Asia/Manila');

            $conditions = [
                'pupil_id' => $request->pupil_id,
                'schoolyear_id' => $request->schoolyear_id,
            ];

            $data = [
                'is_feeding_program' => $request->is_feeding_program,
                'school_nurse_id' => Auth::user()->id,
                'is_deworming_program' => $request->is_deworming_program,
                'is_immunization_vax_program' => $request->is_immunization_vax_program,
                'is_mental_healthcare_program' => $request->is_mental_healthcare_program,
                'is_dental_care_program' => $request->is_dental_care_program,
                'is_eye_care_program' => $request->is_eye_care_program,
                'is_health_wellness_program' => $request->is_health_wellness_program,
                'is_medical_support_program' => $request->is_medical_support_program,
                'is_nursing_services' => $request->is_nursing_services,
                'iron_supplementation' => $request->iron_supplementation,
                'is_immunized' => $request->is_immunized,
                'immunization_specify' => $request->immunization_specify,
                'menarche' => $request->menarche,
                'temperature' => $request->temperature != 0.00 ? $request->temperature : null,
                'blood_pressure' => $request->blood_pressure != 0.00 ? $request->blood_pressure : null,
                'heart_rate' => $request->heart_rate != 0.00 ? $request->heart_rate : null,
                'pulse_rate' => $request->pulse_rate != 0.00 ? $request->pulse_rate : null,
                'respiratory_rate' => $request->respiratory_rate != 0.00 ? $request->respiratory_rate : null,
                'vision_screening' => $request->vision_screening,
                'skin_scalp' => $request->skin_scalp,
                'eyes' => $request->eyes,
                'ear' => $request->ear,
                'nose' => $request->nose,
                'mouth' => $request->mouth,
                'neck' => $request->neck,
                'throat' => $request->throat,
                'lungs' => $request->lungs,
                'heart' => $request->heart,
                'abdomen' => $request->abdomen,
                'deformities' => $request->deformities,
                'deformity_specified' => $request->deformity_specified,
                'explanation' => $request->explanation,
                'date_of_examination' => now(),
            ];

            // Use updateOrCreate to update or create the record
            $beneficiary = BeneficiaryModel::updateOrCreate($conditions, $data);

            return redirect('school_nurse/school_nurse/list_of_beneficiaries')
                ->with('success', 'Pupil successfully enlisted/updated in the list of beneficiaries.');

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
