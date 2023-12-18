<!-- =========================================TABLE FILTER - PUPILS ====================================== -->

@if(count($dataClassRecord['getRecord']) !== 0)
@include('school_nurse.school_nurse.component.cnsr_fragment_class')
<!-- ========================================= REPORT TABLE ====================================== -->
@include('school_nurse.school_nurse.tables.cnsr_fragment_table')
@else
@endif
