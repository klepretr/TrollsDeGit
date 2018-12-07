@extends('cockpit.layouts.app')

@section('content')
    <header>

      <nav>
        <div class="nav-wrapper">
          <a href="#" class="brand-logo center">
            {{ config('app.cockpit.name', 'Cockpit') }}
          </a>
          <ul id="nav-mobile" class="right">
            <li><a href="sass.html">Wiki</a></li>
          </ul>
          <ul id="nav-mobile" class="left">
            <li><a href="collapsible.html"><i class="fas fa-medkit"></i>  SOS</a></li>
          </ul>
        </div>
      </nav>
      <nav id="breaking_news"><div class="breaking_news_1">Message d'alerte de la plus haute importance</div></nav>
    </header>

    <div class="card-body">
      <div class="col s12 m7">
          <h2 class="header">Agenda</h2>
          <div class="card horizontal">
              <div class="card-stacked">
                  <div class="card-content">
                      <p>INSERER LIEN AGENDA</p>
                  </div>
                  <div class="card-action">
                      <a href="#">Résumé de Mission</a>
                  </div>
              </div>
          </div>
      </div>
      <div class="col s12 m7">
        <h2 class="header">Météo</h2>
        <div class="card horizontal">
          <div class="card-image">
            <i class="fas fa-cloud-sun-rain" style="font-size: 70px"></i>
          </div>
          <div class="card-stacked">
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>
      </div>
      <a class="btn-floating btn-large waves-effect waves-light right red pulse" type="submit" name="action"><i class="tiny material-icons">chat</i></a>
    </div>

  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('ef2caf845d4a494ba99b', {
      cluster: 'eu',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
@endsection
