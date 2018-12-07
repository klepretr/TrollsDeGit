@extends('layouts.template_dashboard')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nouvelle Mission</div><br>
                <div class="card-body">
                    <form method="POST" action="createMissionAction">
                       @csrf
                       
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2"><label>Nom de la mission :</label><input type="text" id="mission_name" name="mission_name"></td>
                                
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Date :</label><input type="date" id="mission_date" name="mission_date"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Description :</label><textarea id="description" name="description"></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Agent(s) :</label>
                                        <div class="agent_list">
                                            @foreach ($agents as $agent)
                                                <input type="checkbox" name="agent[]" value="{{$agent->id}}"> {{$agent->name}}<br>
                                            @endforeach
                                        
                                        </div></td>
                                    
                                    <td><label>Matériel(s) :</label><div class="materials_list">
                                            @foreach ($materiels as $materiel)
                                            <input type="checkbox" name="materiel[]" value="{{$materiel->id}}"> {{$materiel->name}}<br>
                                            @endforeach
                                    </div></td>
                                </tr>
                                <tr>
                                    <td><label>ToDo List :</label>
                                        <div class="todo_list">
                                            <input type="text" name="addtask" id="addtask"> 
                                            <button id="addtaskbutton"> add Task</button>                                       
                                        
                                            <table class="table-task">
                                                <tbody>

                                                </tbody>
                                            </table>
                                        
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><button type="submit">Submit</button>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
