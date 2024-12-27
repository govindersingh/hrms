@extends('layouts.app')

@section('page-content')
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-breadcrumb class="col">
            <x-slot name="title">{{ $pageTitle }}</x-slot>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ $pageTitle }}
                </li>
            </ul>
            <x-slot name="right">
                <div class="col-auto float-end ms-auto">
                    @can('create-announcement')
                    <a data-url="{{ route('announcement.create') }}" href="javascript:void(0)" class="btn add-btn"
                        data-ajax-modal="true" data-size="lg" data-title="{{ __('Add Announcement') }}">
                        <i class="fa-solid fa-plus"></i> {{ __('Add Announcement') }}
                    </a>
                    @endcan
                </div>
            </x-slot>
        </x-breadcrumb>
        <!-- /Page Header -->

        <!-- announcement Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table w-100">
                        <thead>
                            <tr>
                                <!-- <th>#</th> -->
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Start Date') }}</th>
                                <th>{{ __('End Date') }}</th>
                                <!-- <th>{{ __('Status') }}</th> -->
                                @canany(['update-announcement', 'delete-announcement'])
                                <th>{{ __('Actions') }}</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($announcements as $announcement)
                                <tr>
                                    <!-- <td>{{ $loop->iteration }}</td> -->
                                    <td>{{ $announcement->title }}</td>
                                    <td>{{ Str::limit($announcement->description, 50) }}</td>
                                    <td>{{ $announcement->start_date ? $announcement->start_date->format('d-m-Y H:i') : '-' }}</td>
                                    <td>{{ $announcement->end_date ? $announcement->end_date->format('d-m-Y H:i') : '-' }}</td>
                                    <!-- <td>
                                        <span class="badge {{ $announcement->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($announcement->status) }}
                                        </span>
                                    </td> -->
                                    @canany(['view-announcement', 'update-announcement', 'delete-announcement'])
                                    <td>
                                        @can('view-announcement')
                                            <a href="{{ route('announcement.show', $announcement->id) }}"
                                                class="btn btn-sm btn-info" data-ajax-modal="false" data-title="{{ __('View Announcement') }}">
                                                <i class="fa-solid fa-eye"></i> {{ __('View') }}
                                            </a>
                                        @endcan
                                        @can('update-announcement')
                                            <a data-url="{{ route('announcement.edit', $announcement->id) }}" href="javascript:void(0)"
                                                class="btn btn-sm btn-primary" data-ajax-modal="true" data-title="{{ __('Edit Announcement') }}">
                                                <i class="fa-solid fa-edit"></i> {{ __('Edit') }}
                                            </a>
                                        @endcan
                                        @can('delete-announcement')
                                            <form action="{{ route('announcement.destroy', $announcement->id) }}" method="POST"
                                                  style="display:inline;" onsubmit="return confirm('{{ __('Are you sure you want to delete this announcement?') }}');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                    @endcanany
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">{{ __('No announcement found.') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /announcement Table -->
    </div>
@endsection

@push('page-scripts')
<script>
    // Add any specific JavaScript for this page if needed
</script>
@endpush
