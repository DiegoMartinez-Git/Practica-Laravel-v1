<div>
    <h1>Equipos</h1>
     <a href="{{ route('vista_sedes') }}">Sedes equipo</a>
      <a href="{{ route('vista_fomulario_crear_equipo') }}">Crear equipo</a>
    <ol>
        @foreach ($data_equipos as $equipo )
            <li>

                <p> id equipo: {{ $equipo->id }} </p> 
                <p>nombre equipo: {{ $equipo->nombre }}</p>
                <p>url_logo equipo: {{ $equipo->url_logo }}</p>
                <p>region equipo: {{ $equipo->region }}</p>
                <p>created_at equipo: {{ $equipo->created_at }}</p>
              <a href="{{ route('vista_detalle_equipo', ['id'=>$equipo->id] ) }}">Detalle equipo</a>
            </li>
        @endforeach
    </ol>
</div>

