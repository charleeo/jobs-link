@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}} Profile Page</div>
                    <div id="accordion">
                        {{-- @include('applicants.create_personal_data')

                        @if(!empty($applicantInfo->user_id))
                            @include('applicants.view_personal_data')
                            @include('applicants.create_education')
                            @include('applicants.view_education')
                            @include('applicants.create_experience')
                            @include('applicants.view_experience')
                        @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
