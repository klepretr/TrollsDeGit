@extends('layouts.template_dashboard')


@section('template')

<script id="element-template" type="text/x-handlebars-template">

</script>
    
@endsection





@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Formulaire d'inscription</div><br>
                <div class="card-body">
                    <form method="" action="">
                        <label>Nom :</label><input type="text" id="last_name" name="last_name"><br>
                        <label>Prénom :</label><input type="text" id="first_name" name="first_name"><br>
                        <label>Login :</label><input type="text" id="login" name="login"><br>
                        <label>Mot de Passe :</label><input type="password" id="password" name="password"><br>
                        <label>Age :</label><input type="text" id="age" name="age"><br>
                        <label>Gender :</label>
                            <input type="radio" id="male" name="gender" value="male"><label for="gender">Homme</label>
                            <input type="radio" id="female" name="gender" value="female"><label for="gender">Femme</label>
                        <label>Téléphone :</label><input type="text" id="phone" name="phone"><br>
                        <label>Email :</label><input type="text" id="email" name="email"><br>

                        <button type="submit">Send</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
