<div class="modal-body">
    <form action="{{ route('profile') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="profile-img-wrap edit-img">
                    <img class="inline-block"
                        src="{{ !empty($user->avatar) ? asset('storage/users/' . $user->avatar) : asset('assets/img/user.jpg') }}"
                        alt="User Image">
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <x-form.input class="upload" type="file" name="avatar" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('First Name') }}</x-form.label>
                            <x-form.input type="text" name="firstname" value="{{ $user->firstname }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Middle Name') }}</x-form.label>
                            <x-form.input type="text" name="middlename" value="{{ $user->middlename }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Last Name') }}</x-form.label>
                            <x-form.input type="text" name="lastname" value="{{ $user->lastname }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('UserName') }}</x-form.label>
                            <x-form.input type="text" name="username" value="{{ $user->username }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-block mb-3">
                            <x-form.label>{{ __('Email') }}</x-form.label>
                            <x-form.input type="email" name="email" value="{{ $user->email }}" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-block mb-3">
                    <x-form.label>{{ __('Address') }}</x-form.label>
                    <x-form.input type="text" name="address" value="{{ $user->address }}" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-block mb-3">
                    <label>{{ __('Phone Number') }}</label>
                    <x-form.phone type="text" name="phone" value="{{ $user->phone }}" />
                </div>
            </div>

        </div>
        <div class="submit-section">
            <x-form.button class="btn btn-primary submit-btn">{{ __('Submit') }}</x-form.button>
        </div>
    </form>
</div>
