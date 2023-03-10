@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link {{ Request()->is('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Index</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request()->is('profile/2fa') ? 'active' : '' }}" href="{{ route('profile.2fa') }}">TwoFactorAuth</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
