
@extends('layouts.template_dashboard')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Mission {{ $mission->name }}</div><br>

                <div class="card-body">
                    <table  class="table_past" style="width: 100%;">
                    
                    <tbody>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Etat</th>
                        </tr>
                        <tr>
                            <td>{{ $mission->name }}</td>
                            <td>{{ $mission->description }}</td>
                            <td>{{ $mission->start_date}}</td>
                            <td>{{ $mission->end_date }}</td>
                            <td>{{ $mission->state }}</td>                     
                        </tr>
                    </tbody>
    
                    </table>
                    <hr />
                    <table  class="table_past" style="width: 100%;">

                    <h3>Agents sur la mission</h3>
                    @if($mission->has('user'))
                        <tbody>
                            <tr>
                                <th>Login</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Dernière connexion</th>
                            </tr>
                            @foreach($mission->user as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>@isset($user->updated_at) {{$user->updated_at->diffForHumans()}} @else Pas de données @endisset</td>                   
                            </tr>
                            @endforeach
                        </tbody>
                    @else
                        Pas d'agents liés
                    @endif
    
                    </table>
                    <hr />
                    <table  class="table_past" style="width: 100%;">
                    <h3>Tâches liées à la mission</h3>
                    @if($mission->has('tasks'))
                        <tbody>
                            <tr>
                                <th>Contenu</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                            </tr>
                            @foreach($mission->tasks as $task)
                            <tr>
                                <td>{{ $task->description}}</td>
                                <td>@isset($task->start_date) {{$task->start_date}} @else Pas de données @endisset</td>
                                <td>@isset($task->end_date) {{$task->end_date}} @else Pas de données @endisset</td>                   
                            </tr>
                            @endforeach
                        </tbody>
                    @else
                        Pas de tâches
                    @endif
    
                    </table>
                    <hr />
                    <table  class="table_past" style="width: 100%;">
                    <h3>Matériels liés à la mission</h3>
                    <tbody>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Etat</th>
                        </tr>
                        @if($mission->has('stuffs'))
                            @foreach($mission->stuffs as $stuff)
                            <tr>
                                <td>{{ $stuff->name }}</td>
                                <td>{{ $stuff->description }}</td>
                                <td>{{ $stuff->state }}</td>                
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
    
                    </table>

                </div>


   
            </div>
        </div>
    </div>
</div>
@endsection
