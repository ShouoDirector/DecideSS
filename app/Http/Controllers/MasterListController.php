<?php

namespace App\Http\Controllers;

use App\Models\ClassroomModel;
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
use App\Models\BeneficiaryModel;
use App\Models\DistrictModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;

class MasterListController extends Controller{

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
            'beneficiaryModel' => app(BeneficiaryModel::class),
        ];
    }

    public function calculateHfaCategory($age, $sex, $height)
    {
        // Extract years from DateInterval object
        $age_in_years = $age->y;

        // Fetch HFA standards based on age and sex
        $hfaStandards = HfaModel::where('age', $age_in_years)
            ->where('sex', '=', $sex)
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

    public function masterList()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "MasterList",
                'headerTitle1' => "Add Pupil To Classroom",
                'headerMessage1' => "Warning: You are about to add a pupil to the masterlist. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter MasterList",
                'headerTable1' => "Current Pupils In MasterList",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

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

            // Corresponding classroom names to class IDs
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();

            $SchoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $dataSchoolYearPhaseNames = collect($SchoolYear['getRecord'])->map(function ($syPhase) {
                // Combine school year and phase name
                $syPhase['full_name'] = trim("{$syPhase['school_year']} {$syPhase['phase']}");
                return $syPhase;
            })->pluck('full_name', 'id')->toArray();

            return view('class_adviser.class_adviser.masterlist', compact('data', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'pupilData', 'activeSchoolYear', 'dataPupilNames', 'dataPupilLRNs', 'dataClassNames', 'dataSchoolYearPhaseNames',
            'dataPupilAddress', 'dataPupilBDate', 'dataPupilGender', 'dataPupilGuardian', 'dataPupilGuardianCo'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function pupil_to_masterlist()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Add Pupil To MasterList",
                'headerTitle1' => "Add Pupil To MasterList",
                'headerMessage1' => "Warning: You are about to add a pupil to the masterlist. 
                                        Before confirming, please check the classroom assignment for this pupil 
                                        and check if the pupil has already existed on your masterlist/s",
                'headerMessage2' => "And ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter MasterList",
                'headerTable1' => "MasterList",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            $dataPupilsCheckedInMasterlist['getList'] = $models['masterListModel']->getCheckedPupilsInMasterList();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

            $dataSection['getRecord'] = $models['classroomModel']->getClassroomRecordsForClassAdviser();

            // Filter the collection based on the user's id in the classadviser_id column
            $filteredRecords = $dataClass['classRecords']->filter(function ($record) use ($currentUser) {
                return $record->classadviser_id == $currentUser;
            });

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the class adviser is assigned to a classroom
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $models['masterListModel']->getPupilRecord();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $getPupils['getList'] = $models['pupilModel']->getPupilList();

            $checkIfPupilExistInMasterlist = collect($data['getRecord'])->pluck('id', 'id')->toArray();

            return view('class_adviser.class_adviser.pupil_to_masterlist', compact('data', 'head', 'permitted', 
            'filteredRecords', 'schoolName', 'pupilData', 'activeSchoolYear', 'getPupils', 'checkIfPupilExistInMasterlist',
            'dataPupilsCheckedInMasterlist', 'dataSection'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertPupilToMasterList(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            $userId = Auth::user()->id;

            $models = $this->instantiateModels();

            // Extract data from the request
            $lrn = $request->lrn;
            $pupilId = $request->pupil_id;
            $classAdviserId = $request->classadviser_id;
            $classId = $request->class_id;
            $schoolYearId = $request->schoolyear_id;

            // Check if a record with the same values already exists
            $existingRecord = MasterListModel::firstOrNew([
                'pupil_id' => $pupilId,
                'classadviser_id' => $classAdviserId,
                'class_id' => $classId,
                'schoolyear_id' => $schoolYearId,
            ]);

            // If the record doesn't exist, populate its data and save
            if (!$existingRecord->exists) {
                // Create a new instance of MasterListModel and populate its data
                $masterList = new MasterListModel();
                $masterList->pupil_id = $pupilId;
                $masterList->classadviser_id = $classAdviserId;
                $masterList->class_id = $classId;
                $masterList->schoolyear_id = $schoolYearId;

                // Save the new record to the database
                $masterList->save();

                // Create an associative array of school details
                $masterListDetails = [
                    'Pupil LRN' => $lrn,
                    'Class' => $masterList->class_id,
                    'SchoolYear' => $masterList->schoolyear_id,
                ];

                // Create a history record before saving the school
                UserHistoryModel::create([
                    'action' => 'Create',
                    'old_value' => null, // For create operation, old_value is null
                    'new_value' => implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($masterListDetails), $masterListDetails)),
                    'table_name' => 'Pupil To Masterlist',
                    'user_id' => $userId,
                ]);

                $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

                // Corresponding names to pupil IDs
                $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                    // Combine first_name, middle_name, and last_name into full_name
                    $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                    return $pupil;
                })->pluck('full_name', 'id')->toArray();

                return redirect('class_adviser/class_adviser/pupil_to_masterlist')->with('success', 'Pupil '. $dataPupilNames[$masterList->pupil_id] . ' successfully added to your masterlist');
            }else{
                return redirect()->back()->with('primary', 'Pupil has already added to your masterlist');
            }

            // Redirect with success message
            
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());

            // Return a generic error response
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function referrals()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Refer Pupil",
                'headerTitle1' => "Refer Pupil",
                'headerMessage1' => "You are initiating a referral for a health concern observed in the pupil. 
                This indicates that you believe the pupil requires additional services. 
                Please review the observation you provided to ensure accuracy. 
                This information will be crucial for addressing the pupil's health needs effectively.",
                'headerMessage2' => "The referral you make will be sent to the school nurse for further assessment and 
                appropriate action. Please ensure that the information provided is clear and comprehensive to facilitate 
                the necessary support for the pupil's health concerns.",
                'headerFilter1' => "Filter Referrals",
                'headerTable1' => "Referrals",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            $dataMasterList['getRecord'] = $models['masterListModel']->getMasterList();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

            // Filter the collection based on the user's id in the classadviser_id column
            $filteredRecords = $dataClass['classRecords']->filter(function ($record) use ($currentUser) {
                return $record->classadviser_id == $currentUser;
            });

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the class adviser is assigned to a classroom
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $models['masterListModel']->getPupilRecord();

            $masterData['getList'] = $models['masterListModel']->getMasterLists();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $pupil = $pupilData['getList']->first();
            $pupilId = $pupil->id;
            $masterlistId = MasterListModel::getIdByPupilId($pupilId);

            $classId = collect($masterData['getList'])->pluck('class_id', $masterlistId)->first();

            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $dataGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $dataSchoolIds = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();
            $dataSchoolNurseIds = collect($dataSchools['getList'])->pluck('school_nurse_id', 'id')->toArray();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

            return view('class_adviser.class_adviser.referrals', compact('data', 'head', 'permitted', 
            'filteredRecords', 'schoolName', 'pupilData', 'activeSchoolYear', 'classId', 'dataClassNames',
            'dataGradeLevel', 'dataSchoolIds', 'dataSchoolNurseIds', 'dataMasterList', 'dataPupilNames', 'dataPupilLRNs' ));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertReferral(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');

            $userId = Auth::user()->id;

            // Create a new school instance and populate its data
            $referral = new ReferralModel();
            $referral->school_nurse_id = $request->school_nurse_id;
            $referral->pupil_id = $request->pupil_id;
            $referral->classadviser_id = $request->classadviser_id;
            $referral->class_id = $request->class_id;
            $referral->schoolyear_id = $request->schoolyear_id;
            $referral->explanation = $request->explanation;
            $referral->program = $request->program;

            $lrn = $request->lrn;

            // Save the school to the database
            $referral->save();

            // Create an associative array of school details
            $referralDetails = [
                'Pupil LRN' => $lrn,
                'Class' => $referral->class_id,
                'SchoolYear' => $referral->schoolyear_id,
                'Program' => $referral->program,
                'Explanation' => $referral->explanation,
            ];

            // Create a history record before saving the school
            UserHistoryModel::create([
                'action' => 'Create',
                'old_value' => null, // For create operation, old_value is null
                'new_value' => implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($referralDetails), $referralDetails)),
                'table_name' => 'Referrals',
                'user_id' => $userId,
            ]);

            // Redirect with success message
            return redirect('class_adviser/class_adviser/referrals')->with('success', ' Pupil successfully referred');
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());

            // Return a generic error response
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function referralsList()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Referrals",
                'headerTitle1' => "Referrals List",
                'headerFilter1' => "Filter Referrals",
                'headerTable1' => "Current Referrals",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['referralModel']->getReferralList();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

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

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

            // Corresponding classroom names to class IDs
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();

            $SchoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $dataSchoolYearPhaseNames = collect($SchoolYear['getRecord'])->map(function ($syPhase) {
                // Combine school year and phase name
                $syPhase['full_name'] = trim("{$syPhase['school_year']} {$syPhase['phase']}");
                return $syPhase;
            })->pluck('full_name', 'id')->toArray();

            return view('class_adviser.class_adviser.referrals_list', compact('data', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'pupilData', 'activeSchoolYear', 'dataPupilNames', 'dataPupilLRNs', 'dataClassNames', 'dataSchoolYearPhaseNames'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function schoolNurseReferrals()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Referrals",
                'headerTitle1' => "Referrals List",
                'headerFilter1' => "Filter Referrals",
                'headerTable1' => "Current Referrals",
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

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

            // Corresponding classroom names to class IDs
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $dataClassGrade = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $dataSchoolId = collect($dataClass['classRecords'])->pluck('school_id', 'id')->toArray();

            $SchoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $dataSchoolYearPhaseNames = collect($SchoolYear['getRecord'])->map(function ($syPhase) {
                // Combine school year and phase name
                $syPhase['full_name'] = trim("{$syPhase['school_year']} {$syPhase['phase']}");
                return $syPhase;
            })->pluck('full_name', 'id')->toArray();

            return view('school_nurse.school_nurse.referrals', compact('data', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'pupilData', 'activeSchoolYear', 'dataPupilNames', 'dataPupilLRNs', 'dataClassNames', 'dataSchoolYearPhaseNames',
            'dataSchoolId', 'dataClassGrade'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reportApproval()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Submit Nutritional Status Report",
                'headerTitle1' => "Submit Nutritional Status Report",
                'headerMessage' => "This action is irreversible. Please review the 
                nutritional assessments of the pupils before proceeding.",
                'headerMessage2' => "Ensure that you understand the implications of this action, 
                as it may impact existing data and overall statistics. 
                Confirm only if you are certain about your decision.",
                'headerTable1' => "Reports",
                'headerMessage3' => "However, you can submit again to update your Nutritional Status Report for this class.",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            $currentUser = Auth::user()->id;
            $user = Auth::user();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

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

            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecord();

            foreach ($dataClassRecord['getRecord'] as $record) {
                // Assuming weight and height are properties of the record object
                $weight = $record->weight;
                $height = $record->height;
            
                // Calculate BMI and add it to the BMI records array
                $bmi = $weight / ($height * $height);
                $record->bmi = number_format($bmi, 2);
                $record->height_squared = $height * $height;

                if ($bmi < 16) {
                    $record->bmiCategory = 'Severely Wasted';
                } elseif ($bmi >= 16.1 && $bmi <= 18.5) {
                    $record->bmiCategory = 'Wasted';
                } elseif ($bmi >= 18.6 && $bmi <= 25) {
                    $record->bmiCategory = 'Normal';
                } elseif ($bmi >= 25.1 && $bmi <= 30) {
                    $record->bmiCategory = 'Overweight';
                } elseif ($bmi >= 30.1 && $bmi <= 35) {
                    $record->bmiCategory = 'Obese';
                }else{
                    $record->bmiCategory = 'Abnormal';
                }

                $dataClassRecord[] = $record;
            }

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
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
            $classIds = collect( $dataMasterListRecord['getRecord'])->pluck('class_id');

            return view('class_adviser.class_adviser.report_approval', compact('data', 'user', 'head', 'permitted', 
                'filteredRecords', 'classSchoolId', 'schoolName', 'activeSchoolYear', 'dataClassRecord', 
                'dataPupilNames', 'dataPupilBDate', 'dataPupilSex',
                'className', 'classGradeLevel', 'sectionIds', 'classIds'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertReport(Request $request)
    {
        try{
            date_default_timezone_set('Asia/Manila');

            $currentUser = Auth::user()->id;
            $schoolyear_id = $request->schoolyear_id;
            $class_id = $request->class_id;
            $school_id = $request->school_id;

            $models = $this->instantiateModels();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

            $grade_level = collect($dataClass['classRecords'])->pluck('grade_level', 'class_id')->first();
            
            $combinedValue = strval($currentUser) . '-' . strval($schoolyear_id) . '-' . strval($class_id);

            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecords();
            $dataNSRLists['getRecord'] = $models['nsrListModel']->getNSRLists();

            // Check if $combinedValue exists in the nsr_code column
            $existingNsrRecord = NsrListModel::where('nsr_code', $combinedValue)->first();

            if ($existingNsrRecord) {
                // Update the existing record
                $existingNsrRecord->update([
                    // Add any fields you want to update here
                    'nsr_code' => $combinedValue,
                    'section_id' => $class_id,
                    'grade_level' => $grade_level,
                    'class_adviser_id' => $currentUser,
                    'schoolyear_id' => $schoolyear_id,
                    'school_id' => $school_id,
                    'cnsr_id' => NULL,
                    'is_approved' => '0',
                    'is_deleted' => '0',
                ]);

                // Retrieve the ID of the updated record
                $nsrId = $existingNsrRecord->id;
            } else {
                // Create a new record
                $nsrRecord = NsrListModel::create([
                    'nsr_code' => $combinedValue,
                    'section_id' => $class_id,
                    'grade_level' => $grade_level,
                    'class_adviser_id' => $currentUser,
                    'schoolyear_id' => $schoolyear_id,
                    'school_id' => $school_id,
                    'cnsr_id' => NULL,
                    'is_approved' => '0',
                    'is_deleted' => '0',
                ]);

                // Retrieve the ID of the newly created record
                $nsrId = $nsrRecord->id;
            }

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();
            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();

            NutritionalAssessmentModel::whereIn('id', $dataClassRecord['getRecord']->pluck('id'))
            ->where('class_id', $class_id)
            ->where('schoolyear_id', $schoolyear_id)
            ->update(['nsr_id' => $nsrId]);

            $nutritionalAssessmentRecords['getRecord'] = $models['nutritionalAssessmentModel']->getNutritionalAssessment($nsrId);

            $nsrUpdateRecord = NsrListModel::find($nsrId);

            $nsrUpdateRecord->no_of_pupils = $nutritionalAssessmentRecords['getRecord']->count();
            
            // Initialize counters for HFA categories
            $severelyStuntedCount = 0;
            $stuntedCount = 0;
            $normalCount = 0;
            $tallCount = 0;
            $maleCount = 0;
            $femaleCount = 0;
            $maleSeverelyStuntedCount = 0;
            $femaleSeverelyStuntedCount = 0;
            $maleStuntedCount = 0;
            $femaleStuntedCount = 0;
            $maleNormalCount = 0;
            $femaleNormalCount = 0;
            $maleTallCount = 0;
            $femaleTallCount = 0;
            
            foreach ($nutritionalAssessmentRecords['getRecord'] as $record) {

                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$record->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
                $sex = $dataPupilSex[$record->pupil_id];

                // Calculate HFA category
                $hfaResult = $this->calculateHfaCategory($age, $sex, $record->height);
            
                // Update counters based on HFA category
                switch ($hfaResult['hfaCategory']) {
                    case 'Severely Stunted':
                        $severelyStuntedCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleSeverelyStuntedCount++;
                                break;
                            case 'Female':
                                $femaleSeverelyStuntedCount++;
                                break;
                        }
                        break;
                    case 'Stunted':
                        $stuntedCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleStuntedCount++;
                                break;
                            case 'Female':
                                $femaleStuntedCount++;
                                break;
                        }
                        break;
                    case 'Normal':
                        $normalCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleNormalCount++;
                                break;
                            case 'Female':
                                $femaleNormalCount++;
                                break;
                        }
                        break;
                    case 'Tall':
                        $tallCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleTallCount++;
                                break;
                            case 'Female':
                                $femaleTallCount++;
                                break;
                        }
                        break;
                    default:
                        // Handle other cases if needed
                        break;
                }

                switch ($sex) {
                    case 'Male':
                        $maleCount++;
                        break;
                    case 'Female':
                        $femaleCount++;
                        break;
                }
            }

            // Update HFA-related counters in $nsrUpdateRecord
            $nsrUpdateRecord->no_of_severely_stunted = $severelyStuntedCount;
            $nsrUpdateRecord->no_of_stunted = $stuntedCount;
            $nsrUpdateRecord->no_of_height_normal = $normalCount;
            $nsrUpdateRecord->no_of_tall = $tallCount;

            $nsrUpdateRecord->no_of_male_pupils = $maleCount;
            $nsrUpdateRecord->no_of_female_pupils = $femaleCount;

            $nsrUpdateRecord->no_of_male_severely_stunted = $maleSeverelyStuntedCount;
            $nsrUpdateRecord->no_of_female_severely_stunted = $femaleSeverelyStuntedCount;

            $nsrUpdateRecord->no_of_male_stunted = $maleStuntedCount;
            $nsrUpdateRecord->no_of_female_stunted = $femaleStuntedCount;

            $nsrUpdateRecord->no_of_male_height_normal = $maleNormalCount;
            $nsrUpdateRecord->no_of_female_height_normal = $femaleNormalCount;

            $nsrUpdateRecord->no_of_male_tall = $maleTallCount;
            $nsrUpdateRecord->no_of_female_tall = $femaleTallCount;

            // Calculate sum of stunted pupils
            $nsrUpdateRecord->no_of_stunted_pupils = $nsrUpdateRecord->no_of_severely_stunted + $nsrUpdateRecord->no_of_stunted;
            $nsrUpdateRecord->no_of_male_stunted_pupils = $nsrUpdateRecord->no_of_male_severely_stunted + $nsrUpdateRecord->no_of_male_stunted;
            $nsrUpdateRecord->no_of_female_stunted_pupils = $nsrUpdateRecord->no_of_female_severely_stunted + $nsrUpdateRecord->no_of_female_stunted;
            
            // Initialize counters for BMI categories
            $severelyWastedCount = 0;
            $wastedCount = 0;
            $normalCount = 0;
            $overweightCount = 0;
            $obeseCount = 0;
            $maleSeverelyWastedCount = 0;
            $femaleSeverelyWastedCount = 0;
            $maleWastedCount = 0;
            $femaleWastedCount = 0;
            $maleNormalWeightCount = 0;
            $femaleNormalWeightCount = 0;
            $maleOverweightCount = 0;
            $femaleOverweightCount = 0;
            $maleObeseCount = 0;
            $femaleObeseCount = 0;

            foreach ($nutritionalAssessmentRecords['getRecord'] as $record) {

                $sex = $dataPupilSex[$record->pupil_id];
                
                // Calculate BMI
                $bmi = $record->weight / ($record->height * $record->height);

                // Update counters based on BMI category
                switch ($this->getBmiCategory($bmi)) {
                    case 'Severely Wasted':
                        $severelyWastedCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleSeverelyWastedCount++;
                                break;
                            case 'Female':
                                $femaleSeverelyWastedCount++;
                                break;
                        }
                        break;
                    case 'Wasted':
                        $wastedCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleWastedCount++;
                                break;
                            case 'Female':
                                $femaleWastedCount++;
                                break;
                        }
                        break;
                    case 'Normal':
                        $normalCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleNormalWeightCount++;
                                break;
                            case 'Female':
                                $femaleNormalWeightCount++;
                                break;
                        }
                        break;
                    case 'Overweight':
                        $overweightCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleOverweightCount++;
                                break;
                            case 'Female':
                                $femaleOverweightCount++;
                                break;
                        }
                        break;
                    case 'Obese':
                        $obeseCount++;
                        switch ($sex) {
                            case 'Male':
                                $maleObeseCount++;
                                break;
                            case 'Female':
                                $femaleObeseCount++;
                                break;
                        }
                        break;
                    default:
                        // Handle other cases if needed
                        break;
                }
            }

            

            // Update BMI-related counters in $nsrUpdateRecord
            $nsrUpdateRecord->no_of_severely_wasted = $severelyWastedCount;
            $nsrUpdateRecord->no_of_wasted = $wastedCount;
            $nsrUpdateRecord->no_of_weight_normal = $normalCount;
            $nsrUpdateRecord->no_of_overweight = $overweightCount;
            $nsrUpdateRecord->no_of_obese = $obeseCount;

            $nsrUpdateRecord->no_of_male_severely_wasted = $maleSeverelyWastedCount;
            $nsrUpdateRecord->no_of_female_severely_wasted = $femaleSeverelyWastedCount;

            $nsrUpdateRecord->no_of_male_wasted = $maleWastedCount;
            $nsrUpdateRecord->no_of_female_wasted = $femaleWastedCount;

            $nsrUpdateRecord->no_of_male_weight_normal = $maleNormalWeightCount;
            $nsrUpdateRecord->no_of_female_weight_normal = $femaleNormalWeightCount;

            $nsrUpdateRecord->no_of_male_overweight = $maleOverweightCount;
            $nsrUpdateRecord->no_of_female_overweight = $femaleOverweightCount;

            $nsrUpdateRecord->no_of_male_obese = $maleObeseCount;
            $nsrUpdateRecord->no_of_female_obese = $femaleObeseCount;

            // Calculate sum of malnourished pupils
            $nsrUpdateRecord->no_of_malnourished_pupils = $nsrUpdateRecord->no_of_severely_wasted + $nsrUpdateRecord->no_of_wasted;

            $nsrUpdateRecord->no_of_male_malnourished_pupils = $nsrUpdateRecord->no_of_male_severely_wasted + $nsrUpdateRecord->no_of_male_wasted;
            $nsrUpdateRecord->no_of_female_malnourished_pupils = $nsrUpdateRecord->no_of_female_severely_wasted + $nsrUpdateRecord->no_of_female_wasted;

            // Update the record
            $nsrUpdateRecord->update();

            return redirect('class_adviser/class_adviser/approved_report')->with('success', 'Report successfully submitted.');
        }
        catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reportList()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Nutritional Status Report/s",
                'headerTitle1' => "Nutritional Status Report/s",
                'headerTable1' => "Reports",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            $currentUser = Auth::user()->id;
            $user = Auth::user();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

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

            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecord();

            foreach ($dataClassRecord['getRecord'] as $record) {
                // Assuming weight and height are properties of the record object
                $weight = $record->weight;
                $height = $record->height;
            
                // Calculate BMI and add it to the BMI records array
                $bmi = $weight / ($height * $height);
                $record->bmi = number_format($bmi, 2);
                $record->height_squared = $height * $height;

                if ($bmi < 16) {
                    $record->bmiCategory = 'Severely Wasted';
                } elseif ($bmi >= 16.1 && $bmi <= 18.5) {
                    $record->bmiCategory = 'Wasted';
                } elseif ($bmi >= 18.6 && $bmi <= 25) {
                    $record->bmiCategory = 'Normal';
                } elseif ($bmi >= 25.1 && $bmi <= 30) {
                    $record->bmiCategory = 'Overweight';
                } elseif ($bmi >= 30.1 && $bmi <= 35) {
                    $record->bmiCategory = 'Obese';
                }else{
                    $record->bmiCategory = 'Abnormal';
                }

                $dataClassRecord[] = $record;
            }

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            $dataNSRLists['getRecord'] = $models['nsrListModel']->getNSRLists();
            $dataMasterListRecord['getRecord'] = $models['masterListModel']->getMasterLists();

            $sectionIds = collect($dataNSRLists['getRecord'])->pluck('section_id');
            $classIds = collect( $dataMasterListRecord['getRecord'])->pluck('class_id');

            return view('class_adviser.class_adviser.report_list', compact('data', 'user', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'activeSchoolYear', 'dataClassRecord', 'dataPupilNames', 'dataPupilBDate', 'dataPupilSex',
                'className', 'classGradeLevel', 'sectionIds', 'classIds'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function approvedReport()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Submitted Nutritional Status Report",
                'headerTitle1' => "Submitted Nutritional Status Report",
                'headerTable1' => "Reports",
                'headerMessage3' => "However, you can submit again to update your Nutritional Status Report for this class.",
                'skipMessage' => "You can skip this"
            ];

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            // Get current user information
            $currentUser = Auth::user()->id;
            $user = Auth::user();

            // Get and filter class records for the current user
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();
            $filteredRecords = $dataClass['classRecords']->filter(fn($record) => $record->classadviser_id == $currentUser);

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Get class records
            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecord();

            // Get list of pupil records
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

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
                $value->bmiScore = number_format($bmi, 2);
                $value->height_squared = $value->height * $value->height;

                // Add BMI category and color to the $value object
                $value->bmiCategory = $this->getBmiCategory($bmi);
                $value->bmiColorSpinner = $this->getSpinnerColorClass($value->bmiCategory);

                // Calculate HFA category and add to the $value object
                $hfaInfo = $this->calculateHfaCategory($age, $sex, $value->height);
                $value->hfaCategory = $hfaInfo['hfaCategory'];
                $value->zscore = $hfaInfo['zScore'];
            }

            return view('class_adviser.class_adviser.approved_report', compact(
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

    public function viewNSR()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            $head = [
                'headerTitle' => "Submitted Nutritional Status Report",
                'headerTitle1' => "Submitted Nutritional Status Report",
                'headerTable1' => "Reports",
                'headerMessage3' => "However, you can submit again to update your Nutritional Status Report for this class.",
                'skipMessage' => "You can skip this"
            ];

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            // Get current user information
            $currentUser = Auth::user()->id;
            $user = Auth::user();

            // Get and filter class records for the current user
            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();
            $filteredRecords = $dataClass['classRecords']->filter(fn($record) => $record->classadviser_id == $currentUser);

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            // Get last active school year phase
            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            // Get class records
            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecord();

            // Get list of pupil records
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

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
                $value->bmiScore = number_format($bmi, 2);
                $value->height_squared = $value->height * $value->height;

                // Add BMI category and color to the $value object
                $value->bmiCategory = $this->getBmiCategory($bmi);
                $value->bmiColorSpinner = $this->getSpinnerColorClass($value->bmiCategory);

                // Calculate HFA category and add to the $value object
                $hfaInfo = $this->calculateHfaCategory($age, $sex, $value->height);
                $value->hfaCategory = $hfaInfo['hfaCategory'];
                $value->zscore = $hfaInfo['zScore'];
            }

            return view('class_adviser.class_adviser.view_nsr', compact(
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

    public function viewMasterlist()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "MasterList",
                'headerTitle1' => "Add Pupil To Classroom",
                'headerMessage1' => "Warning: You are about to add a pupil to the masterlist. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter MasterList",
                'headerTable1' => "Current Pupils In MasterList",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterListPDF();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

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

            return view('class_adviser.class_adviser.view_masterlist', compact('data', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'pupilData', 'activeSchoolYear', 'dataPupilNames', 'dataPupilLRNs', 'dataClassNames', 'dataSchoolYearPhaseNames',
            'dataPupilAddress', 'dataPupilBDate', 'dataPupilGender', 'dataPupilGuardian', 'dataPupilGuardianCo', 'className','classGradeLevel', 'classSchoolId'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function editNA()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Update Pupil's Nutritional Assessments",
                'headerTitle1' => "Nutritional Assessments",
                'headerTable1' => "Reports",
                'headerMessage1' => "Confirm only if you are certain about your decision.",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            $currentUser = Auth::user()->id;
            $user = Auth::user();

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentUser();

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

            $dataClassRecord['getRecord'] = $models['masterListModel']->getClassRecord();

            foreach ($dataClassRecord['getRecord'] as $record) {
                // Assuming weight and height are properties of the record object
                $weight = $record->weight;
                $height = $record->height;
            
                // Calculate BMI and add it to the BMI records array
                $bmi = $weight / ($height * $height);
                $record->bmi = number_format($bmi, 2);
                $record->height_squared = $height * $height;

                if ($bmi < 16) {
                    $record->bmiCategory = 'Severely Wasted';
                } elseif ($bmi >= 16.1 && $bmi <= 18.5) {
                    $record->bmiCategory = 'Wasted';
                } elseif ($bmi >= 18.6 && $bmi <= 25) {
                    $record->bmiCategory = 'Normal';
                } elseif ($bmi >= 25.1 && $bmi <= 30) {
                    $record->bmiCategory = 'Overweight';
                } elseif ($bmi >= 30.1 && $bmi <= 35) {
                    $record->bmiCategory = 'Obese';
                }else{
                    $record->bmiCategory = 'Abnormal';
                }

                $dataClassRecord[] = $record;
            }

            // Get list of pupil record
            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            // Corresponding names to pupil IDs
            $dataPupilNames = collect($dataPupil['getRecord'])->map(function ($pupil) {
                // Combine first_name, middle_name, and last_name into full_name
                $pupil['full_name'] = trim("{$pupil['first_name']} {$pupil['middle_name']} {$pupil['last_name']}, {$pupil['suffix']}");
                return $pupil;
            })->pluck('full_name', 'id')->toArray();

            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $classGradeLevel = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();

            $dataNSRLists['getRecord'] = $models['nsrListModel']->getNSRLists();
            $dataMasterListRecord['getRecord'] = $models['masterListModel']->getMasterLists();

            $sectionIds = collect($dataNSRLists['getRecord'])->pluck('section_id');
            $classIds = collect( $dataMasterListRecord['getRecord'])->pluck('class_id');

            return view('class_adviser.class_adviser.edit_na', compact('data', 'user', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'activeSchoolYear', 'dataClassRecord', 'dataPupilNames', 'dataPupilBDate', 'dataPupilSex',
                'className', 'classGradeLevel', 'sectionIds', 'classIds'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateNA($id)
    {
        try {
            // Set the default timezone to Asia/Manila
            date_default_timezone_set('Asia/Manila');
    
            // Set the headers and messages
            $head = [
                'headerTitle' => "Update Pupil's Nutritional Assessment",
                'headerCaption' => "You will update this pupil? Please be aware of the changes you will make",
            ];
    
            // Use dependency injection for models
            $nutritionalAssessmentModel = app(NutritionalAssessmentModel::class);

            // Retrieve the district record with the given ID
            $data['getNARecord'] = $nutritionalAssessmentModel->findOrFail($id);
    
            return view('class_adviser.class_adviser.na_page', compact('head', 'data'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
    
            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateActionNA($id, Request $request)
    {
        try {
            // Retrieve the record with the given ID
            $pupilNA = NutritionalAssessmentModel::where('id', $id)->first();

            $userId = Auth::user()->id;

            $nutritionalAssessmentModel = app(NutritionalAssessmentModel::class);

            // Retrieve the district record with the given ID
            $data['nutritionalAssessmentRecord'] = $nutritionalAssessmentModel->findOrFail($id);

            $dataPupil['getRecord'] = app(PupilModel::class)->getPupilRecords();
            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$request->pupil_id]);
            $age = $birthdate->diff(\Carbon\Carbon::now());
            $sex = $dataPupilSex[$request->pupil_id];

            // Update pupil information based on the request data
            $pupilNA->height = $request->height;
            $pupilNA->weight = $request->weight;

            $heightInMeters = $pupilNA->height;

            // Calculate BMI
            $bmi = $pupilNA->weight / ($heightInMeters * $heightInMeters);

            $pupilNA->bmi = $this->getBmiCategory($bmi);
            $pupilNA->hfa = $this->calculateHfaCategory($age, $sex, $request->height)['hfaCategory'];
            $pupilNA->is_dewormed = $request->is_dewormed;
            $pupilNA->dewormed_date = date($request->dewormed_date);
            $pupilNA->is_permitted_deworming = $request->is_permitted_deworming;
            $pupilNA->dietary_restriction = trim($request->dietary_restriction);
            $pupilNA->explanation = trim($request->explanation);

            // Save the updated pupil to the database
            $pupilNA->save();

            if (isset($data['nutritionalAssessmentRecord'])) {
                $oldData = [
                    'Height' => $data['nutritionalAssessmentRecord']->height,
                    'Weight' => $data['nutritionalAssessmentRecord']->weight,
                    'Is Dewormed' => $data['nutritionalAssessmentRecord']->is_dewormed,
                    'Dewormed Date' => $data['nutritionalAssessmentRecord']->dewormed_date,
                    'Is Permitted Deworming' => $data['nutritionalAssessmentRecord']->is_permitted_deworming,
                    'Dietary Restriction' => $data['nutritionalAssessmentRecord']->dietary_restriction,
                    'Explanation' => $data['nutritionalAssessmentRecord']->explanation,
                ];
            
                $newValue = implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($data), $data));
                $oldValue = implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($oldData), $oldData));
            
                UserHistoryModel::create([
                    'action' => 'Update',
                    'old_value' => $oldValue,
                    'new_value' => $newValue,
                    'table_name' => 'Nutritional Assessments',
                    'user_id' => $userId,
                ]);
            } else {
                // Handle the case where 'nutritionalAssessmentRecord' is not present in $data
                // You may want to log an error, throw an exception, or take appropriate action.
            }

            // Redirect to the masterList page with a success message
            return redirect('class_adviser/class_adviser/edit_na')->with('success', "Nutritional Assessment is successfully updated");
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
    
            // Redirect back with a generic error message if an exception occurs
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function searchPupil()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Pupil's Health Profile",
                'headerTitle1' => "Pupil's Health Profile",
                'headerFilter1' => "Pupil's Health Profile",
                'headerTable1' => "Pupil's Health Profile",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            $dataClassAdviser['getList'] = $models['userModel']->getClassAdvisers();
            $dataSchoolNurse['getList'] = $models['userModel']->getSchoolNurses();

            $dataClassroom['getList'] = $models['classroomModel']->getClassroomRecords();

            $schoolIds = collect($dataClassroom['getList'])->pluck('school_id', 'id')->toArray();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtIds = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $gradeName = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $adviserName = collect($dataClassAdviser['getList'])->pluck('name', 'id')->toArray();
            $schoolNurseName = collect($dataSchoolNurse['getList'])->pluck('name', 'id')->toArray();

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $models['masterListModel']->getPupilRecord();
            $pupilDataLineUp['getList'] = $models['masterListModel']->getPupilRecordLineUps();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $pupilBasicProfile['getList'] = $models['pupilModel']->searchedPupil();

            $pupilBasicProfileByName['getList'] = $models['pupilModel']->searchedPupilByName();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $dataPupilLRN = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

            $nsrRecords['getRecords'] = $models['nutritionalAssessmentModel']->getNArecordsBySchoolNurse();

            $nsrBMIArray = [];
            $nsrBMIArrayLabels = [];
            $nsrHFAArrayLabels = [];
            $nsrLabelsArray = [];

            foreach ($nsrRecords['getRecords'] as $na) {

                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$na->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
                $sex = $dataPupilSex[$na->pupil_id];

                // Assuming height and weight are available in your $na object
                $height = $na->height;
                $weight = $na->weight;
            
                // Calculate BMI
                $bmi = $weight / ($height * $height);

                $formattedBmi = number_format($bmi, 2);
            
                // Add the calculated BMI to the $na object
                $na->bmi = $formattedBmi;

                $bmiCategory = $this->getBmiCategory($bmi);
                $bmiColorSpinner = $this->getSpinnerColorClass($bmiCategory);

                $hfaInfo = $this->calculateHfaCategory($age, $sex, $na->height);
                $na->hfaCategory = $hfaInfo['hfaCategory'];
                $na->zscore = $hfaInfo['zScore'];

                $hfa = $hfaInfo['zScore'];

                $formattedHfa = number_format($na->zscore, 2);

                // Add BMI category to the $na object
                $na->bmiCategory = $bmiCategory;
                $na->bmiColorSpinner = $bmiColorSpinner;

                $nsrBMIArray[] = $formattedBmi;
                $nsrHFAArray[] = $formattedHfa;
                $nsrLabelsArray[] = $gradeName[$na->class_id];
            }

            $nsrBMIArrayPupil = $nsrBMIArray ?? [];
            $nsrHFAArrayPupil = $nsrHFAArray ?? [];

            $nsrArrayLabels = $nsrLabelsArray ?? [];

            $schoolYearName = collect($schoolYear['getRecord'])->pluck('school_year', 'id')->toArray();
            $schoolYearPhase = collect($schoolYear['getRecord'])->pluck('phase', 'id')->toArray();

            $beneficiaryData['getList'] = $models['beneficiaryModel']->getSpecifiedBeneficiary();

            return view('school_nurse.school_nurse.search_pupil', compact('data', 'head', 'schoolName', 'className', 'gradeName', 'adviserName',
            'pupilData', 'activeSchoolYear', 'pupilBasicProfile', 'dataSchools', 'schoolIds', 'schoolNurseName',
            'nsrRecords', 'schoolYearName', 'schoolYearPhase', 'beneficiaryData', 'nsrBMIArrayPupil', 'nsrArrayLabels',
        'nsrHFAArrayPupil', 'pupilDataLineUp', 'districtIds', 'districtName', 'dataPupilLRN', 'pupilBasicProfileByName'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function searchPupilByClassAdviser(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Pupil Profile",
                'headerTitle1' => "Pupil Profile",
                'headerFilter1' => "Pupil Profile",
                'headerTable1' => "Pupil Profile",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['masterListModel']->getMasterList();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentSchoolNurse();

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            $dataClassAdviser['getList'] = $models['userModel']->getClassAdvisers();
            $dataSchoolNurse['getList'] = $models['userModel']->getSchoolNurses();

            $dataClassroom['getList'] = $models['classroomModel']->getClassroomRecords();

            $schoolIds = collect($dataClassroom['getList'])->pluck('school_id', 'id')->toArray();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtIds = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $gradeName = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $adviserName = collect($dataClassAdviser['getList'])->pluck('name', 'id')->toArray();
            $schoolNurseName = collect($dataSchoolNurse['getList'])->pluck('name', 'id')->toArray();

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $models['masterListModel']->getPupilRecord();
            $pupilDataLineUp['getList'] = $models['masterListModel']->getPupilRecordLineUps();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $schoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $pupilBasicProfile['getList'] = $models['pupilModel']->searchedPupil();

            $pupilBasicProfileByName['getList'] = $models['pupilModel']->searchedPupilByName();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();

            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();

            $nsrRecords['getRecords'] = $models['nutritionalAssessmentModel']->getNArecordsBySchoolNurse();

            $nsrBMIArray = [];
            $nsrBMIArrayLabels = [];
            $nsrHFAArrayLabels = [];
            $nsrLabelsArray = [];

            foreach ($nsrRecords['getRecords'] as $na) {

                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$na->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
                $sex = $dataPupilSex[$na->pupil_id];

                // Assuming height and weight are available in your $na object
                $height = $na->height;
                $weight = $na->weight;
            
                // Calculate BMI
                $bmi = $weight / ($height * $height);

                $formattedBmi = number_format($bmi, 2);
            
                // Add the calculated BMI to the $na object
                $na->bmi = $formattedBmi;

                $bmiCategory = $this->getBmiCategory($bmi);
                $bmiColorSpinner = $this->getSpinnerColorClass($bmiCategory);

                $hfaInfo = $this->calculateHfaCategory($age, $sex, $na->height);
                $na->hfaCategory = $hfaInfo['hfaCategory'];
                $na->zscore = $hfaInfo['zScore'];

                $hfa = $hfaInfo['zScore'];

                $formattedHfa = number_format($na->zscore, 2);

                // Add BMI category to the $na object
                $na->bmiCategory = $bmiCategory;
                $na->bmiColorSpinner = $bmiColorSpinner;

                $nsrBMIArray[] = $formattedBmi;
                $nsrHFAArray[] = $formattedHfa;
                $nsrLabelsArray[] = $gradeName[$na->class_id];
            }

            $nsrBMIArrayPupil = $nsrBMIArray ?? [];
            $nsrHFAArrayPupil = $nsrHFAArray ?? [];

            $nsrArrayLabels = $nsrLabelsArray ?? [];

            $schoolYearName = collect($schoolYear['getRecord'])->pluck('school_year', 'id')->toArray() ?? [];
            $schoolYearPhase = collect($schoolYear['getRecord'])->pluck('phase', 'id')->toArray() ?? [];

            $beneficiaryData['getList'] = $models['beneficiaryModel']->getSpecifiedBeneficiary() ?? [];

            return view('class_adviser.class_adviser.search_pupil', compact('data', 'head', 'schoolName', 'className', 'gradeName', 'adviserName',
            'pupilData', 'activeSchoolYear', 'pupilBasicProfile', 'dataSchools', 'schoolIds', 'schoolNurseName',
            'nsrRecords', 'schoolYearName', 'schoolYearPhase', 'beneficiaryData', 'nsrBMIArrayPupil', 'nsrArrayLabels',
            'nsrHFAArrayPupil', 'pupilDataLineUp', 'districtIds', 'districtName', 'pupilBasicProfileByName'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function searchPupilByMedicalOfficer()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Pupil's Health Profile",
                'headerTitle1' => "Pupil's Health Profile",
                'headerFilter1' => "Pupil's Health Profile",
                'headerTable1' => "Pupil's Health Profile",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecordsForCurrentMedicalOfficer();
            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $models['schoolModel']->getSchoolRecords();
            $dataDistricts['getList'] = $models['districtModel']->getDistrictRecords();

            $dataClassAdviser['getList'] = $models['userModel']->getClassAdvisers();
            $dataSchoolNurse['getList'] = $models['userModel']->getSchoolNurses();

            $dataClassroom['getList'] = $models['classroomModel']->getClassroomRecords();

            $schoolIds = collect($dataClassroom['getList'])->pluck('school_id', 'id')->toArray();
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            $className = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();
            $gradeName = collect($dataClass['classRecords'])->pluck('grade_level', 'id')->toArray();
            $adviserName = collect($dataClassAdviser['getList'])->pluck('name', 'id')->toArray();
            $schoolNurseName = collect($dataSchoolNurse['getList'])->pluck('name', 'id')->toArray();

            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();
            $districtIds = collect($dataSchools['getList'])->pluck('district_id', 'id')->toArray();
            $districtName = collect($dataDistricts['getList'])->pluck('district', 'id')->toArray();

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $models['masterListModel']->getPupilRecord();

            $activeSchoolYear['getRecord'] = $models['schoolYearModel']->getLastActiveSchoolYearPhase();

            $pupilBasicProfileByName['getList'] = $models['pupilModel']->searchedPupilByName();

            $schoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $pupilBasicProfile['getList'] = $models['pupilModel']->searchedPupil();

            $dataPupil['getRecord'] = $models['pupilModel']->getPupilRecords();
            $pupilDataLineUp['getList'] = $models['masterListModel']->getPupilRecordLineUps();

            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();

            $nsrRecords['getRecords'] = $models['nutritionalAssessmentModel']->getNArecordsBySchoolNurse();

            $nsrBMIArray = [];
            $nsrBMIArrayLabels = [];
            $nsrHFAArrayLabels = [];
            $nsrLabelsArray = [];

            foreach ($nsrRecords['getRecords'] as $na) {

                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$na->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
                $sex = $dataPupilSex[$na->pupil_id];

                // Assuming height and weight are available in your $na object
                $height = $na->height;
                $weight = $na->weight;
            
                // Calculate BMI
                $bmi = $weight / ($height * $height);

                $formattedBmi = number_format($bmi, 2);
            
                // Add the calculated BMI to the $na object
                $na->bmi = $formattedBmi;

                $bmiCategory = $this->getBmiCategory($bmi);
                $bmiColorSpinner = $this->getSpinnerColorClass($bmiCategory);

                $hfaInfo = $this->calculateHfaCategory($age, $sex, $na->height);
                $na->hfaCategory = $hfaInfo['hfaCategory'];
                $na->zscore = $hfaInfo['zScore'];

                $hfa = $hfaInfo['zScore'];

                $formattedHfa = number_format($na->zscore, 2);

                // Add BMI category to the $na object
                $na->bmiCategory = $bmiCategory;
                $na->bmiColorSpinner = $bmiColorSpinner;

                $nsrBMIArray[] = $formattedBmi;
                $nsrHFAArray[] = $formattedHfa;
                $nsrLabelsArray[] = $gradeName[$na->class_id];
            }

            $nsrBMIArrayPupil = $nsrBMIArray ?? [];
            $nsrHFAArrayPupil = $nsrHFAArray ?? [];

            $nsrArrayLabels = $nsrLabelsArray ?? [];

            $schoolYearName = collect($schoolYear['getRecord'])->pluck('school_year', 'id')->toArray();
            $schoolYearPhase = collect($schoolYear['getRecord'])->pluck('phase', 'id')->toArray();

            $beneficiaryData['getList'] = $models['beneficiaryModel']->getSpecifiedBeneficiary();
            
            return view('medical_officer.medical_officer.search_pupil', compact('head', 'schoolName', 'className', 'gradeName', 'adviserName',
            'pupilData', 'activeSchoolYear', 'pupilBasicProfile', 'dataSchools', 'schoolIds', 'schoolNurseName',
            'nsrRecords', 'schoolYearName', 'schoolYearPhase', 'beneficiaryData', 'nsrBMIArrayPupil', 'nsrArrayLabels',
        'nsrHFAArrayPupil', 'pupilDataLineUp', 'districtIds', 'districtName', 'pupilBasicProfileByName'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteReferral($id){
        try {
            // Find the record by ID
            $pupil = ReferralModel::findOrFail($id);

            $userId = Auth::user()->id;

            // Mark the district as deleted
            $pupil->is_deleted = '1';
            $pupil->save();

            UserHistoryModel::create([
                'action' => 'Delete',
                'old_value' => $pupil->pupil_id,
                'new_value' => null,
                'table_name' => 'referral',
                'user_id' => $userId,
            ]);

            // Redirect with success message
            return redirect()->route('school_nurse.school_nurse.referrals')->with('success', "{$pupil->last_name}, {$pupil->first_name} is successfully archived");
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with an error message if an exception occurs
            return redirect()->back()->with('error', 'Failed to delete district: ' . $e->getMessage());
        }
    }

    public function referralsArchive()
    {
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Referrals",
                'headerTitle1' => "Referrals List",
                'headerFilter1' => "Filter Referrals",
                'headerTable1' => "Current Referrals",
                'headerTable2' => "",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $models = $this->instantiateModels();

            // Get records from the users table
            $data['getRecord'] = $models['referralModel']->getDeletedReferralList();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $models['classroomModel']->getClassroomRecords();

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

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

            // Corresponding classroom names to class IDs
            $dataClassNames = collect($dataClass['classRecords'])->pluck('section', 'id')->toArray();

            $SchoolYear['getRecord'] = $models['schoolYearModel']->getSchoolYearPhase();

            $dataSchoolYearPhaseNames = collect($SchoolYear['getRecord'])->map(function ($syPhase) {
                // Combine school year and phase name
                $syPhase['full_name'] = trim("{$syPhase['school_year']} {$syPhase['phase']}");
                return $syPhase;
            })->pluck('full_name', 'id')->toArray();

            return view('school_nurse.school_nurse.referrals_archive', compact('data', 'head', 'permitted', 'filteredRecords', 
                'schoolName', 'pupilData', 'activeSchoolYear', 'dataPupilNames', 'dataPupilLRNs', 'dataClassNames', 'dataSchoolYearPhaseNames'));
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function recoverReferral($id){
        try {
            // Find the record by ID
            $pupil = ReferralModel::findOrFail($id);

            $userId = Auth::user()->id;

            // Mark the district as deleted
            $pupil->is_deleted = '0';
            $pupil->save();

            UserHistoryModel::create([
                'action' => 'Recover',
                'old_value' => $pupil->pupil_id,
                'new_value' => null,
                'table_name' => 'referral',
                'user_id' => $userId,
            ]);

            // Redirect with success message
            return redirect()->route('school_nurse.school_nurse.referrals_archive')->with('success', "{$pupil->last_name}, {$pupil->first_name} is successfully unarchive");
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());

            // Redirect back with an error message if an exception occurs
            return redirect()->back()->with('error', 'Failed to unarchive: ' . $e->getMessage());
        }
    }
}
