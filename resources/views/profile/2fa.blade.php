@extends('profile.layout')

@section('main')
    <h4>Two Factor Auth :</h4>
    <hr>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="#" method="POST">
        @csrf

        <div class="mb-3">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                @foreach( config('twofactor.types') as $key => $name )
                    <option value="{{ $key }}" {{ old('type') == $key || auth()->user()->hasTwoFactor($key) == $key ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="please add your phone number" value="{{ old('phone') ?? Auth()->user()->phone_number }}">
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">
                update
            </button>
        </div>

    </form>
@endsection

