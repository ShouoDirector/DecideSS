<?php

namespace App\Http\Controllers;

use App\Models\BeneficiaryModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ClassroomModel;
use App\Models\CnsrListModel;
use App\Models\DistrictCnsrListModel;
use App\Models\DistrictModel;
use App\Models\HfaModel;
use App\Models\MasterListModel;
use App\Models\SchoolModel;
use App\Models\PupilModel;
use App\Models\SchoolYearModel;
use App\Models\UserHistoryModel;
use App\Models\NsrListModel;
use App\Models\NutritionalAssessmentModel;
use App\Models\ReferralModel;
use App\Models\SectionModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userType = Auth::user()->user_type;
        $headerTitle = $this->getHeaderTitle($userType);
        $viewPath = $this->getViewPath($userType);
        

        if ($headerTitle && $viewPath) {
            return view($viewPath, compact('headerTitle'));
        } else {
            abort(404);
        }

    }

    private function getHeaderTitle($userType)
    {
        return [
            '1' => 'Admin Dashboard',
            '2' => 'Medical Officer Dashboard',
            '3' => 'School Nurse Dashboard',
            '4' => 'Class Adviser Dashboard',
        ][$userType] ?? null;
    }

    private function getViewPath($userType)
    {
        return [
            '1' => 'admin.dashboard',
            '2' => 'medical_officer.dashboard',
            '3' => 'school_nurse.dashboard',
            '4' => 'class_adviser.dashboard',
        ][$userType] ?? null;
    }

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
            'beneficiaryModel' => app(BeneficiaryModel:: class),
            'districtCnsrModel' => app(DistrictCnsrListModel::class),
            'sectionModel' => app(SectionModel::class),
        ];
    }

    public function classAdviserDashboard(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "School",
                'headerTitle1' => "School",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();
            $chartBySectionDataTotalByBMI = [];
            $dataSection = $dataMasterList = $dataNaRecords = $dataReferrals = $dataPupil = [];
            $dataSectionAttribute = $chartBySectionMaleDataTotalByBMI = $chartBySectionFemaleDataTotalByBMI = [];
            $totalPupils = $totalMalePupils = $totalFemalePupils = 0;
            $chartBySectionDataTotalByHFA = $chartBySectionMaleDataTotalByHFA = $chartBySectionFemaleDataTotalByHFA = [];
            $totalMalnourishedPupils = $totalMaleMalnourishedPupils = $totalFemaleMalnourishedPupils = 0; 
            $totalStuntedPupils = $totalMaleStuntedPupils = $totalFemaleStuntedPupils = 0;
            $sectionOfClassAdviser = $dataClassNames = $schoolName = $classGradeLevel = $classAdviserNames = $dataPupilGender = [];
            $totalSeverelyWastedPupils = $totalWastedPupils = $totalNormalInWeightPupils = $totalOverweightPupils = $totalObesePupils =
            $totalSeverelyStuntedPupils = $totalStuntedPupils = $totalPupilsNormalInHeight = $totalTallPupils = $dataMalnourishedCounts = 0;

            $dataSection['getData'] = $models['nsrModel']->getSectionData() ?? [];

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

                $sectionOfClassAdviser = $dataSectionAttribute['section_id'];
                $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();
                $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
                $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
                $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
                $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
                $classAdviserName['getList'] = $models['userModel']->getClassAdvisers();
                $classAdviserNames = collect($classAdviserName['getList'])->pluck('name', 'id')->toArray();
                $dataMasterList['getRecord'] = $models['masterListModel']->getMasterListClassAdviserCount();
                $dataNaRecords['getRecord'] = $models['nutritionalAssessmentModel']->getNArecordCountsByClassAdviser();
                $dataReferrals['getRecords'] = $models['referralModel']->getReferralListByClassAdviser();

                $dataMalnourishedCounts = $models['nutritionalAssessmentModel']->getMalnourishedPupils()->count();

                $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();
                $dataPupilGender = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            }

            $sectionListIds['getList'] = $models['classroomModel']->getClassroomRecords() ?? [];
            $dataSectionIds = collect($sectionListIds['getList'])->pluck('section_id', 'id')->toArray() ?? [];
            $sectionListNames['getList'] = $models['sectionModel']->getSectionsByAdmin() ?? [];
            $dataSectionName = collect($sectionListNames['getList'])->pluck('section_name', 'id')->toArray() ?? [];

            $chartBySectionLabelsBMI = ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese'];
            $chartBySectionLabelsHFA = ['Severely Stunted', 'Stunted', 'Normal', 'Tall'];

            return view('class_adviser.class_adviser_dashboard', compact('head', 'dataSection', 'dataSectionAttribute', 'chartBySectionLabelsBMI', 'chartBySectionDataTotalByBMI',
            'chartBySectionMaleDataTotalByBMI', 'chartBySectionFemaleDataTotalByBMI',
            'totalPupils', 'totalMalePupils', 'totalFemalePupils', 
            'chartBySectionLabelsHFA', 'chartBySectionDataTotalByHFA', 'chartBySectionMaleDataTotalByHFA', 'chartBySectionFemaleDataTotalByHFA', 
            'totalMalnourishedPupils', 'totalMaleMalnourishedPupils', 'totalFemaleMalnourishedPupils', 
            'totalStuntedPupils', 'totalMaleStuntedPupils', 'totalFemaleStuntedPupils',
            'sectionOfClassAdviser', 'dataClassNames', 'schoolName', 'classGradeLevel', 'classAdviserNames', 'dataPupilGender',
            'totalSeverelyWastedPupils','totalWastedPupils', 'totalNormalInWeightPupils', 'totalOverweightPupils', 'totalObesePupils',
            'totalSeverelyStuntedPupils', 'totalStuntedPupils', 'totalPupilsNormalInHeight', 'totalTallPupils',
            'dataMalnourishedCounts', 'dataMasterList', 'dataNaRecords', 'dataReferrals', 'dataSectionIds', 'dataSectionName'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function schoolNurseDashboard(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "School",
                'headerTitle1' => "School",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $dataSchoolYearPhase['getData'] = $models['schoolYearModel']->getListSchoolYearPhaseComplete() ?? [];

            $dataSection['getData'] = $models['cnsrModel']->getSchoolData();

            $dataBeneficiary['getData'] = $models['beneficiaryModel']->getSchoolBeneficiariesData() ?? [];

            $schoolGeneralData['getData'] = $models['schoolModel']->getSchoolGeneralData() ?? [];

            $collectiveData = [];

            $feedingProgramCount = $dataBeneficiary['getData']->where('is_feeding_program', '1')->count() ?? 0;
            $dewormingProgramCount = $dataBeneficiary['getData']->where('is_deworming_program', '1')->count() ?? 0;
            $immunizationVaxProgramCount = $dataBeneficiary['getData']->where('is_immunization_vax_program', '1')->count() ?? 0;
            $mentalProgramCount = $dataBeneficiary['getData']->where('is_mental_healthcare_program', '1')->count() ?? 0;
            $dentalProgramCount = $dataBeneficiary['getData']->where('is_dental_care_program', '1')->count() ?? 0;
            $eyeProgramCount = $dataBeneficiary['getData']->where('is_eye_care_program', '1')->count() ?? 0;
            $wellnessProgramCount = $dataBeneficiary['getData']->where('is_health_wellness_program', '1')->count() ?? 0;
            $medicalProgramCount = $dataBeneficiary['getData']->where('is_medical_support_program', '1')->count() ?? 0;
            $nursingProgramCount = $dataBeneficiary['getData']->where('is_nursing_services', '1')->count() ?? 0;
            
            $collectiveData = [
                'feedingProgramCount' => $feedingProgramCount,
                'dewormingProgramCount' => $dewormingProgramCount,
                'immunizationVaxProgramCount' => $immunizationVaxProgramCount,
                'mentalProgramCount' => $mentalProgramCount,
                'dentalProgramCount' => $dentalProgramCount,
                'eyeProgramCount' => $eyeProgramCount,
                'wellnessProgramCount' => $wellnessProgramCount,
                'medicalProgramCount' => $medicalProgramCount,
                'nursingProgramCount' => $nursingProgramCount,
            ];            

            // Check if $dataSection['getData'] is an array and not empty
            $dataSectionAttribute = !empty($dataSection['getData']) ? $dataSection['getData'][0] : null;
            $dataMasterList['getRecord'] = $models['masterListModel']->getMasterListSchoolNurseCount() ?? [];
            $dataNaRecords['getRecord'] = $models['nutritionalAssessmentModel']->getNArecordCountsBySchoolNurse() ?? [];

            if ($dataSectionAttribute !== null) {
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

            }else {
                $noOfPupils = 0;
                $noOfMalePupils = 0;
                $noOfFemalePupils = 0;

                $noOfSeverelyStunted = 0;
                $noOfMaleSeverelyStunted = 0;
                $noOfFemaleSeverelyStunted = 0;

                $noOfStunted = 0;
                $noOfMaleStunted = 0;
                $noOfFemaleStunted = 0;

                $noOfNormalInHeight = 0;
                $noOfMaleNormalInHeight = 0;
                $noOfFemaleNormalInHeight = 0;

                $noOfTall = 0;
                $noOfMaleTall = 0;
                $noOfFemaleTall = 0;

                $noOfStuntedPupils = 0;
                $noOfMaleStuntedPupils = 0;
                $noOfFemaleStuntedPupils = 0;

                $noOfSeverelyWasted = 0;
                $noOfMaleSeverelyWasted = 0;
                $noOfFemaleSeverelyWasted = 0;

                $noOfWasted = 0;
                $noOfMaleWasted = 0;
                $noOfFemaleWasted = 0;

                $noOfNormalInWeight = 0;
                $noOfMaleNormalInWeight = 0;
                $noOfFemaleNormalInWeight = 0;

                $noOfOverweight = 0;
                $noOfMaleOverweight = 0;
                $noOfFemaleOverweight = 0;

                $noOfObese = 0;
                $noOfMaleObese = 0;
                $noOfFemaleObese = 0;

                $noOfMalnourished = 0;
                $noOfMaleMalnourished = 0;
                $noOfFemaleMalnourished = 0;


            }

            $chartBySectionLabelsBMI = ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese'];
            $chartBySectionDataTotalByBMI = [$noOfSeverelyWasted, $noOfWasted, $noOfNormalInWeight, $noOfOverweight, $noOfObese];
            $chartBySectionMaleDataTotalByBMI = [$noOfMaleSeverelyWasted, $noOfMaleWasted, $noOfMaleNormalInWeight, $noOfMaleOverweight, $noOfMaleObese];
            $chartBySectionFemaleDataTotalByBMI = [$noOfFemaleSeverelyWasted, $noOfFemaleWasted, $noOfFemaleNormalInWeight, $noOfFemaleOverweight, $noOfFemaleObese];

            $totalPupils = [$noOfPupils];
            $totalMalePupils = [$noOfMalePupils];
            $totalFemalePupils = [$noOfFemalePupils];

            $chartBySectionLabelsHFA = ['Severely Stunted', 'Stunted', 'Normal', 'Tall'];
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

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomsForCurrentSchoolNurse();

            $sectionOfClassAdviser = $dataSectionAttribute['school_id'] ?? [];
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $schoolID = collect($dataSchools['getList'])->pluck('school_id', 'id')->toArray();
            $schoolAddress = collect($dataSchools['getList'])->pluck('address_barangay', 'id')->toArray();
            $dataClassNames = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();


            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();
            $dataPupilGender = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();

            return view('school_nurse.school_nurse_dashboard', compact('head', 'dataSection', 
            'totalPupils',  'dataMasterList', 'dataNaRecords',

            'dataSectionAttribute', 'chartBySectionLabelsBMI', 'chartBySectionDataTotalByBMI',
            'chartBySectionMaleDataTotalByBMI', 'chartBySectionMaleDataTotalByBMI', 'chartBySectionFemaleDataTotalByBMI',
            'totalMalePupils', 'totalFemalePupils', 
            'chartBySectionLabelsHFA', 'chartBySectionDataTotalByHFA', 'chartBySectionMaleDataTotalByHFA', 'chartBySectionFemaleDataTotalByHFA', 
            'totalMalnourishedPupils', 'totalMaleMalnourishedPupils', 'totalFemaleMalnourishedPupils', 
            'totalStuntedPupils', 'totalMaleStuntedPupils', 'totalFemaleStuntedPupils', 
            'dataClass',
            
            'sectionOfClassAdviser', 'dataClassNames', 'schoolName',
            'schoolID', 'schoolAddress', 'dataPupilGender', 'schoolGeneralData',
            
            'totalSeverelyWastedPupils', 
            'totalWastedPupils', 'totalNormalInWeightPupils', 'totalOverweightPupils', 'totalObesePupils',
            'totalSeverelyStuntedPupils', 'totalStuntedPupils', 'totalPupilsNormalInHeight', 'totalTallPupils', 
            'dataBeneficiary' ,'collectiveData', 'dataSchoolYearPhase'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function medicalOfficerDashboard(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "District",
                'headerTitle1' => "District",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $dataSchoolYearPhase['getData'] = $models['schoolYearModel']->getListSchoolYearPhaseComplete();

            $dataSection['getData'] = $models['districtCnsrModel']->getDistrictData() ?? [];
            $dataBeneficiary['getData'] = $models['beneficiaryModel']->getDistrictBeneficiariesData() ?? [];

            $collectiveData = [];

            $feedingProgramCount = $dataBeneficiary['getData']->where('is_feeding_program', '1')->count();
            $dewormingProgramCount = $dataBeneficiary['getData']->where('is_deworming_program', '1')->count();
            $immunizationVaxProgramCount = $dataBeneficiary['getData']->where('is_immunization_vax_program', '1')->count();
            $mentalProgramCount = $dataBeneficiary['getData']->where('is_mental_healthcare_program', '1')->count();
            $dentalProgramCount = $dataBeneficiary['getData']->where('is_dental_care_program', '1')->count();
            $eyeProgramCount = $dataBeneficiary['getData']->where('is_eye_care_program', '1')->count();
            $wellnessProgramCount = $dataBeneficiary['getData']->where('is_health_wellness_program', '1')->count();
            $medicalProgramCount = $dataBeneficiary['getData']->where('is_medical_support_program', '1')->count();
            $nursingProgramCount = $dataBeneficiary['getData']->where('is_nursing_services', '1')->count();
            
            $collectiveData = [
                'feedingProgramCount' => $feedingProgramCount,
                'dewormingProgramCount' => $dewormingProgramCount,
                'immunizationVaxProgramCount' => $immunizationVaxProgramCount,
                'mentalProgramCount' => $mentalProgramCount,
                'dentalProgramCount' => $dentalProgramCount,
                'eyeProgramCount' => $eyeProgramCount,
                'wellnessProgramCount' => $wellnessProgramCount,
                'medicalProgramCount' => $medicalProgramCount,
                'nursingProgramCount' => $nursingProgramCount,
            ];            

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

            $chartBySectionLabelsBMI = ['Severely Wasted', 'Wasted', 'Normal', 'Overweight', 'Obese'];
            $chartBySectionDataTotalByBMI = [$noOfSeverelyWasted, $noOfWasted, $noOfNormalInWeight, $noOfOverweight, $noOfObese];
            $chartBySectionMaleDataTotalByBMI = [$noOfMaleSeverelyWasted, $noOfMaleWasted, $noOfMaleNormalInWeight, $noOfMaleOverweight, $noOfMaleObese];
            $chartBySectionFemaleDataTotalByBMI = [$noOfFemaleSeverelyWasted, $noOfFemaleWasted, $noOfFemaleNormalInWeight, $noOfFemaleOverweight, $noOfFemaleObese];

            $totalPupils = [$noOfPupils];
            $totalMalePupils = [$noOfMalePupils];
            $totalFemalePupils = [$noOfFemalePupils];

            $chartBySectionLabelsHFA = ['Severely Stunted', 'Stunted', 'Normal', 'Tall'];
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

            $sectionOfClassAdviser = $dataSectionAttribute['district_id'];
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();
            $dataClassNames = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();
            $dataMasterList['getRecord'] = $models['masterListModel']->getMasterListMedicalOfficerCount();
            $dataNaRecords['getRecord'] = $models['nutritionalAssessmentModel']->getNArecordCountsByMedicalOfficer();
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentMedicalOfficer();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();
            $dataPupilGender = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();

            return view('medical_officer.medical_officer_dashboard', compact('head', 'dataSection', 'dataSectionAttribute', 'chartBySectionLabelsBMI', 'chartBySectionDataTotalByBMI',
            'chartBySectionMaleDataTotalByBMI', 'chartBySectionMaleDataTotalByBMI', 'chartBySectionFemaleDataTotalByBMI',
            'totalPupils', 'totalMalePupils', 'totalFemalePupils', 
            'chartBySectionLabelsHFA', 'chartBySectionDataTotalByHFA', 'chartBySectionMaleDataTotalByHFA', 'chartBySectionFemaleDataTotalByHFA', 
            'totalMalnourishedPupils', 'totalMaleMalnourishedPupils', 'totalFemaleMalnourishedPupils', 
            'totalStuntedPupils', 'totalMaleStuntedPupils', 'totalFemaleStuntedPupils', 'sectionOfClassAdviser', 'dataClassNames',
            'totalSeverelyWastedPupils', 'dataMasterList', 'dataPupilGender',
            'totalWastedPupils', 'totalNormalInWeightPupils', 'totalOverweightPupils', 'totalObesePupils',
            'totalSeverelyStuntedPupils', 'totalStuntedPupils', 'totalPupilsNormalInHeight', 'totalTallPupils', 
            'dataBeneficiary' ,'collectiveData', 'dataSchoolYearPhase', 'dataNaRecords', 'dataClass'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
