@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb>
            <x-slot name="title">{{ __('Profile') }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ __('Profile') }}
                </li>
            </ul>
        </x-breadcrumb>
        <!-- /Page Header -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img
                                            src="{{ !empty($user->avatar) ? asset('storage/users/' . $user->avatar) : asset('images/user.jpg') }}"
                                            alt="User Image"></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{ $user->fullName }}</h3>
                                            <div class="small doj text-muted">
                                                {{ __('Date Joined') }} : {{ format_date($user->created_at, ' D M Y') }}
                                            </div>
                                            <div class="staff-msg">
                                                <a class="btn btn-custom" href="slack://open">{{ __('Send Message') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            @if (!empty($user->phone))
                                                <li>
                                                    <div class="title">{{ __('Phone') }}:</div>
                                                    <div class="text"><a href="#">{{ $user->phoneNumber }}</a>
                                                    </div>
                                                </li>
                                            @endif
                                            @if (!empty($user->email))
                                                <li>
                                                    <div class="title">{{ __('Email') }}:</div>
                                                    <div class="text"><a href="">{{ $user->email }}</a></div>
                                                </li>
                                            @endif

                                            @if (!empty($user->address))
                                                <li>
                                                    <div class="title">{{ __('Address') }}:</div>
                                                    <div class="text"><a href="">{{ $user->address }}</a></div>
                                                </li>
                                            @endif

                                            @if (!empty($user->gender))
                                                <li>
                                                    <div class="title">{{ __('Gender') }}:</div>
                                                    <div class="text"><a href="">{{ $user->gender }}</a></div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pro-edit">
                                <a data-ajax-modal="true" data-title="Profile Information" data-size="lg"
                                    class="edit-icon" href="javascript:void(0)" data-url="{{ route('profile.edit') }}"><i class="fa-solid fa-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="card-title">
                            {{ __('Documents') }}
                            <a  
                                href="javascript:void(0)" 
                                data-url="{{ route('documents', ['user' => $user->email]) }}"
                                class="edit-icon" data-title="{{ __('Add your document') }}"
                                data-ajax-modal="true" data-size="lg"
                                data-bs-toggle="tooltip" data-bs-title="Add your document"
                            >
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </h3>
                        <div class="list-group">
                            @foreach ($fileData as $file)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $file['name'] }}</span>
                                    <a  href="javascript:void(0)" 
                                        data-url="{{ route('documents.download', ['folder' => $file['folder'], 'file' => $file['name']]) }}" 
                                        class="btn btn-outline-primary btn-sm"
                                        data-ajax-url="true"
                                    >
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('page-scripts')
    <!-- Page Js -->

    <!-- /Page Js -->
@endpush
