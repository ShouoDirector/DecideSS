@if(count($dataClassRecord['getRecord']) !== 0)
@include('class_adviser.class_adviser.component.view_nsr_class')
<!-- ========================================= REPORT TABLE ====================================== -->
@include('class_adviser.class_adviser.tables.view_nsr_table')
@else
@endif
