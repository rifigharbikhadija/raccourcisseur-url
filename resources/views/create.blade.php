@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @if(session()->has('url'))
                    <div class="alert alert-success">
                        Sorten URL : <a id="hash-link" target="_blank" href="{{ session()->get('url') }}">{{ session()->get('url') }}</a>
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ url('/links') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="url" class="col-md-2 col-form-label text-md-right">{{ __('URL') }}</label>

                        <div class="col-md-8">
                            <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}" placeholder="Long URL goes here..." autocomplete="off" autofocus>

                            @error('url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Shorten URL') }}
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
