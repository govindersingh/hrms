@extends('layouts.app')



@section('page-content')
    <div class="content container-fluid">
        <div>{{ __('These users will not list in employee section, This is just for upper management.') }}</div>
        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ __('Users') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('User') }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    <a href="javascript:void(0)" data-url="{{ route('users.create') }}" class="btn add-btn" data-ajax-modal="true"
                        data-size="lg" data-title="Add User">
                        <i class="fa-solid fa-plus"></i> {{ __('Add User') }}
                    </a>
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <!-- Search Filter -->

        <!-- /Search Filter -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'table table-striped custom-table w-100']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection



@push('page-scripts')
@vite([
    "resources/js/datatables.js"
])
{!! $dataTable->scripts(attributes: ['type' => 'module']) !!}
@endpush