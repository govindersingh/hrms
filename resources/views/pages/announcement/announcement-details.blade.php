<div>
    <h4 class="fw-bold">{{ $announcement->title }}</h4>
    <p><strong>{{ __('Start Date:') }}</strong> {{ $announcement->start_date->format('d M Y, h:i A') }}</p>
    <p><strong>{{ __('End Date:') }}</strong> {{ $announcement->end_date->format('d M Y, h:i A') }}</p>
    <p><strong>{{ __('Description:') }}</strong></p>
    <div class="border p-3 rounded" style="background-color: #f8f9fa;">
        {!! nl2br(e($announcement->description)) !!}
    </div>

    @if ($announcement->attachment)
        <p><strong>{{ __('Attachment:') }}</strong></p>
        <div class="border p-3 rounded">
            @php
                $fileExtension = pathinfo($announcement->attachment, PATHINFO_EXTENSION);
            @endphp

            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                <!-- Display Image -->
                <img src="{{ asset('storage/' . $announcement->attachment) }}" alt="Attachment" class="img-fluid rounded">
            @elseif ($fileExtension === 'pdf')
                <!-- Display PDF -->
                <embed src="{{ asset('storage/' . $announcement->attachment) }}" type="application/pdf" width="100%" height="500px">
            @elseif (in_array($fileExtension, ['mp4', 'avi', 'mov']))
                <!-- Display Video -->
                <video controls width="100%">
                    <source src="{{ asset('storage/' . $announcement->attachment) }}" type="video/{{ $fileExtension }}">
                    {{ __('Your browser does not support the video tag.') }}
                </video>
            @elseif (in_array($fileExtension, ['mp3', 'wav']))
                <!-- Display Audio -->
                <audio controls>
                    <source src="{{ asset('storage/' . $announcement->attachment) }}" type="audio/{{ $fileExtension }}">
                    {{ __('Your browser does not support the audio element.') }}
                </audio>
            @else
                <!-- Unsupported File Type -->
                <p>{{ __('Preview not available for this file type.') }}</p>
            @endif
        </div>
    @else
        <p>{{ __('No attachment available.') }}</p>
    @endif
</div>
