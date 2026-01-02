@extends('frontend.dashboard.dashboard-app')

@section('dashboard_contents')
    <div id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
        <div class="card">
            <div class="card-header p-0">
                <h5>{{ __('Account Details') }}</h5>
            </div>
            <div class="card-body p-0">
                <p>{{ __('You can edit your account details here.') }}</p>
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mt-30">

                        {{-- <x-input-image imageUploadId="image-upload" imagePreviewId="image-preview"
                            imageLabelId="image-label" name="avatar" :image="auth('web')->user()->avatar" /> --}}

                        <div class="form-group col-md-12">
                            <label>{{ __('Name') }} <span class="required">*</span></label>
                            <input required="" class="form-control" name="name" type="text"
                                value="{{ auth('web')->user()->name }}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>


                        <div class="form-group col-md-12">
                            <label>{{ __('Email Address') }} <span class="required">*</span></label>
                            <input required="" class="form-control" name="email" type="email"
                                value="{{ auth('web')->user()->email }}" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit"
                                value="Submit">{{ __('Save Change') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header p-0">
                <h5>{{ __('Change Password') }}</h5>
            </div>
            <div class="card-body p-0">
                <p>{{ __('You can change your password here.') }}</p>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mt-30">
                        <div class="form-group col-md-12">
                            <label>{{ __('Current Password') }} <span class="required">*</span></label>
                            <input required="" class="form-control" name="current_password" type="password" />
                            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />

                        </div>
                        <div class="form-group col-md-12">
                            <label>{{ __('New Password') }} <span class="required">*</span></label>
                            <input required="" class="form-control" name="password" type="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        </div>
                        <div class="form-group col-md-12">
                            <label>{{ __('Confirm Password') }} <span class="required">*</span></label>
                            <input required="" class="form-control" name="password_confirmation" type="password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit"
                                value="Submit">{{ __('Save Change') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
