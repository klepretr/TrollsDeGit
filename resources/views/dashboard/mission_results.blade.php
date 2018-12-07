@extends('layouts.template_dashboard')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">{{$mission->name}}</div><br>
                    <div class="card-body">
                        {{$mission->start_date}}<br>
                        {{$mission->description}}<br>
                        <table class="table_result">
                            <div>
                                @if(isset($mission->report()->content))
                                {{$mission->report()->content}}
                                @endif
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
