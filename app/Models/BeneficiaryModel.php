<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryModel extends Model
{
    use HasFactory;

    protected $table = 'beneficiaries';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function listOfBeneficiaries(){
        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('beneficiaries.*')
                ->where('is_deleted', '!=', '1')
                ->where('schoolyear_id', '=', $activeSchoolYear->id);

        return $query->get();
    }

    static public function getBeneficiaryIfExist(){
        $searchTerm = request()->get('search');

        $activeSchoolYear = SchoolYearModel::select('school_year.*')
            ->where('status', '=', 'Active')
            ->where('is_deleted', '=', '0')
            ->first();

        $query = self::select('beneficiaries.*')
            ->where('schoolyear_id', '=', $activeSchoolYear->id)
            ->where('is_deleted', '!=', '1');

            if (!empty($searchTerm)) {
                $query->where(function ($query) use ($searchTerm) {
                    $pupilIds = PupilModel::where('lrn', 'like', '%' . $searchTerm . '%')
                        ->pluck('id')
                        ->toArray();
    
                    $query->whereIn('pupil_id', $pupilIds);
                });
            }

        return $query->get();
    }
}
