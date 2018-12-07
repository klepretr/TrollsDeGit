@extends('layouts.template_dashboard')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nouvelle Mission</div><br>
                <div class="card-body">
                    <form method="" action="">
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2"><label>Nom de la mission :</label><input type="text" id="mission_name" name="mission_name"></td>
                                
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Date :</label><input type="date" id="mission_date" name="mission_date"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Description :</label><textarea></textarea></td>
                                </tr>
                                <tr>
                                    <td><label>ToDo List :</label><div class="todo_list"></div></td>
                                    <td><label>Matériel(s) :</label><div class="materials_list"></div></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Agent(s) :</label><div class="agent_list"></div></td>
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
