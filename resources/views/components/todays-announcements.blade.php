@can('view-announcement')
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#demo">
        <h4 class="card-title mb-0 d-flex align-items-center">
            <i class="fa-solid fa-bullhorn me-2"></i> {{ __('Today\'s Announcements') }}
            <i class="la la-angle-up ms-auto"></i>
        </h4>
    </div>
    <div class="card-body collapse" id="demo">
        @if($announcements->isEmpty())
            <div class="alert alert-info text-center mb-0">
                <i class="fa-solid fa-circle-info me-1"></i> {{ __('No announcements for today.') }}
            </div>
        @else
            <ul class="list-group">
                @foreach ($announcements as $announcement)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold mb-1">
                                    <a href="javascript:void(0);" class="text-decoration-none text-primary"
                                       onclick="showAnnouncementDetails({{ $announcement->id }})">
                                        <i class="fa-solid fa-circle-dot text-primary me-2"></i>{{ $announcement->title }}
                                    </a>
                                </h5>
                                <small><i class="fa-regular fa-clock me-1"></i></small>
                                <small>{{ $announcement->end_date->format('d M Y, h:i A') }}</small>
                            </div>
                            <div class="text-muted text-end">
                                <button class="btn btn-sm btn-outline-primary mt-1" onclick="showAnnouncementDetails({{ $announcement->id }})">
                                    {{ __('View') }}
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
<style>
.card-header:not([aria-expanded="true"]) i.la.la-angle-up {
    transform: rotate(180deg);
}
.card-header[data-bs-toggle="collapse"] {
    cursor: pointer;
}
</style>
<!-- Modal -->
<div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="announcementModalLabel">{{ __('Announcement Details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="la la-times"></i></button>
            </div>
            <div class="modal-body">
                <div id="announcementContent">
                    <!-- Content will be dynamically loaded -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showAnnouncementDetails(id) {
        const modal = document.getElementById('announcementModal');
        const modalContent = document.getElementById('announcementContent');

        // Show a loading spinner
        modalContent.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"></div></div>';

        // Fetch announcement details
        fetch(`/announcement/${id}/details`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                if (!response.headers.get('content-type').includes('application/json')) {
                    throw new Error('Invalid JSON response');
                }
                return response.json();
            })
            .then(data => {
                if (data.html) {
                    modalContent.innerHTML = data.html;
                    const bootstrapModal = new bootstrap.Modal(modal);
                    bootstrapModal.show();
                } else if (data.error) {
                    modalContent.innerHTML = `<p class="text-danger text-center">${data.error}</p>`;
                }
            })
            .catch(error => {
                console.error('Error fetching announcement details:', error);
                modalContent.innerHTML = '<p class="text-danger text-center">Failed to load announcement details.</p>';
            });
    }

</script>
@endcan