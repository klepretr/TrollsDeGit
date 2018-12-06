
@extends('layouts.template_dashboard')


@section('template')

<script id="element-template" type="text/x-handlebars-template">
    <tr class="element" id="" >
            <div>
                <tr>
                    <td>@{{name}}</td>
                    <td>@{{date}}</td>
                </tr>
                <tr><td colspan="2">@{{description}}</td></tr>
            </div>
    </tr>
  </script>
    
  <script id="element-template-future" type="text/x-handlebars-template">
    <tr class="element" id="" >
            <div>
                <tr>
                    <td>@{{name}}</td>
                    <td>@{{date}}</td>
                </tr>
                <tr><td colspan="2">@{{description}}</td></tr>
            </div>
    </tr>
  </script>
    
@endsection




@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Missions Passées</div><br>

                <div class="card-body">
                    <table  class="table_past" style="width: 100%;">
                    
                    <tbody>
                        <div>
                            <tr>
                                <td>Nom</td>
                                <td></td>
                                <td>Date</td>
                            </tr>
                            <tr><td colspan="2">Description</td>
                            <td><button>Report</button></td></tr>
                        </div>

                    </tbody>
    
                    </table>
                </div>
<br>


                <div class="card-header">Missions Futures</div><br>

                <div class="card-body">
                    <table  class="table_future" style="width: 100%;">
                
                    <tbody>
                        <div>
                            <tr>
                                <td>Nom</td>
                                <td>Date</td>
                            </tr>
                            <tr><td colspan="2">Description</td></tr>
                        </div>

                    </tbody>
    
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
