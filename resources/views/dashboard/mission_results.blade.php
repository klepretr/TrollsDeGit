@extends('layouts.template_dashboard')


@section('template')

<script id="element-template" type="text/x-handlebars-template">

    <div class="card-header">NOM DE LA MISSION</div><br>
        <div class="card-body">
            DATE DE LA MISSION<br>
            DESCRIPTION<br>
            <table class="table_result">
                <div>
                    LISTE DES FICHIERS A DL
                </div>
            </table>
        </div>
    </div>


</script>
    
@endsection





@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
            </div>
        </div>
    </div>
</div>
@endsection
