<form class="d-flex row" method="post" action="{{ route('class_adviser.class_adviser.na_page_update', ['id' => $data['getNARecord']->id]) }}" id="userForm">
    {{ csrf_field() }}

    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 hidden">
        <input type="number" name="pupil_id" value="{{ old('pupil_id',  $data['getNARecord']->pupil_id) }}"
            class="form-control border border-info" placeholder="Pupil Id" 
            required />
        <label></i><span class="ps-3">Pupil ID</span></label>
    </div>
    
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="number" name="height" value="{{ old('height',  $data['getNARecord']->height) }}"
            class="form-control border border-info" placeholder="Height" step="0.01" min="0" max="3" 
            required />
        <label></i><span class="ps-3">Height</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="number" name="weight" value="{{ old('weight',  $data['getNARecord']->weight) }}"
            class="form-control border border-info" placeholder="Weight" step="0.1" min="0" max="500" 
            required />
        <label></i><span class="ps-3">Weight</span></label>
    </div>
    <div class="mb-3 col-lg-3 col-md-6 col-12">
        <select class="form-control form-select border border-info p-3" name="is_dewormed" id="userTypeSelect">
            <option value="#" selected disabled>Is Dewormed?</option>
            <option value="0" {{ old('is_dewormed', $data['getNARecord']->is_dewormed) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('is_dewormed', $data['getNARecord']->is_dewormed) == 1 ? 'selected' : '' }}>Yes</option>
        </select>
        <small id="IsDewormedHelp" class="form-text text-muted">
                            Has been dewormed?</small>
        <div id="validationMessage" class="text-danger"></div>
    </div>

    
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="date" name="dewormed_date" value="{{ old('dewormed_date',  $data['getNARecord']->dewormed_date) }}"
            class="form-control border border-info" placeholder="Dewormed Date"/>
        <label></i><span class="ps-3">If yes, Dewormed Date</span></label>
    </div>

    <div class="mb-3 col-lg-3 col-md-6 col-12">
        <select class="form-control form-select border border-info p-3" name="is_permitted_deworming" id="userTypeSelect">
            <option value="#" selected disabled>Is Permitted Deworming?</option>
            <option value="" {{ is_null($data['getNARecord']->is_permitted_deworming) ? 'selected' : '' }}>Undecided</option>
            <option value="0" {{ old('is_permitted_deworming', $data['getNARecord']->is_permitted_deworming) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('is_permitted_deworming', $data['getNARecord']->is_permitted_deworming) == 1 ? 'selected' : '' }}>Yes</option>

        </select>
        <small id="IsDewormedHelp" class="form-text text-muted">
                            Has been permitted by parents?</small>
        <div id="validationMessage" class="text-danger"></div>
    </div>

    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="dietary_restriction" value="{{ old('dietary_restriction',  $data['getNARecord']->dietary_restriction) }}"
            class="form-control border border-info" placeholder="Dietary Restrictions" />
        <label></i><span class="ps-3">Dietary Restrictions</span></label>
        <small id="dietaryRestrictionHelp" class="form-text text-muted">
        Specify any dietary restrictions, e.g., Allergies, Vegetarian, Gluten-Free...</small>
    </div>

    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="explanation" value="{{ old('explanation',  $data['getNARecord']->explanation) }}"
            class="form-control border border-info" placeholder="Explanation" />
        <label></i><span class="ps-3">Explanation/Notes</span></label>
        <small id="explanationHelp" class="form-text text-muted">Provide an explanation or additional information if needed.</small>
    </div>
    
    <div class="d-flex row justify-content-end align-items-center">
        <div class="mt-3 col-lg-4 col-md-6 col-12">
            <button type="button" class="btn btn-info font-medium w-100" id="submitButton" data-bs-toggle="modal" data-bs-target="#update-na">
                {{ $head['headerTitle'] }}
            </button>
        </div>
    </div>

    @include('class_adviser.class_adviser.modals.update-na')


</form>
