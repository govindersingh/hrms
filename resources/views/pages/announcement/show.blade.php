@extends('layouts.app')

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">{{ __('Announcement Details') }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('announcement.index') }}">{{ __('Announcements') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $announcement->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Announcement Details -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Title -->
                        <h4 class="card-title">{{ $announcement->title }}</h4>

                        <!-- Dates -->
                        <p><strong>{{ __('Start Date:') }}</strong> {{ $announcement->start_date->format('d M Y, h:i A') }}</p>
                        <p><strong>{{ __('End Date:') }}</strong> {{ $announcement->end_date->format('d M Y, h:i A') }}</p>

                        <!-- Description -->
                        <p><strong>{{ __('Description:') }}</strong></p>
                        <div class="border p-3 rounded" style="background-color: #f8f9fa;">
                            {!! nl2br(e($announcement->description) ?? __('No description available.')) !!}
                        </div>

                        <!-- Status -->
                        <p><strong>{{ __('Status:') }}</strong>
                            <span class="badge {{ $announcement->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($announcement->status) }}
                            </span>
                        </p>

                        <!-- Attachment -->
                        <p><strong>{{ __('Attachment:') }}</strong></p>
                        @if ($announcement->attachment)
                            <div class="border p-3 rounded mb-3">
                                @php
                                    $fileExtension = pathinfo($announcement->attachment, PATHINFO_EXTENSION);
                                @endphp

                                @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                    <!-- Image Preview -->
                                    <img src="{{ asset('storage/' . $announcement->attachment) }}" alt="Attachment"
                                         class="img-fluid rounded">
                                @elseif ($fileExtension === 'pdf')
                                    <!-- PDF Preview -->
                                    <embed src="{{ asset('storage/' . $announcement->attachment) }}" width="100%" height="600px" type="application/pdf">
                                @elseif (in_array($fileExtension, ['mp4', 'avi', 'mov']))
                                    <!-- Video Preview -->
                                    <video width="100%" controls>
                                        <source src="{{ asset('storage/' . $announcement->attachment) }}" type="video/{{ $fileExtension }}">
                                        {{ __('Your browser does not support the video tag.') }}
                                    </video>
                                @elseif (in_array($fileExtension, ['mp3', 'wav']))
                                    <!-- Audio Preview -->
                                    <audio controls>
                                        <source src="{{ asset('storage/' . $announcement->attachment) }}" type="audio/{{ $fileExtension }}">
                                        {{ __('Your browser does not support the audio element.') }}
                                    </audio>
                                @else
                                    <!-- Download Link for Other Files -->
                                    <a href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank" class="btn btn-primary">
                                        {{ __('Download File') }}
                                    </a>
                                @endif
                            </div>
                        @else
                            <p>{{ __('No attachment provided.') }}</p>
                        @endif

                        <!-- Author -->
                        <p><strong>{{ __('Author:') }}</strong> 
                            {{ $announcement->author->name ?? __('Unknown Author') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Announcement Details -->

    </div>
@endsection
