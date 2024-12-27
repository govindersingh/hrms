<div class="modal-body">
    <form action="{{ route('announcement.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- Title -->
                    <div class="col-md-12">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Title') }}</x-form.label>
                            <x-form.input type="text" name="title" />
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Description') }}</x-form.label>
                            <textarea name="description" class="form-control" rows="5"></textarea>
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Start Date') }}</x-form.label>
                            <x-form.input type="datetime-local" name="start_date" />
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('End Date') }}</x-form.label>
                            <x-form.input type="datetime-local" name="end_date" />
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <x-form.input-block>
                            <x-form.label>{{ __('Status') }}</x-form.label>
                            <select name="status" class="form-control select">
                                <option value="active">{{ __('Active') }}</option>
                                <option value="draft">{{ __('Draft') }}</option>
                            </select>
                        </x-form.input-block>
                    </div>

                    <!-- Attachment -->
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Attachment') }}</x-form.label>
                            <x-form.input type="file" name="attachment" />
                        </div>
                    </div>
                    <x-form.input type="hidden" name="author_id" value="{{auth()->user()->id}}" />
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="submit-section mb-2">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
