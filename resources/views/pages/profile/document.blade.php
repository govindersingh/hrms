<div class="modal-body">
    <form action="{{ route('documents.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="folder" value="{{$user->email}}" />
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="fileupload btn">
                    <x-form.input class="upload" type="file" name="file" required/>
                </div>
            </div>
        </div>
        <div class="submit-section mb-10">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
