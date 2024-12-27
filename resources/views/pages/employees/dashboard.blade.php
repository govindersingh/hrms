@extends('layouts.app')

@push('page-styles')
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Welcome') }}
                {{ !empty(auth()->user()->username) ? auth()->user()->username . ' !' : auth()->user()->firstname . ' !' }}
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <x-todays-announcements />


        <livewire:employee-attendance />

    </div>
@endsection


@push('page-scripts')
@endpush
