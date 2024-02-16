<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NutritionalAssessmentModel;
use App\Models\ClassroomModel;
use App\Models\MasterListModel;
use App\Models\NsrListModel;
use App\Models\SchoolModel;
use App\Models\PupilModel;
use App\Models\HfaModel;
use App\Models\SchoolYearModel;
use App\Models\SectionModel;
use App\Models\UserHistoryModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class NutritionalAssessmentController extends Controller{
    
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

    public function nutritionalAssessment(){
        try {
            date_default_timezone_set('Asia/Manila');

            $head = [
                'headerTitle' => "Pupil Nutritional Assessment",
                'headerTitle1' => "Create Pupil's Nutritional Assessment",
                'headerMessage1' => "Warning: You are about to add an assessment. 
                                    Please ensure that you understand the implications of this action, 
                                    as it may affect existing data and overall statistics. 
                                    Confirm only if you are certain about your decision.",
                'headerFilter1' => "Filter Pupil Nutritional Assessments",
                'headerTable1' => "Nutritional Assessments",
                'skipMessage' => "You can skip this"
            ];

            // Use dependency injection to create instances
            $nutritionalModel = app(NutritionalAssessmentModel::class);
            $classroomModel = app(ClassroomModel::class);
            $schoolModel = app(SchoolModel::class);
            $schoolYearModel = app(SchoolYearModel::class);
            $masterListModel = app(MasterListModel::class);
            $pupilModel = app(PupilModel::class);
            $sectionModel = app(SectionModel::class);

            // Get records from the users table
            $data['getRecord'] = $nutritionalModel->getNutritionalAssessments();

            $dataNAs['getRecords'] = $nutritionalModel->getNArecordsByClassAdviser();
            $dataNA['getRecords'] = $nutritionalModel->getSingleNArecordsByClassAdviser();

            $dataMasterList['getRecord'] = $masterListModel->getMasterList();

            // Get records from the class table for the current user
            $currentUser = Auth::user()->id;

            $dataClass['classRecords'] = $classroomModel->getClassroomRecordsForCurrentUser();

            // Filter the collection based on the user's id in the classadviser_id column
            $filteredRecords = $dataClass['classRecords']->filter(function ($record) use ($currentUser) {
                return $record->classadviser_id == $currentUser;
            });

            // Fetch schools using SchoolModel
            $dataSchools['getList'] = $schoolModel->getSchoolRecords();

            // Corresponding emails to medical officer IDs
            $schoolName = collect($dataSchools['getList'])->pluck('school', 'id')->toArray();

            // Set the permitted value based on whether the user is a class adviser
            $permitted = $dataClass['classRecords']->isEmpty() ? 0 : 1;

            $activeSchoolYear['getRecord'] = $schoolYearModel->getLastActiveSchoolYearPhase();

            // Retrieve pupil data based on LRN
            $pupilData['getList'] = $masterListModel->getMasterList();

            $dataPupil['getRecord'] = $pupilModel->getPupilRecords();

            $dataPupilLRNs = collect($dataPupil['getRecord'])->pluck('lrn', 'id')->toArray();

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

            $dataSection['getRecords'] = $sectionModel->getSectionsByAdmin();

            $sectionNames = collect($dataSection['getRecords'])->pluck('section_name', 'id')->toArray();

            return view('class_adviser.class_adviser.nutritional_assessment', compact('data', 'head', 'filteredRecords', 
                'permitted', 'schoolName', 'activeSchoolYear', 'pupilData', 'dataPupilLRNs', 'dataPupilNames', 'dataMasterList',
            'dataPupilAddress', 'dataPupilLRNs', 'dataPupilBDate', 'dataPupilGender', 'dataNAs', 'dataNA', 'sectionNames'));

        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function insertNA(Request $request)
    {
        try {
            // Set the default timezone
            date_default_timezone_set('Asia/Manila');
    
            $masterListModel = app(MasterListModel::class);
            $schoolYearModel = app(SchoolYearModel::class);
    
            $pupilId = $request->pupil_id;
            $pupilData['getList'] = $masterListModel->getMasterListByPupilId($pupilId);
    
            $userId = Auth::user()->id;

            $dataSchoolYear['getActiveSchoolYearPhase'] = $schoolYearModel->getLastActiveSchoolYearPhase();
            $schoolYearId = $dataSchoolYear['getActiveSchoolYearPhase']->first();
    
            // Create a new instance of NutritionalAssessmentModel
            $na = new NutritionalAssessmentModel();
            $na->pna_code = $request->pna_code;
            $na->pupil_id = $request->pupil_id;
            $na->height = $request->height;
            $na->weight = $request->weight;
            $na->dietary_restriction = $request->dietary_restriction;
            $na->explanation = $request->explanation;
            $na->is_dewormed = $request->is_dewormed ?? 0;
            $na->is_permitted_deworming = $request->is_permitted_deworming ?? NULL;
            $na->month = Carbon::now()->month;
            
    
            // If a matching record exists in the master list, set additional fields
            if ($pupilData['getList']) {
                $na->class_adviser_id = Auth::user()->id;
                $na->schoolyear_id = $schoolYearId->id;
                $na->class_id = $pupilData['getList']->class_id;
            }
    
            $heightInMeters = $na->height;
    
            // Calculate BMI
            $bmi = $na->weight / ($heightInMeters * $heightInMeters);
            // Calculate BMI category
            $na->bmi = $this->getBmiCategory($bmi);
    
            // Calculate HFA category and Z-score
            $dataPupil['getRecord'] = app(PupilModel::class)->getPupilRecords();
            $dataPupilBDate = collect($dataPupil['getRecord'])->pluck('date_of_birth', 'id')->toArray();
            $dataPupilSex = collect($dataPupil['getRecord'])->pluck('gender', 'id')->toArray();
            $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$request->pupil_id]);
            $age = $birthdate->diff(\Carbon\Carbon::now());
    
            $sex = $dataPupilSex[$request->pupil_id];
            $na->hfa = $this->calculateHfaCategory($age, $sex, $request->height)['hfaCategory'];
    
            // Use updateOrInsert to either update an existing record or insert a new one
            NutritionalAssessmentModel::updateOrInsert(
                ['pupil_id' => $request->pupil_id, 'class_id' => $na->class_id, 'schoolyear_id' => $na->schoolyear_id],
                $na->toArray()
            );

            // Create an associative array of school details
            $masterListDetails = [
                'PNA Code' => $na->pna_code,
                'Pupil ID' => $na->pupil_id,
                'Class Adviser ID' => $na->classadviser_id ?? null,
                'Class ID' => $na->class_id ?? null,
                'School Year ID' => $na->schoolyear_id ?? null,
                'Height' => $na->height,
                'Weight' => $na->weight,
                'BMI' => $na->bmi,
                'HFA' => $na->hfa,
                'Allergies' => $na->allergies ?? null,
                'Dietary Restriction' => $na->dietary_restriction ?? null,
                'Explanation' => $na->explanation ?? null,
                'Is Dewormed' => $na->is_dewormed ?? null,
                'Is Permitted Deworming' => $na->is_permitted_deworming ?? null,
                'Month' => $na->month ?? null,
                // Add more fields as needed
            ];

            // Create a history record before saving the school
            UserHistoryModel::create([
                'action' => 'Create',
                'old_value' => null, // For create operation, old_value is null
                'new_value' => implode(', ', array_map(fn ($key, $value) => "$key: $value", array_keys($masterListDetails), $masterListDetails)),
                'table_name' => 'Pupil nutritional assessment',
                'user_id' => $userId,
            ]);

            // Redirect with success message
            return redirect('class_adviser/class_adviser/nutritional_assessment')->with('success', ' Pupil nutritional assessment successfully added/updated');
        } catch (\Exception $e) {
            // Log other exceptions for debugging purposes
            Log::error($e->getMessage());

            // Return a generic error response
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}