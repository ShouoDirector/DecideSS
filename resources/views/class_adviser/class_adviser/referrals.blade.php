@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('class_adviser.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
            @if($permitted == 1)
                @include('class_adviser.class_adviser.component.user_widget')
                @include('class_adviser.class_adviser.component.referrals_add')
                    @else
                    @include('class_adviser.class_adviser.widgets.404')
                @endif
            @else
        @endif

    </div>

</div>

@endsection
