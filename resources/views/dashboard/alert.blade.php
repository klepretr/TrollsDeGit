@extends('layouts.template_dashboard')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">{{ __('Les alertes') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.storeAlert') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                            <div class="col-md-6">
                                <textarea name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" required autofocus>{{ old('content') }}</textarea>

                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Envoyer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div><hr />
                    @if(count($alerts))
                        @foreach($alerts as $alert)
                            <p>{{ $alert->content }}</p>
                            <i>{{ $alert->created_at->diffForHumans() }}</i>
                            <hr />
                        @endforeach
                    @else
                        Pas encore d'alertes
                    @endif
                </div>
    </div>
</div>
@endsection
