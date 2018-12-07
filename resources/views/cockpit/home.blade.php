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
            <li><a href="collapsible.html">SOS</a></li>
          </ul>
        </div>
      </nav>
      @if(!empty($alert))<nav id="breaking_news"><div class="breaking_news_1">{{ $alert->content }}</div></nav>@endif
    </header>

    <div class="body">
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
        <div class="col s12 m7">
          <h2 class="header">Carte</h2>
          <div class="card horizontal mapbox">
            <div class="card-stacked">
              <a class="btn-floating btn-large waves-effect waves-light red" id="FullScreenButton"><i class="material-icons">fullscreen</i></a>
            	<a class="btn-floating btn-large waves-effect waves-light red" id="TrashButton"><i class="material-icons">delete</i></a>
              <div id="mapid">
              </div>
            </div>
          </div>
        </div>
        <div class="fixed-action-btn direction-top" style="bottom: 45px; right: 24px;">
          <a class="btn-floating btn-large">
            <i class="tiny material-icons">chat</i>
          </a>
          <ul>
            <li>
              <a class="btn-floating green" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                <i class="material-icons">settings</i>
              </a>
            </li>
            <li>
              @if (!Auth::check())
                <!-- Default no auth -->
                <a id="night_mode_btn" class="btn-floating blue" value="1" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                  <i class="material-icons">brightness_2</i>
                </a>
              @elseif (Auth::user()->night_mode == 0)
                <!-- Mode auto -->
                <a id="night_mode_btn" class="btn-floating blue" value="1" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                  <i class="material-icons">brightness_2</i>
                </a>
              @elseif (Auth::user()->night_mode == 1)
                <!-- Mode on -->
                <a id="night_mode_btn" class="btn-floating blue" value="2" style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                  <i class="material-icons">brightness_low</i>
                </a>
              @else
                <!-- Mode off -->
                <a id="night_mode_btn" class="btn-floating blue" value="0"  style="opacity: 0; transform: scale(0.4) translateY(40px) translateX(0px);">
                  <i class="material-icons">brightness_auto</i>
                </a>
              @endif

            </li>
          </ul>
        </div>
      </div>
    </div>




  <script>

    var mymap = L.map('mapid').setView([47.08, 2.41], 13);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}',
      {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.satellite',
        accessToken: 'pk.eyJ1IjoibXVyZG9jaCIsImEiOiJjanBjemhtNDgwY2V4M3VvM3Y1MHptbXFwIn0.XcuZA3Y2KnY9IFJzONuh3w'
    }).addTo(mymap);

    var marker = L.marker([47.09, 2.4]).addTo(mymap);

    var GlobalLayer = L.layerGroup([marker]).addTo(mymap)

    document.getElementById("FullScreenButton").onclick = function(){toggleFullScreen()};

    document.getElementById("TrashButton").onclick = function(){RmvMarker()};

    function toggleFullScreen() {

      var elmt_to_fullscreen = document.getElementById("mapid");

        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
          (!document.mozFullScreen && !document.webkitIsFullScreen)) {

          if (elmt_to_fullscreen.requestFullScreen) {
              elmt_to_fullscreen.requestFullScreen();
          }
          else if (elmt_to_fullscreen.mozRequestFullScreen) {
              elmt_to_fullscreen.mozRequestFullScreen();
          }
          else if (elmt_to_fullscreen.webkitRequestFullScreen) {
              elmt_to_fullscreen.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
          }
        }
      else {

          if (document.cancelFullScreen) {
              document.cancelFullScreen();
          }
          else if (document.mozCancelFullScreen) {
              document.mozCancelFullScreen();
          }
          else if (document.webkitCancelFullScreen) {
              document.webkitCancelFullScreen();
          }
        }

    }

    function RmvMarker(e) {

      GlobalLayer.clearLayers();
    }

    function AddMarker(e) {

      // Get back the dblclick.latlng position
      // Add a new layer with the point with the position returned
      // Add the layer on the map
      var markerToAdd = L.marker(e.latlng).addTo(mymap);
      GlobalLayer.addLayer(markerToAdd);

    }


    mymap.on('click', AddMarker);

    $(document).ready(function(){
      M.AutoInit();
      $('#night_mode_btn').on('click', function(){
        $.get('/cockpit/changeTheme?theme='+$('#night_mode_btn').attr('value'),function(data){
          window.location.reload()
        });
      });
    });
  </script>
@endsection
