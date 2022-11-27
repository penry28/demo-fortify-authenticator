@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Two Factor Authentication') }}</div>

                <div class="card-body">
                    @if (session('status') == "two-factor-authentication-disabled")
                        <div class="alert alert-success" role="alert">
                            <span>Two factor Authentication has been disabled.</span>
                        </div>
                    @endif

                    @if (session('status') == "two-factor-authentication-enabled")
                        <div class="alert alert-success" role="alert">
                            <span>Two factor Authentication has been enabled.</span>
                        </div>
                    @endif

                    @if(auth()->user()->two_factor_secret)
                    <form method="POST" action="{{ route('two-factor.enable') }}">
                        @csrf
                        @method('DElETE')
                        <div class="pb-5">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        <div>
                            <h3>Recovery Codes:</h3>
                            <ul>
                                @foreach (auth()->user()->recoveryCodes() as $code)
                                    <li>{{ $code }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button class="btn btn-danger">Disable</button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('two-factor.enable') }}">
                        @csrf
                        <button class="btn btn-primary">Enable</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
