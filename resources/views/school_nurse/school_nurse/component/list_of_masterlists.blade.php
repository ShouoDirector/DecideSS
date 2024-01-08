<div class="d-flex row">
                <!-- CLASSES TABLE -->
                <div class="col-md-6">
                    @if(count($dataClass['classRecords']) !== 0 && empty(Request::get('search')) && empty(Request::get('class')))
                    <div class="d-flex row justify-content-start">
                        <div class="table-responsive pb-3">
                            <table class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <!-- start row -->
                                    <tr>
                                        <th></th>
                                        <th>Section Name</th>
                                        <th>Grade Level</th>
                                        <th></th>
                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>
                                    @if(count($dataClass['classRecords']) === 0)
                                    <tr>
                                        <td colspan="12" class="text-center">No class selected</td>
                                    </tr>
                                    @else

                                    @php
                                    $customSortOrder = ['Kinder', '1', '2', '3', '4', '5', '6', 'SPED'];
                                    $orderedClassRecords = $dataClass['classRecords']->sortBy(function ($record) use
                                    ($customSortOrder) {
                                    return array_search($record->grade_level, $customSortOrder);
                                    });
                                    @endphp

                                    @foreach($orderedClassRecords as $value)
                                    <tr>
                                        <td>{{ $loop->index + 1 + ($dataClassRecord['getRecord']->perPage() * 
                                        ($dataClassRecord['getRecord']->currentPage() - 1)) }}</td>
                                        <td>{{ $value->section }}</td>
                                        <td>{{ $value->grade_level }}</td>
                                        <td>
                                            <form class="d-flex align-items-center"
                                                action="{{ route('school_nurse.school_nurse.view_a_masterlist') }}">
                                                <input type="number" name="class" value="{{ $value->id }}"
                                                    class="hidden">
                                                <button type="submit"
                                                    class="btn btn-primary text-white py-1 px-3">View MasterList Report
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    <!-- End row -->
                                </tbody>
                            </table>

                        </div>
                    </div>
                    @else
                    @endif
                </div>

</div>
        