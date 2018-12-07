
@extends('layouts.template_dashboard')







@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Missions Passées</div><br>

                <div class="card-body">
                    <table  class="table_past" style="width: 100%;">
                    
                    <tbody>
                            @foreach($missions_past as $mission)
                            <div>
                                <tr>
                                    <td><a href="{{ route('dashboard.showMission', ['id'=>$mission->id]) }}">{{$mission->name}}</a></td>
                                    <td></td>
                                    <td>{{$mission->date}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">{{$mission->description}}</td>
                
                                    <td><a href="{{route('dashboard.report', ['id'=>$mission->id])}}"><button >Report</button></a></td>
                                </tr>
                            </div>
                        @endforeach
                    </tbody>
    
                    </table>
                </div>
<br>


                <div class="card-header">Missions Futures</div><br>

                <div class="card-body">
                    <table  class="table_future" style="width: 100%;">
                
                    <tbody>
                            @foreach($missions_future as $mission)
                            <div>
                                <tr>
                                    <td><a href="{{ route('dashboard.showMission', ['id'=>$mission->id]) }}">{{$mission->name}}</a></td>
                                    <td></td>
                                    <td>{{$mission->date}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">{{$mission->description}}</td>
                
                                    <td></td>
                                </tr>
                            </div>
                        @endforeach
                    </tbody>
    
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
