<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Forget Password</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/admin/dist/css/tabler.css') }}" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN CUSTOM FONT -->
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
</head>

<body>
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="./dist/js/tabler-theme.min.js?1750026890"></script>
    <!-- END GLOBAL THEME SCRIPT -->
    <div class="page page-center">
        <div class="container-tight container py-4">
            <div class="mb-4 text-center">
                <a href="javascript:;" aria-label="Tabler" class="navbar-brand navbar-brand-autodark"><img
                        src="{{ asset(config('settings.site_logo')) }}" alt="">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <p>
                        {{ __('Enter your email address and your password will be reset and emailed to you.') }}
                    </p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form action="{{ route('admin.password.email') }}" method="POST" autocomplete="off" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" :value="old('email')" class="form-control"
                                placeholder="your@email.com" autocomplete="off" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        </div>

                        <div class="form-footer">
                            <button type="submit"
                                class="btn btn-primary w-100">{{ __('Email Password Reset Link') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
