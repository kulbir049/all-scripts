@extends('layouts.custom-app')

@section('styles')
@endsection

@section('class')
<div class="bg-primary">
@endsection

@section('content')
<div class="page-single">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-8 col-xs-10 card-sigin-main py-45 justify-content-center mx-auto">
                <div class="card-sigin mt-5 mt-md-0">
                    <!-- Livewire Signup Component -->
                    @livewire('auth.signup-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@livewireScripts
@endsection
