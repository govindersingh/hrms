@extends('layouts.app')

@push('page-styles')
    <!-- Chart CSS -->
@endpush

@section('page-content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Company Policies') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Company Policies') }}
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <iframe src="{{ route('policy.pdf') }}" width="100%" height="800px" style="border: none;"></iframe>
            </div>
        </div>

    </div>
@endsection

@push('page-scripts')
    <!-- Page Js -->

    <!-- /Page Js -->
@endpush