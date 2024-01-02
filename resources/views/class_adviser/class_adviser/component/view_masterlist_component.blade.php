@if(count($data['getRecord']) !== 0)
@include('class_adviser.class_adviser.component.view_masterlist_class')
<!-- ========================================= REPORT TABLE ====================================== -->
@include('class_adviser.class_adviser.tables.view_masterlist_table')
@else
@endif