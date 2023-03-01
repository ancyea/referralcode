@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                       Your referral code is <b> {{ Auth::user()->newreferralcode }}</b> <a href="{{ route('mail') }}" class="close" data-dismiss="alert" aria-label="close">Share</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
