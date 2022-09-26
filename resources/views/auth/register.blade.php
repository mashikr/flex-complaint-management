@include('partials._body_style')
<!-- loader Start -->
<div id="loading">
         
</div>
<!-- loader END -->
<section class="sign-in-page">
    <div class="container p-0">
        <div class="row no-gutters">
            <div class="col-sm-12 align-self-center">
                <div class="sign-in-from bg-white">
                    <h1 class="mb-0">Sign Up</h1>
                    <p>Enter your email address and password to access admin panel.</p>
                    <form method="POST" action="{{ route('register') }}" class="mt-4">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control mb-0  @error('name') is-invalid @enderror" id="name" placeholder="{{ __('Name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input type="email" name="email" class="form-control mb-0  @error('email') is-invalid @enderror" id="email" placeholder="{{ __('Email Address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ __('Company') }}</label>
                            <select name="company_id" id="company_id" class="form-control mb-0  @error('company_id') is-invalid @enderror">
                                <option value="">Select Your Company</option>
                                <option value="1">Flex 1</option>
                                <option value="2">Flex 2</option>
                                <option value="3">Flex 3</option>
                            </select>
                            @error('company_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="department">{{ __('Department') }}</label>
                            <input type="text" name="department" class="form-control mb-0  @error('department') is-invalid @enderror" id="department" placeholder="{{ __('Department') }}">
                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="designation">{{ __('Designation') }}</label>
                            <input type="text" name="designation" class="form-control mb-0  @error('designation') is-invalid @enderror" id="designation" placeholder="{{ __('Designation') }}">
                            @error('designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" name="password" class="form-control mb-0  @error('password') is-invalid @enderror" id="password" placeholder="{{ __('Password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact_number">{{ __('Contact Number') }}</label>
                            <input type="text" name="contact_number" class="form-control mb-0  @error('contact_number') is-invalid @enderror" id="contact_number" placeholder="{{ __('Contact Number') }}">
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">{{ __('Address') }}</label>
                            <textarea name="address" class="form-control mb-0  @error('address') is-invalid @enderror" id="address" cols="" rows="2" placeholder="{{ __('Enter Your Address') }}"></textarea>
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="d-block">{{ trans('messages.gender') }}</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="male" name="gender" value="male" class="custom-control-input" checked="">
                                    <label class="custom-control-label" for="male"> {{ trans('messages.male') }} </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="female" name="gender" value="female" class="custom-control-input">
                                    <label class="custom-control-label" for="female"> {{ trans('messages.female') }} </label>
                                </div>
                            </div>
                        <div class="d-inline-block w-100">
                            <button type="submit" class="btn btn-primary float-right">{{ __('Sign Up') }}</button>
                        </div>
                        <div class="sign-info">
                            <span class="dark-color d-inline-block line-height-2">{{ __('Already Have Account ?') }} <a href="{{ route('login') }}">{{ __('Log In') }} </a></span>
                            <!-- Social Login [START] -->
                            @include('auth.social-login')
                            <!-- Social Login [END] -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('partials._body_scripts')