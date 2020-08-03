@extends('layouts.quickstart')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Registration') }}</div>
                <div class="card-body">
                    <form method="POST" id="adminRegistration">
                        @csrf
                        <div class="form-control">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <span class="invalid-feedback" role="alert" id="alert-name">
                                <strong></strong>
                            </span>               
                        </div>
                        <div class="form-control">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="text" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <span class="invalid-feedback" role="alert" id="alert-email">
                                <strong></strong>
                            </span>        
                        </div>
                        <div class="form-control">
                            <label for="auth_code" class="form-label">{{ __('Auth Code') }}</label>
                            <input id="auth_code" type="text" class="@error('auth_code') is-invalid @enderror" name="auth_code" required>
                            <span class="invalid-feedback" role="alert" id="alert-auth_code">
                                <strong></strong>
                            </span>            
                        </div>  
                        <div class="form-control">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <span class="invalid-feedback" role="alert" id="alert-password">
                                <strong></strong>
                            </span>            
                        </div>  
                        <div class="form-control">
                            <label for="password" class="form-label">{{ __('Confirm Password') }}</label>                          
                            <input id="password-confirm" type="password" class="" name="password_confirmation" required autocomplete="new-password">                                                        
                        </div>       
                        <div class="form-control">
                            <div class="btn-full">                    
                                <button type="submit" id="submit-registration" class="btn blue">Create Account</button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
