@include('partials.alerts')
<div>
    <h1>Equipos</h1>
     <a href="{{ route('sede.index') }}">Sedes equipo</a>
     <br>
      <a href="{{ route('equipo.create') }}">Crear equipo</a>
      <br>
     {{--  <a href="{{ route('equipo.destroy') }}">Borrar equipo</a> --}}
    <ol>
        @foreach ($data_equipos as $equipo )
            <li>

                <p> id equipo: {{ $equipo->id }} </p> 
                <p>nombre equipo: {{ $equipo->nombre }}</p>
                <p>url_logo equipo: {{ $equipo->url_logo }}</p>
                <p>region equipo: {{ $equipo->region }}</p>
                <p>created_at equipo: {{ $equipo->created_at }}</p>
              <a href="{{ route('equipo.show', ['equipo'=>$equipo->id] ) }}">Detalle equipo</a>
            </li>
        @endforeach
    </ol>
</div>

