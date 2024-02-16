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
use App\Models\DistrictCnsrListModel;
use App\Models\SectionModel;
use App\Models\HealthConductModel;
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
            'sectionModel' => app(SectionModel::class),
            'healthConductModel' => app(HealthConductModel::class),
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
            $data['getRecord'] = $models['masterListModel']->getMasterListForSchoolNurse();

            // Get current user information
            $currentUser = Auth::user()->id;
            $user = Auth::user();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Get and filter class records for the current user
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $dataNA['classRecords'] = $models['nutritionalAssessmentModel']->getNAID();
            $dataNA_Id = collect($dataNA['classRecords'])->pluck('nsr_id', 'id')->toArray();

            $schoolNurseId = collect($dataSchools['getList'])->pluck('school_nurse_id', 'id')->first();

            $filteredRecords = $dataClass['classRecords'];

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a school nurse
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Get class records
            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecordBySchoolNurse();

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
            $classDistrictId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $classDistrictName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $dataNSRLists['getRecord'] = $models['nsrListModel']->getNSRListsBySchoolNurse();
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

            $dataSection['getRecords'] = $models['sectionModel']->getSectionsByAdmin();

            $sectionNames = collect($dataSection['getRecords'])->pluck('section_name', 'id')->toArray();

            $dataClassSectionId = collect($dataClass['classRecords'])->pluck('section_id', 'id')->toArray();

            return view('school_nurse.school_nurse.cnsr', compact(
                'data', 'sectionNames', 'dataClassSectionId', 'dataNA_Id', 'dataNA',
                'user', 'dataNSRLists',
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
                'classIds', 'classDistrictId', 'classDistrictName'
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
            $data['getRecord'] = $models['masterListModel']->getMasterListForSchoolNurse();

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
            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecordBySchoolNurse();

            // Get list of pupil records
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();

            $classAdviserNames = collect($classAdviserName['getList'])->pluck('name', 'id')->toArray();

            $nsrCode['getList'] = $models['nsrModel']->getNSRListsBySN();

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

            $dataSection['getRecords'] = $models['sectionModel']->getSectionsByAdmin();

            $sectionNames = collect($dataSection['getRecords'])->pluck('section_name', 'id')->toArray();

            $dataClassSectionId = collect($dataClass['classRecords'])->pluck('section_id', 'id')->toArray();

            return view('school_nurse.school_nurse.cnsr_fragment', compact(
                'data', 'sectionNames', 'dataClassSectionId',
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

    public function listOfMasterlist()
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
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

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
            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecordBySchoolNurse();

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
            $classDistrictId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $classDistrictName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

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

            return view('school_nurse.school_nurse.list_of_masterlist', compact(
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
                'classIds', 'classDistrictId', 'classDistrictName'
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

            $currentMonth = date('n');

            // Determine version based on the current month
            if ($currentMonth >= 6 && $currentMonth <= 12) {
                $version = 'Baseline';
            } elseif ($currentMonth >= 1 && $currentMonth <= 5) {
                $version = 'Endline';
            } else {
                $version = null;
            }

            // Check if $combinedValue exists in the nsr_code column
            $existingCnsrRecord = CnsrListModel::where('cnsr_code', $combinedValue)
                                            ->where('version', $version)
                                            ->first();

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
                    'version' => $version,
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
                    'version' => $version,
                ]);

                // Retrieve the ID of the newly created record
                $cnsrId = $cnsrRecord->id;
            }

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            NsrListModel::whereIn('id', $dataClassRecord['getRecord']->pluck('nsr_id'))
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
                    'district_id' => $request->district_id,
                    'schoolyear_id' => $record->schoolyear_id,
                    'height' => $record->height,
                    'weight' => $record->weight,
                    'bmi_category' => $record->bmi,
                    'hfa_category' => $record->hfa,
                    'is_feeding_program' => '1',
                ];

                // Use updateOrCreate to update or create the record
                $beneficiary = BeneficiaryModel::updateOrCreate($conditions, $data);

                // Add the beneficiary to the array
                $beneficiariesToSave[] = $beneficiary;
            }

            $getStuntedList = $models['nutritionalAssessmentModel']->getStuntedList();
            $beneficiariesToSave2 = [];

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
                    'district_id' => $request->district_id,
                    'schoolyear_id' => $record->schoolyear_id,
                    'height' => $record->height,
                    'weight' => $record->weight,
                    'bmi_category' => $record->bmi,
                    'hfa_category' => $record->hfa,
                    'is_feeding_program' => $isFeedingProgram,
                ];

                // Use updateOrCreate to update or create the record
                $beneficiary2 = BeneficiaryModel::updateOrCreate($conditions, $data);

                // Add the beneficiary to the array
                $beneficiariesToSave2[] = $beneficiary2;
            }

            $getObesityList = $models['nutritionalAssessmentModel']->getObesityList();
            $beneficiariesToSave3 = [];

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
                    'district_id' => $request->district_id,
                    'schoolyear_id' => $record->schoolyear_id,
                    'height' => $record->height,
                    'weight' => $record->weight,
                    'bmi_category' => $record->bmi,
                    'hfa_category' => $record->hfa,
                    'is_feeding_program' => $isFeedingProgram,
                ];

                // Use updateOrCreate to update or create the record
                $beneficiary3 = BeneficiaryModel::updateOrCreate($conditions, $data);

                // Add the beneficiary to the array
                $beneficiariesToSave3[] = $beneficiary3;
            }

            $getPermittedAndUndecidedList = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();
            $beneficiariesToSave4 = [];

            foreach ($getPermittedAndUndecidedList as $record) {
                $conditions = [
                    'pupil_id' => $record->pupil_id,
                    'schoolyear_id' => $record->schoolyear_id,
                ];

                $data = [
                    'classadviser_id' => $record->class_adviser_id,
                    'school_nurse_id' => $currentUser,
                    'class_id' => $record->class_id,
                    'district_id' => $request->district_id,
                    'schoolyear_id' => $record->schoolyear_id,
                    'height' => $record->height,
                    'weight' => $record->weight,
                    'is_deworming_program' => '1',
                ];

                // Use updateOrCreate to update or create the record
                $beneficiary4 = BeneficiaryModel::updateOrCreate($conditions, $data);

                // Add the beneficiary to the array
                $beneficiariesToSave4[] = $beneficiary4;
            }

            return redirect('school_nurse/school_nurse/cnsr')->with('success', 'Report successfully submitted and approved. This NSR is now assimilated to CNSR');
        }
        catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertCNSR(Request $request){
        try{
            date_default_timezone_set('Asia/Manila');

            $currentUser = Auth::user()->id;
            $schoolyear_id = $request->schoolyear_id;
            $district_id = $request->district_id;
            $cnsr_id = $request->cnsr_id;

            $cnsr = CnsrListModel::find($cnsr_id);

            if (!$cnsr) {
                return abort(404);
            }

            $cnsr->is_approved = '1';
            $cnsr->approved_date = now();
            $cnsr->save();
            
            $combinedValue = strval($currentUser) . '-' . strval($schoolyear_id) . '-' . strval($district_id);

            $models = $this->instantiateModels();

            $dataSchoolRecord['getRecord'] = $models['masterListModel']->getSchoolRecordByMedicalOfficer();
            $dataCNSRLists['getRecord'] = $models['cnsrModel']->getCNSRByMedicalOfficer();

            // Check if $combinedValue exists in the nsr_code column
            $existingDistrictCnsrRecord = DistrictCnsrListModel::where('district_cnsr_code', $combinedValue)->first();

            if ($existingDistrictCnsrRecord) {
                // Update the existing record
                $existingDistrictCnsrRecord->update([
                    // Add any fields you want to update here
                    'district_cnsr_code' => $combinedValue,
                    'district_id' => $district_id,
                    'medical_officer_id' => $currentUser,
                    'schoolyear_id' => $schoolyear_id,
                    'is_approved' => '0',
                    'is_deleted' => '0',
                ]);

                // Retrieve the ID of the updated record
                $districtCnsrId = $existingDistrictCnsrRecord->id;
            } else {
                // Create a new record
                $districtCnsrRecord = DistrictCnsrListModel::create([
                    'district_cnsr_code' => $combinedValue,
                    'district_id' => $district_id,
                    'medical_officer_id' => $currentUser,
                    'schoolyear_id' => $schoolyear_id,
                    'is_approved' => '0',
                    'is_deleted' => '0',
                ]);

                // Retrieve the ID of the newly created record
                $districtCnsrId = $districtCnsrRecord->id;
            }

            CnsrListModel::whereIn('id', $dataCNSRLists['getRecord']->pluck('id'))
            ->where('schoolyear_id', $schoolyear_id)
            ->update(['district_cnsr_id' => $districtCnsrId]);

            $consolidatedNutritionalStatusReports['getRecord'] = $models['cnsrModel']->getConsolidatedNutritionalStatusReports($districtCnsrId);

            $cnsrUpdateRecord = DistrictCnsrListModel::find($districtCnsrId);

            $cnsrUpdateRecord->no_of_pupils = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_pupils');
            $cnsrUpdateRecord->no_of_male_pupils = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_pupils');
            $cnsrUpdateRecord->no_of_female_pupils = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_pupils');

            $cnsrUpdateRecord->no_of_severely_stunted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_severely_stunted');
            $cnsrUpdateRecord->no_of_male_severely_stunted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_severely_stunted');
            $cnsrUpdateRecord->no_of_female_severely_stunted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_severely_stunted');

            $cnsrUpdateRecord->no_of_stunted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_stunted');
            $cnsrUpdateRecord->no_of_male_stunted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_stunted');
            $cnsrUpdateRecord->no_of_female_stunted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_stunted');

            $cnsrUpdateRecord->no_of_height_normal = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_height_normal');
            $cnsrUpdateRecord->no_of_male_height_normal = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_height_normal');
            $cnsrUpdateRecord->no_of_female_height_normal = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_height_normal');

            $cnsrUpdateRecord->no_of_tall = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_tall');
            $cnsrUpdateRecord->no_of_male_tall = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_tall');
            $cnsrUpdateRecord->no_of_female_tall = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_tall');

            // Calculate sum of stunted pupils
            $cnsrUpdateRecord->no_of_stunted_pupils = $cnsrUpdateRecord->no_of_severely_stunted + $cnsrUpdateRecord->no_of_stunted;
            $cnsrUpdateRecord->no_of_male_stunted_pupils = $cnsrUpdateRecord->no_of_male_severely_stunted + $cnsrUpdateRecord->no_of_male_stunted;
            $cnsrUpdateRecord->no_of_female_stunted_pupils = $cnsrUpdateRecord->no_of_female_severely_stunted + $cnsrUpdateRecord->no_of_female_stunted;

            $cnsrUpdateRecord->no_of_severely_wasted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_severely_wasted');
            $cnsrUpdateRecord->no_of_male_severely_wasted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_severely_wasted');
            $cnsrUpdateRecord->no_of_female_severely_wasted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_severely_wasted');

            $cnsrUpdateRecord->no_of_wasted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_wasted');
            $cnsrUpdateRecord->no_of_male_wasted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_wasted');
            $cnsrUpdateRecord->no_of_female_wasted = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_wasted');

            $cnsrUpdateRecord->no_of_weight_normal = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_weight_normal');
            $cnsrUpdateRecord->no_of_male_weight_normal = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_weight_normal');
            $cnsrUpdateRecord->no_of_female_weight_normal = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_weight_normal');

            $cnsrUpdateRecord->no_of_overweight = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_overweight');
            $cnsrUpdateRecord->no_of_male_overweight = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_overweight');
            $cnsrUpdateRecord->no_of_female_overweight = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_overweight');

            $cnsrUpdateRecord->no_of_obese = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_obese');
            $cnsrUpdateRecord->no_of_male_obese = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_male_obese');
            $cnsrUpdateRecord->no_of_female_obese = $consolidatedNutritionalStatusReports['getRecord']->sum('no_of_female_obese');

            // Calculate sum of malnourished pupils
            $cnsrUpdateRecord->no_of_malnourished_pupils = $cnsrUpdateRecord->no_of_severely_wasted + $cnsrUpdateRecord->no_of_wasted;
            $cnsrUpdateRecord->no_of_male_malnourished_pupils = $cnsrUpdateRecord->no_of_male_severely_wasted + $cnsrUpdateRecord->no_of_male_wasted;
            $cnsrUpdateRecord->no_of_female_malnourished_pupils = $cnsrUpdateRecord->no_of_female_severely_wasted + $cnsrUpdateRecord->no_of_female_wasted;

            // Update the record
            $cnsrUpdateRecord->update();

            return redirect('medical_officer/medical_officer/cnsr_main')->with('success', 'CNSR Report successfully submitted and approved. This CNSR is now assimilated to District CNSR');
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
                'skipMessage' => "You can skip this"
            ];

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYearPhaseName = ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

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

            // $kinderRecords is your collection
            $sumOfPupils = $kinderRecords->pluck('no_of_pupils')->sum();

            $getSchoolId = $models['schoolModel']->getSchoolId();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();
            $dataClassAdvisers['getList'] = $models['userModel']->getSchoolNurses();

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();
            $schoolNurseName = collect($dataClassAdvisers['getList'])->pluck('name', 'id')->toArray();
            
            return view('school_nurse.school_nurse.consolidated', compact(
                'head', 'activeSchoolYear', 'permitted', 'getNsrList',
                'kinderRecords', 'grade1Records', 'grade2Records', 'grade3Records',
                'grade4Records', 'grade5Records', 'grade6Records', 'spedRecords', 'getSchoolId',
                'schoolName', 'districtId', 'districtName', 'schoolYearPhaseName', 'schoolNurseName'
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function consolidatedHealth(){
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Healthcare Services Report",
                'headerTitle1' => "Report",
                'headerTable1' => "Reports",
                'skipMessage' => "You can skip this"
            ];

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();
            $schoolYearPhaseName = ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

            // Get and filter class records for the current user
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();

            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $getHealthRecords['getList'] = $models['healthConductModel']->getHealthRecordsBySchoolNurse();

            $healthCategories = $getHealthRecords['getList']->groupBy('grade_level');

            // Access records for each category
            $kinderRecords = $healthCategories->get('Kinder', collect());
            $grade1Records = $healthCategories->get('1', collect());
            $grade2Records = $healthCategories->get('2', collect());
            $grade3Records = $healthCategories->get('3', collect());
            $grade4Records = $healthCategories->get('4', collect());
            $grade5Records = $healthCategories->get('5', collect());
            $grade6Records = $healthCategories->get('6', collect());
            $spedRecords = $healthCategories->get('SPED', collect());

            // $kinderRecords is your collection
            $sumOfPupils = $kinderRecords->pluck('no_of_pupils')->sum();

            $getSchoolId = $models['schoolModel']->getSchoolId();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();
            $dataClassAdvisers['getList'] = $models['userModel']->getSchoolNurses();

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();
            $schoolNurseName = collect($dataClassAdvisers['getList'])->pluck('name', 'id')->toArray();
            
            return view('school_nurse.school_nurse.consolidated_health', compact(
                'head', 'activeSchoolYear', 'permitted', 'getHealthRecords',
                'kinderRecords', 'grade1Records', 'grade2Records', 'grade3Records',
                'grade4Records', 'grade5Records', 'grade6Records', 'spedRecords', 'getSchoolId',
                'schoolName', 'districtId', 'districtName', 'schoolYearPhaseName', 'schoolNurseName'
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function healthTable(){
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Healthcare Services Report",
                'headerTitle1' => "Report",
                'headerTable1' => "Reports",
                'skipMessage' => "You can skip this"
            ];

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();
            $schoolYearPhaseName = ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

            // Get and filter class records for the current user
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();

            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $getHealthRecords['getList'] = $models['healthConductModel']->getHealthRecordsBySchoolNurse();

            $healthCategories = $getHealthRecords['getList']->groupBy('grade_level');

            // Access records for each category
            $kinderRecords = $healthCategories->get('Kinder', collect());
            $grade1Records = $healthCategories->get('1', collect());
            $grade2Records = $healthCategories->get('2', collect());
            $grade3Records = $healthCategories->get('3', collect());
            $grade4Records = $healthCategories->get('4', collect());
            $grade5Records = $healthCategories->get('5', collect());
            $grade6Records = $healthCategories->get('6', collect());
            $spedRecords = $healthCategories->get('SPED', collect());

            // $kinderRecords is your collection
            $sumOfPupils = $kinderRecords->pluck('no_of_pupils')->sum();

            $getSchoolId = $models['schoolModel']->getSchoolId();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();
            $dataClassAdvisers['getList'] = $models['userModel']->getSchoolNurses();

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();
            $schoolNurseName = collect($dataClassAdvisers['getList'])->pluck('name', 'id')->toArray();
            
            return view('school_nurse.school_nurse.health_table', compact(
                'head', 'activeSchoolYear', 'permitted', 'getHealthRecords',
                'kinderRecords', 'grade1Records', 'grade2Records', 'grade3Records',
                'grade4Records', 'grade5Records', 'grade6Records', 'spedRecords', 'getSchoolId',
                'schoolName', 'districtId', 'districtName', 'schoolYearPhaseName', 'schoolNurseName'
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function school(){
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "School Reports",
                'headerTitle1' => "School",
                'headerTable1' => "School",
                'skipMessage' => "You can skip this"
            ];

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecordBySchoolNurse();
            $dataSection['getRecords'] = $models['sectionModel']->getSectionsByAdmin();
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataNSRLists['getRecord'] = $models['nsrListModel']->getNSRLists();
            $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();
            $dataNA['classRecords'] = $models['nutritionalAssessmentModel']->getNAID();

            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;
            $filteredRecords = $dataClass['classRecords'];

            $sectionNames = collect($dataSection['getRecords'])->pluck('section_name', 'id')->toArray();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $sectionIds = collect($dataNSRLists['getRecord'])->pluck('section_id');
            $classAdviserNames = collect($classAdviserName['getList'])->pluck('name', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();
            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $classSchoolId = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();
            $classDistrictId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $classDistrictName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            return view('school_nurse.school_nurse.school', compact(
                'head', 'activeSchoolYear', 'permitted', 'dataClassRecord', 'filteredRecords', 'sectionNames', 'schoolName',
                'sectionIds', 'classAdviserNames', 'dataClass', 'classGradeLevel', 'dataPupilNames', 'dataPupilBDate',
                'dataPupilSex', 'classSchoolId','classDistrictId', 'classDistrictName', 'dataNA'
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function consolidatedCNSRByGrade(){
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Consolidated Nutritional Status Report",
                'headerTitle1' => "Consolidated Nutritional Status Report",
                'headerTable1' => "Reports",
                'skipMessage' => "You can skip this"
            ];

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYearPhaseName = ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

            $getNsrList['getList'] = $models['nsrModel']->getNSRListsByMedicalOfficerForCNSR();

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

            // $kinderRecords is your collection
            $sumOfPupils = $kinderRecords->pluck('no_of_pupils')->sum();

            $districtId = $models['districtModel']->getDistrictData();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Fetch schools using SchoolModel
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();
            
            return view('medical_officer.medical_officer.consolidatedCNSRByGrade', compact(
                'head', 'activeSchoolYear', 'getNsrList',
                'kinderRecords', 'grade1Records', 'grade2Records', 'grade3Records',
                'grade4Records', 'grade5Records', 'grade6Records', 'spedRecords',
                'districtId', 'districtName', 'schoolYearPhaseName'
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function consolidatedCNSR(){
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "District Consolidated Nutritional Status Report",
                'headerTitle1' => "District Consolidated Nutritional Status Report",
                'headerTable1' => "Reports",
                'skipMessage' => "You can skip this"
            ];

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYearPhaseName = ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

            $getNsrList['getList'] = $models['cnsrModel']->getCNSRListsByMedicalOfficer()->toArray();

            $getSchools['getList'] = $models['schoolModel']->getSchoolsByMedicalOfficer();

            $nsrCategories = $getSchools['getList']->groupBy('school_id');

            $schoolsList = [];

            foreach ($getSchools['getList'] as $school) {
                // Access records for each category
                $perSchool = $nsrCategories->get($school->school_id, collect());
                $schoolsList[] = $perSchool;
            }

            $getSchoolId = $models['schoolModel']->getClassroomRecordsForCurrentMedicalOfficer();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();
            $getDistrictId = $models['districtModel']->getDistrictData();;

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();
            
            return view('medical_officer.medical_officer.consolidatedCNSR', compact(
                'head', 'activeSchoolYear', 'getNsrList', 'getSchoolId',
                'schoolName', 'districtId', 'districtName', 'schoolYearPhaseName', 'getDistrictId'
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
                'headerTitle' => "Beneficiaries",
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
                'headerTitle' => "Beneficiaries",
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

            $schoolIDBySN = $models['schoolModel']->getSchoolId();

            return view('school_nurse.school_nurse.final_list_of_beneficiaries', compact('data', 'dataProgram', 'head', 'activeSchoolYear',
        'permitted', 'getMalnourishedList', 'getStuntedList', 'getObesityList', 'getPermittedAndUndecidedList', 'dataPupilNames', 'className', 'classGradeLevel',
        'chartBySchoolLabels', 'chartBySchoolData', 'school', 'schoolName', 'adviserName', 'totalPupils', 'dataPupilNames', 'dataPupilLRNs',
    'schoolIDBySN'));
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
                'headerTitle' => "Beneficiaries",
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
                'headerTitle' => "Beneficiaries",
                'headerTitle1' => "Beneficiary List",
                'headerFilter1' => "Filter Beneficiaries",
                'headerTable1' => "Current Beneficiaries",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $dataProgram['getRecord'] = $models['beneficiaryModel']->getBeneficiaryListBySchoolNurseProgram() ?? [];

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
            
            $getSchoolId = $models['schoolModel']->getSchoolId();

            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYearPhaseName = ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

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
                'headerTitle' => "Beneficiaries",
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
            
            $getSchoolId = $models['schoolModel']->getSchoolId();

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
                'headerTitle' => "Beneficiaries",
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

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomsForCurrentSchoolNurse();
            $dataClasses['getRecord'] = $models['masterListModel']->getListOfMasterlists();

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Get records from the users table
            $data['getRecord'] = $models['pupilModel']->getPupilRecords();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Retrieve pupil data based on LRN
            $beneficiaryData['getList'] = $models['beneficiaryModel']->getBeneficiaryIfExist();
            $beneficiaryList['getList'] = $models['beneficiaryModel']->getSchoolBeneficiariesList();

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();
            $getPupilData['getRecord'] = $models['pupilModel']->selectedPupil();
            $getPupilMasterlist['getRecord'] = $models['masterListModel']->selectedMasterlistPupil() ?? [];

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $dataPupilLRN = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();
            $dataPupilPhoto = collect($dataPupil['getRecord'])->pluck('profile_photo', 'id')->toArray();


            $dataClassAdvisers['getList'] = $models['userModel']->getClassAdviser();
            $dataSchoolNurse['getList'] = $models['userModel']->getSchoolNurses();
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $dataGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            // Corresponding emails to class adviser IDs
            $classAdvisersNames = collect($dataClassAdvisers['getList'])->pluck('name', 'id')->toArray();

            $getPermittedAndUndecidedList = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();
            $getNAData['getRecord'] = $models['nutritionalAssessmentModel']->getNArecordsBySchoolNurse()->first();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            $classSchoolId = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();
            $classDistrictId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $classDistrictName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecordBySchoolNurseById();

            return view('school_nurse.school_nurse.enlist_new', 
                compact('data', 'head', 'schoolName', 'activeSchoolYear', 'dataClass', 'dataClasses', 'dataPupilPhoto', 'getNAData',
                'beneficiaryData', 'dataPupilNames', 'dataPupilSex', 'dataPupilLRN', 'classAdvisersNames', 'dataClassNames', 'dataGradeLevel',
                'getPermittedAndUndecidedList', 'dataClassRecord', 'classSchoolId', 'classDistrictId', 'classDistrictName', 'getPupilData',
                'getPupilMasterlist', 'beneficiaryList'));

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
                'district_id' => $request->district_id,
                'is_feeding_program' => $request->is_feeding_program,
                'school_nurse_id' => Auth::user()->id,
                'is_deworming_program' => $request->is_deworming_program,
                'is_immunization_vax_program' => $request->is_immunization_vax_program,
                'is_mental_healthcare_program' => $request->is_mental_healthcare_program,
                'is_dental_care_program' => $request->is_dental_care_program,
                'is_medical_support_program' => $request->is_medical_support_program,
                'is_nursing_services' => $request->is_nursing_services,
                'iron_supplementation' => $request->iron_supplementation,
                'is_immunized' => $request->is_immunized,
                'immunization_specify' => $request->immunization_specify,
                'menarche' => $request->menarche,
                'explanation' => $request->explanation,
                'date_of_examination' => now(),
            ];

            // Use updateOrCreate to update or create the record
            $beneficiary = BeneficiaryModel::updateOrCreate($conditions, $data);

            return redirect('school_nurse/school_nurse/enlist_new')
                ->with('success', 'Pupil successfully enlisted/updated in the list of beneficiaries.');

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function cnsrMain()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Consolidated Nutritional Status Reports",
                'headerTitle1' => "Consolidated Nutritional Status Reports",
                'headerTable1' => "Reports",
                'headerMessage1' => "This action is irreversible. Please review the 
                consolidated nutritional status reports before proceeding.",
                'skipMessage' => "You can skip this"
            ];

            // Get current user information
            $user = Auth::user();

            $dataSchools['getList'] = $models['schoolModel']->getClassroomRecordsForCurrentMedicalOfficer();

            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Get and filter class records for the current user
            $dataSchool['schoolRecords'] = $models['schoolModel']->getClassroomRecordsForCurrentMedicalOfficer();

            $medicalOfficerId = collect($dataDistricts['getList'])->pluck('medical_officer', 'id')->first();

            $filteredRecords = $dataSchool['schoolRecords'];

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();
            $schoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $school_Year = collect($schoolYear['getRecord'])->pluck('school_year', 'id')->toArray();

            $schoolYearPhase = collect($schoolYear['getRecord'])->pluck('phase', 'id')->toArray();

            // Get class records
            $dataSchoolRecord['getRecord'] = $models['masterListModel']->getSchoolRecordByMedicalOfficer();

            $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();
            $schoolNursesName['getList'] = $models['userModel']->getSchoolNurses();

            $schoolNursesNames = collect($schoolNursesName['getList'])->pluck('name', 'id')->toArray();

            $className = collect($dataSchool['schoolRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataSchool['schoolRecords'])->pluck('grade_level', 'id')->toArray();
            $classSchoolId = collect($dataSchool['schoolRecords'])->pluck('school_id', 'id')->toArray();
            $districtId = collect($dataSchool['schoolRecords'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $dataCNSRLists['getRecord'] = $models['cnsrModel']->getCNSRByMedicalOfficer();

            $getCNSRId = $dataCNSRLists['getRecord']->first()->id;

            $schoolIds = collect($dataCNSRLists['getRecord'])->pluck('school_id');

            $getNsrList['getList'] = $models['nsrModel']->getNSRListsByMedicalOfficer();

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


            return view('medical_officer.medical_officer.cnsr_main', compact(
                'user',
                'head',
                'filteredRecords',
                'schoolName',
                'activeSchoolYear',
                'dataSchoolRecord',
                'classSchoolId',
                'districtId',
                'districtName',
                'schoolNursesNames',
                'classGradeLevel',
                'schoolIds',
                'school_Year',
                'schoolYearPhase', 'getNsrList', 'getCNSRId',
                'kinderRecords', 'grade1Records', 'grade2Records', 'grade3Records',
                'grade4Records', 'grade5Records', 'grade6Records', 'spedRecords',
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function healthCare(){
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Healthcare Reports",
                'headerTitle1' => "HealthCare Reports",
                'headerTable1' => "Reports",
                'headerMessage1' => "This action is irreversible. Please review the 
                consolidated nutritional status reports before proceeding.",
                'skipMessage' => "You can skip this"
            ];

            // Get current user information
            $user = Auth::user();

            $dataSchools['getList'] = $models['schoolModel']->getClassroomRecordsForCurrentMedicalOfficer();

            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Get and filter class records for the current user
            $dataSchool['schoolRecords'] = $models['schoolModel']->getClassroomRecordsForCurrentMedicalOfficer();

            $medicalOfficerId = collect($dataDistricts['getList'])->pluck('medical_officer', 'id')->first();

            $filteredRecords = $dataSchool['schoolRecords'];

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();
            $schoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $school_Year = collect($schoolYear['getRecord'])->pluck('school_year', 'id')->toArray();

            $schoolYearPhase = collect($schoolYear['getRecord'])->pluck('phase', 'id')->toArray();

            // Get class records
            $dataSchoolRecord['getRecord'] = $models['masterListModel']->getSchoolRecordByMedicalOfficer();

            $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();
            $schoolNursesName['getList'] = $models['userModel']->getSchoolNurses();

            $schoolNursesNames = collect($schoolNursesName['getList'])->pluck('name', 'id')->toArray();

            $className = collect($dataSchool['schoolRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataSchool['schoolRecords'])->pluck('grade_level', 'id')->toArray();
            $classSchoolId = collect($dataSchool['schoolRecords'])->pluck('school_id', 'id')->toArray();
            $districtId = collect($dataSchool['schoolRecords'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $dataCNSRLists['getRecord'] = $models['cnsrModel']->getCNSRByMedicalOfficer();

            $getCNSRId = $dataCNSRLists['getRecord']->first()->id;

            $schoolIds = collect($dataCNSRLists['getRecord'])->pluck('school_id');

            $getNsrList['getList'] = $models['nsrModel']->getNSRListsByMedicalOfficer();

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


            return view('medical_officer.medical_officer.healthcare', compact(
                'user',
                'head',
                'filteredRecords',
                'schoolName',
                'activeSchoolYear',
                'dataSchoolRecord',
                'classSchoolId',
                'districtId',
                'districtName',
                'schoolNursesNames',
                'classGradeLevel',
                'schoolIds',
                'school_Year',
                'schoolYearPhase', 'getNsrList', 'getCNSRId',
                'kinderRecords', 'grade1Records', 'grade2Records', 'grade3Records',
                'grade4Records', 'grade5Records', 'grade6Records', 'spedRecords',
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function schools(){
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Schools",
                'headerTitle1' => "Schools",
                'headerTable1' => "Schools",
                'headerMessage1' => "This action is irreversible. Please review the 
                consolidated nutritional status reports before proceeding.",
                'skipMessage' => "You can skip this"
            ];

            // Get current user information
            $user = Auth::user();

            $dataSchools['getList'] = $models['schoolModel']->getClassroomRecordsForCurrentMedicalOfficer();

            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Get and filter class records for the current user
            $dataSchool['schoolRecords'] = $models['schoolModel']->getClassroomRecordsForCurrentMedicalOfficer();

            $medicalOfficerId = collect($dataDistricts['getList'])->pluck('medical_officer', 'id')->first();

            $filteredRecords = $dataSchool['schoolRecords'];

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();
            $schoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $school_Year = collect($schoolYear['getRecord'])->pluck('school_year', 'id')->toArray();

            $schoolYearPhase = collect($schoolYear['getRecord'])->pluck('phase', 'id')->toArray();

            // Get class records
            $dataSchoolRecord['getRecord'] = $models['masterListModel']->getSchoolRecordByMedicalOfficer();

            $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();
            $schoolNursesName['getList'] = $models['userModel']->getSchoolNurses();

            $schoolNursesNames = collect($schoolNursesName['getList'])->pluck('name', 'id')->toArray();

            $className = collect($dataSchool['schoolRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataSchool['schoolRecords'])->pluck('grade_level', 'id')->toArray();
            $classSchool = collect($dataSchool['schoolRecords'])->pluck('school', 'id')->toArray();
            $classSchoolNurseId = collect($dataSchool['schoolRecords'])->pluck('school_nurse_id', 'id')->toArray();
            $classSchoolId = collect($dataSchool['schoolRecords'])->pluck('school_id', 'id')->toArray();
            $districtId = collect($dataSchool['schoolRecords'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $dataCNSRLists['getRecord'] = $models['cnsrModel']->getCNSRByMedicalOfficer();

            $getCNSRId = $dataCNSRLists['getRecord']->first()->id;

            $schoolIds = collect($dataCNSRLists['getRecord'])->pluck('school_id');

            $getNsrList['getList'] = $models['nsrModel']->getNSRListsByMedicalOfficer();

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

            $dataMasterList['getRecord'] = $models['masterListModel']->getMasterListMedicalOfficerID();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();
            $dataPupilGender = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();

            $dataSection['getData'] = $models['cnsrModel']->getSelectedSchoolData() ?? [];
            $dataSectionAttribute = $dataSection['getData']->first() ?? [];

            $noOfPupils = $dataSectionAttribute['no_of_pupils'] ?? [];
            $totalPupils = [$noOfPupils] ?? [];

            $dataClasses['classRecords'] = $models['classroomModel']->getClassroomsForCurrenMO() ?? [];

            $dataSection['getData'] = $models['nsrModel']->getSectionDataByMedicalOfficer() ?? [];

            if (!is_null($dataSection['getData']) && !$dataSection['getData']->isEmpty()) {
                $dataSectionAttribute = $dataSection['getData']->first();

                $noOfPupils = $dataSectionAttribute['no_of_pupils'];
                $noOfMalePupils = $dataSectionAttribute['no_of_male_pupils'];
                $noOfFemalePupils = $dataSectionAttribute['no_of_female_pupils'];

                $noOfSeverelyStunted = $dataSectionAttribute['no_of_severely_stunted'];
                $noOfMaleSeverelyStunted = $dataSectionAttribute['no_of_male_severely_stunted'];
                $noOfFemaleSeverelyStunted = $dataSectionAttribute['no_of_female_severely_stunted'];

                $noOfStunted = $dataSectionAttribute['no_of_stunted'];
                $noOfMaleStunted = $dataSectionAttribute['no_of_male_stunted'];
                $noOfFemaleStunted = $dataSectionAttribute['no_of_female_stunted'];

                $noOfNormalInHeight = $dataSectionAttribute['no_of_height_normal'];
                $noOfMaleNormalInHeight = $dataSectionAttribute['no_of_male_height_normal'];
                $noOfFemaleNormalInHeight = $dataSectionAttribute['no_of_female_height_normal'];

                $noOfTall = $dataSectionAttribute['no_of_tall'];
                $noOfMaleTall = $dataSectionAttribute['no_of_male_tall'];
                $noOfFemaleTall = $dataSectionAttribute['no_of_female_tall'];

                $noOfStuntedPupils = $dataSectionAttribute['no_of_stunted_pupils'];
                $noOfMaleStuntedPupils = $dataSectionAttribute['no_of_male_stunted_pupils'];
                $noOfFemaleStuntedPupils = $dataSectionAttribute['no_of_female_stunted_pupils'];

                $noOfSeverelyWasted = $dataSectionAttribute['no_of_severely_wasted'];
                $noOfMaleSeverelyWasted = $dataSectionAttribute['no_of_male_severely_wasted'];
                $noOfFemaleSeverelyWasted = $dataSectionAttribute['no_of_female_severely_wasted'];

                $noOfWasted = $dataSectionAttribute['no_of_wasted'];
                $noOfMaleWasted = $dataSectionAttribute['no_of_male_wasted'];
                $noOfFemaleWasted = $dataSectionAttribute['no_of_female_wasted'];

                $noOfNormalInWeight = $dataSectionAttribute['no_of_weight_normal'];
                $noOfMaleNormalInWeight = $dataSectionAttribute['no_of_male_weight_normal'];
                $noOfFemaleNormalInWeight = $dataSectionAttribute['no_of_female_weight_normal'];

                $noOfOverweight = $dataSectionAttribute['no_of_overweight'];
                $noOfMaleOverweight = $dataSectionAttribute['no_of_male_overweight'];
                $noOfFemaleOverweight = $dataSectionAttribute['no_of_female_overweight'];

                $noOfObese = $dataSectionAttribute['no_of_obese'];
                $noOfMaleObese = $dataSectionAttribute['no_of_male_obese'];
                $noOfFemaleObese = $dataSectionAttribute['no_of_female_obese'];

                $noOfMalnourished = $dataSectionAttribute['no_of_malnourished_pupils'];
                $noOfMaleMalnourished = $dataSectionAttribute['no_of_male_malnourished_pupils'];
                $noOfFemaleMalnourished = $dataSectionAttribute['no_of_female_malnourished_pupils'];

                $chartBySectionDataTotalByBMI = [$noOfSeverelyWasted, $noOfWasted, $noOfNormalInWeight, $noOfOverweight, $noOfObese];
                $chartBySectionMaleDataTotalByBMI = [$noOfMaleSeverelyWasted, $noOfMaleWasted, $noOfMaleNormalInWeight, $noOfMaleOverweight, $noOfMaleObese];
                $chartBySectionFemaleDataTotalByBMI = [$noOfFemaleSeverelyWasted, $noOfFemaleWasted, $noOfFemaleNormalInWeight, $noOfFemaleOverweight, $noOfFemaleObese];

                $totalPupils = [$noOfPupils];
                $totalMalePupils = [$noOfMalePupils];
                $totalFemalePupils = [$noOfFemalePupils];

                $chartBySectionDataTotalByHFA = [$noOfSeverelyStunted, $noOfStunted, $noOfNormalInHeight, $noOfTall];
                $chartBySectionMaleDataTotalByHFA = [$noOfMaleSeverelyStunted, $noOfMaleStunted, $noOfMaleNormalInHeight, $noOfMaleTall];
                $chartBySectionFemaleDataTotalByHFA = [$noOfFemaleSeverelyStunted, $noOfFemaleStunted, $noOfFemaleNormalInHeight, $noOfFemaleTall];

                $totalMalnourishedPupils = [$noOfMalnourished];
                $totalMaleMalnourishedPupils = [$noOfMaleMalnourished];
                $totalFemaleMalnourishedPupils = [$noOfFemaleMalnourished];

                $totalStuntedPupils = [$noOfStuntedPupils];
                $totalMaleStuntedPupils = [$noOfMaleStuntedPupils];
                $totalFemaleStuntedPupils = [$noOfFemaleStuntedPupils];

                $totalSeverelyWastedPupils = [$noOfSeverelyWasted];
                $totalWastedPupils = [$noOfWasted];
                $totalNormalInWeightPupils = [$noOfNormalInWeight];
                $totalOverweightPupils = [$noOfOverweight];
                $totalObesePupils = [$noOfObese];
                $totalSeverelyStuntedPupils = [$noOfSeverelyStunted];
                $totalStuntedPupils = [$noOfStunted];
                $totalPupilsNormalInHeight = [$noOfNormalInHeight];
                $totalTallPupils = [$noOfTall ];

                $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
                $schoolNames = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            }

            $schoolNames = collect($dataSchools['getList'])->pluck('school', 'id')->toArray() ?? [];

            $dataClassList['classRecords'] = $models['classroomModel']->getClassroomsUnderSchool();

            $dataNaRecords['getRecord'] = $models['nutritionalAssessmentModel']->getNArecordCountsByMedicalOfficerSelected() ?? [];
            $dataBeneficiary['getData'] = $models['beneficiaryModel']->getSchoolBeneficiariesDataByMedicalOfficer() ?? [];
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomsForCurrentMedicalOfficer() ?? [];

            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray() ?? [];

            return view('medical_officer.medical_officer.schools', compact(
                'user', 'dataSchools', 'dataMasterList', 'dataClass', 'dataClasses',
                'head', 'dataPupilGender', 'totalPupils', 'dataNaRecords', 'dataBeneficiary',
                'filteredRecords', 'dataCNSRLists', 'dataSection', 'classSchoolNurseId','dataClassList',
                'schoolName', 'schoolNames', 'dataClassNames',
                'activeSchoolYear',
                'dataSchoolRecord',
                'classSchoolId', 'classSchool',
                'districtId',
                'districtName',
                'schoolNursesNames',
                'classGradeLevel',
                'schoolIds',
                'school_Year',
                'schoolYearPhase', 'getNsrList', 'getCNSRId',
                'kinderRecords', 'grade1Records', 'grade2Records', 'grade3Records',
                'grade4Records', 'grade5Records', 'grade6Records', 'spedRecords',
            ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function viewHealthCare(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Beneficiaries",
                'headerTitle1' => "Beneficiary List",
                'headerFilter1' => "Filter Beneficiaries",
                'headerTable1' => "Current Beneficiaries",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $dataProgram['getRecord'] = $models['beneficiaryModel']->getBeneficiaryListByMedicalOfficerProgram();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecords();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentMedicalOfficer();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $dataClassAdviser['getList'] = $models['userModel']->getClassAdvisers();
            $adviserName = collect($dataClassAdviser['getList'])->pluck('name', 'id')->toArray();

            $dataCNSR['getData'] = $models['cnsrModel']->getCNSRListsByMedicalOfficer();
            
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
            
            $getSchoolId = $models['schoolModel']->getSchoolId();

            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            // Fetch schools using SchoolModel
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYearPhaseName = ' SY ' . $activeSchoolYear['getRecord'][0]->school_year;

            return view('medical_officer.medical_officer.view_healthcare', compact('dataProgram', 'head', 'activeSchoolYear',
        'permitted', 'dataPupilNames', 'className', 'classGradeLevel',
        'chartBySchoolLabels', 'chartBySchoolData', 'school', 'schoolName', 'adviserName', 'totalPupils', 'dataPupilNames', 'dataPupilLRNs', 
        'schoolName', 'districtId', 'districtName', 'getSchoolId', 'schoolYearPhaseName'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function viewMasterListed(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "MasterList",
                'headerTitle1' => "MasterList",
                'headerMessage1' => ".",
                'headerFilter1' => "Filter MasterList",
                'headerTable1' => "MasterList",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterListPDFByMedicalOfficer();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getSectionForCurrentMedicalOfficer();

            // Filter the collection based on the user's id in the classadviser_id column
            $filteredRecords = $dataClass['classRecords']->filter(function ($record) use ($currentUser) {
                return $record->classadviser_id == $currentUser;
            });

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Retrieve pupil data based on LRN
            $pupilData['getRecord'] = $models['masterListModel']->getMasterList();

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilAddress = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['address'] = trim("{$pupil['barangay']} {$pupil['municipality']} {$pupil['province']}");
                return $pupil;
            })->pluck('address', 'id')->toArray();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();
            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilGender = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $dataPupilGuardian = collect($dataPupil['getRecord'])->pluck('pupil_guardian_name', 'id')->toArray();
            $dataPupilGuardianCo = collect($dataPupil['getRecord'])->pluck('pupil_guardian_contact_no', 'id')->toArray();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $classSchoolId = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();

            // Corresponding classroom names to class IDs
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();

            $SchoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $dataSchoolYearPhaseNames = collect($SchoolYear['getRecord'])->map(function ($syPhase) {
                // Combine school year and phase name
                $syPhase['full_name'] = trim("{$syPhase['school_year']} {$syPhase['phase']}");
                return $syPhase;
            })->pluck('full_name', 'id')->toArray();

            return view('medical_officer.medical_officer.masterlist_view', compact('data', 'head', 'permitted', 'filteredRecords',
                'schoolName', 'pupilData', 'activeSchoolYear', 'dataPupilNames', 'dataPupilLRNs', 'dataClassNames', 'dataSchoolYearPhaseNames',
            'dataPupilAddress', 'dataPupilBDate', 'dataPupilGender', 'dataPupilGuardian', 'dataPupilGuardianCo', 'className','classGradeLevel', 'classSchoolId'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function listOfMasterlists(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "MasterLists",
                'headerTitle1' => "List of MasterList",
                'headerFilter1' => "Filter MasterLists",
                'headerTable1' => "Current MasterLists",
                'headerTable2' => "Active School Year Phase",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomsForCurrentSchoolNurse();
            $dataClasses['getRecord'] = $models['masterListModel']->getListOfMasterlists();

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
            $getPupilData['getRecord'] = $models['pupilModel']->selectedPupil();
            $getPupilMasterlist['getRecord'] = $models['masterListModel']->selectedMasterlistPupil() ?? [];

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $fullName = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
            
                // Create initials from the names
                $initials = implode('', array_map(function ($name) {
                    return strtoupper($name[0]);
                }, explode(' ', $fullName)));
            
                // Combine full_name and initials into an array
                $pupil['full_name'] = $fullName;
                $pupil['initials'] = $initials;
            
                return $pupil;
            })->pluck('full_name', 'id')->toArray();
            $dataPupilInitials = collect($dataPupil['getRecord'])->pluck('initials', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $dataPupilLRN = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();
            $dataPupilPhoto = collect($dataPupil['getRecord'])->pluck('profile_photo', 'id')->toArray();


            $dataClassAdvisers['getList'] = $models['userModel']->getClassAdviser();
            $dataSchoolNurse['getList'] = $models['userModel']->getSchoolNurses();
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $dataGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            // Corresponding emails to class adviser IDs
            $classAdvisersNames = collect($dataClassAdvisers['getList'])->pluck('name', 'id')->toArray();

            $getPermittedAndUndecidedList = $models['nutritionalAssessmentModel']->getPermittedAndUndecidedList();
            $getNAData['getRecord'] = $models['nutritionalAssessmentModel']->getNArecordsBySchoolNurse()->first();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            $classSchoolId = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();
            $classDistrictId = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $classDistrictName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecordBySchoolNurseById();

            $dataSection['getRecords'] = $models['sectionModel']->getSectionsByAdmin();

            $sectionNames = collect($dataSection['getRecords'])->pluck('section_name', 'id')->toArray();

            return view('school_nurse.school_nurse.list_of_masterlist', 
                compact('data', 'head', 'schoolName', 'activeSchoolYear', 'dataClass', 'dataClasses', 'dataPupilPhoto', 'getNAData',
                'beneficiaryData', 'dataPupilNames', 'dataPupilSex', 'dataPupilLRN', 'classAdvisersNames', 'dataClassNames', 'dataGradeLevel',
                'getPermittedAndUndecidedList', 'dataClassRecord', 'classSchoolId', 'classDistrictId', 'classDistrictName', 'getPupilData',
            'getPupilMasterlist', 'sectionNames'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function viewAMasterList(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "MasterList",
                'headerTitle1' => "MasterList",
                'headerMessage1' => ".",
                'headerFilter1' => "Filter MasterList",
                'headerTable1' => "MasterList",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterListPDFBySchoolNurseTwo();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomsForCurrentSchoolNurse();

            // Filter the collection based on the user's id in the classadviser_id column
            $filteredRecords = $dataClass['classRecords']->filter(function ($record) use ($currentUser) {
                return $record->classadviser_id == $currentUser;
            });

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Retrieve pupil data based on LRN
            $pupilData['getRecord'] = $models['masterListModel']->getMasterListForSchoolNurse();

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilAddress = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['address'] = trim("{$pupil['barangay']} {$pupil['municipality']} {$pupil['province']}");
                return $pupil;
            })->pluck('address', 'id')->toArray();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();
            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilGender = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $dataPupilGuardian = collect($dataPupil['getRecord'])->pluck('pupil_guardian_name', 'id')->toArray();
            $dataPupilGuardianCo = collect($dataPupil['getRecord'])->pluck('pupil_guardian_contact_no', 'id')->toArray();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $classSchoolId = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();

            // Corresponding classroom names to class IDs
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();

            $SchoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $dataSchoolYearPhaseNames = collect($SchoolYear['getRecord'])->map(function ($syPhase) {
                // Combine school year and phase name
                $syPhase['full_name'] = trim("{$syPhase['school_year']} {$syPhase['phase']}");
                return $syPhase;
            })->pluck('full_name', 'id')->toArray();

            $dataSection['getRecords'] = $models['sectionModel']->getSectionsByAdmin();

            $sectionNames = collect($dataSection['getRecords'])->pluck('section_name', 'id')->toArray();

            $dataClassSectionId = collect($dataClass['classRecords'])->pluck('section_id', 'id')->toArray();

            return view('school_nurse.school_nurse.view_a_masterlist', compact('data', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'pupilData', 'activeSchoolYear', 'dataPupilNames', 'dataPupilLRNs', 'dataClassNames', 'dataSchoolYearPhaseNames',
            'dataPupilAddress', 'dataPupilBDate', 'dataPupilGender', 'dataPupilGuardian', 'dataPupilGuardianCo', 'className','classGradeLevel', 'classSchoolId', 
            'sectionNames', 'dataClassSectionId'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
