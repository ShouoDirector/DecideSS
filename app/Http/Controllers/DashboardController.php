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

            $dataSection['getData'] = $models['nsrModel']->getSectionData();

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

            $sectionOfClassAdviser = $dataSectionAttribute['section_id'];
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();

            $dataMalnourishedCounts = $models['nutritionalAssessmentModel']->getMalnourishedPupils()->count(); 

            return view('class_adviser.class_adviser_dashboard', compact('head', 'dataSection', 'dataSectionAttribute', 'chartBySectionLabelsBMI', 'chartBySectionDataTotalByBMI',
            'chartBySectionMaleDataTotalByBMI', 'chartBySectionMaleDataTotalByBMI', 'chartBySectionFemaleDataTotalByBMI',
            'totalPupils', 'totalMalePupils', 'totalFemalePupils', 
            'chartBySectionLabelsHFA', 'chartBySectionDataTotalByHFA', 'chartBySectionMaleDataTotalByHFA', 'chartBySectionFemaleDataTotalByHFA', 
            'totalMalnourishedPupils', 'totalMaleMalnourishedPupils', 'totalFemaleMalnourishedPupils', 
            'totalStuntedPupils', 'totalMaleStuntedPupils', 'totalFemaleStuntedPupils', 'sectionOfClassAdviser', 'dataClassNames',
            'totalSeverelyWastedPupils',
            'totalWastedPupils', 'totalNormalInWeightPupils', 'totalOverweightPupils', 'totalObesePupils',
            'totalSeverelyStuntedPupils', 'totalStuntedPupils', 'totalPupilsNormalInHeight', 'totalTallPupils',
            'dataMalnourishedCounts'));
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

            $dataSchoolYearPhase['getData'] = $models['schoolYearModel']->getListSchoolYearPhaseComplete();

            $dataSection['getData'] = $models['cnsrModel']->getSchoolData() ?? [];
            $dataBeneficiary['getData'] = $models['beneficiaryModel']->getSchoolBeneficiariesData() ?? [];

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

            $sectionOfClassAdviser = $dataSectionAttribute['school_id'];
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataClassNames = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            return view('school_nurse.school_nurse_dashboard', compact('head', 'dataSection', 'dataSectionAttribute', 'chartBySectionLabelsBMI', 'chartBySectionDataTotalByBMI',
            'chartBySectionMaleDataTotalByBMI', 'chartBySectionMaleDataTotalByBMI', 'chartBySectionFemaleDataTotalByBMI',
            'totalPupils', 'totalMalePupils', 'totalFemalePupils', 
            'chartBySectionLabelsHFA', 'chartBySectionDataTotalByHFA', 'chartBySectionMaleDataTotalByHFA', 'chartBySectionFemaleDataTotalByHFA', 
            'totalMalnourishedPupils', 'totalMaleMalnourishedPupils', 'totalFemaleMalnourishedPupils', 
            'totalStuntedPupils', 'totalMaleStuntedPupils', 'totalFemaleStuntedPupils', 'sectionOfClassAdviser', 'dataClassNames',
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

            return view('medical_officer.medical_officer_dashboard', compact('head', 'dataSection', 'dataSectionAttribute', 'chartBySectionLabelsBMI', 'chartBySectionDataTotalByBMI',
            'chartBySectionMaleDataTotalByBMI', 'chartBySectionMaleDataTotalByBMI', 'chartBySectionFemaleDataTotalByBMI',
            'totalPupils', 'totalMalePupils', 'totalFemalePupils', 
            'chartBySectionLabelsHFA', 'chartBySectionDataTotalByHFA', 'chartBySectionMaleDataTotalByHFA', 'chartBySectionFemaleDataTotalByHFA', 
            'totalMalnourishedPupils', 'totalMaleMalnourishedPupils', 'totalFemaleMalnourishedPupils', 
            'totalStuntedPupils', 'totalMaleStuntedPupils', 'totalFemaleStuntedPupils', 'sectionOfClassAdviser', 'dataClassNames',
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
}
