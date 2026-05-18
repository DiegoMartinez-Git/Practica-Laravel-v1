<div>

   <ol>
      <li> Equipo
         <p> {{ $data_detalle_equipo->id }} </p>
         <p>{{ $data_detalle_equipo->nombre }}</p>
         <p>{{ $data_detalle_equipo->url_logo }}</p>
         <p>{{ $data_detalle_equipo->region }}</p>
         <p>{{ $data_detalle_equipo->created_at }}</p>

      </li>
      <ol>
         @foreach ($patrocinadores as $patrocinador)

            <li> Patrocinadores
               <p>id: {{ $patrocinador->id }}</p>
               <p>nombre_marca: {{ $patrocinador->nombre_marca}}</p>
               <p>sitio_web: {{ $patrocinador->sitio_web }}</p>
               <p>created_at: {{ $patrocinador->created_at }}</p>
            </li>

         @endforeach
      </ol>
   </ol>
   <div>
      <a href="{{ route('equipo.edit', $data_detalle_equipo) }}">
    <button type="button">Editar</button>
</a>
      <form action="{{ route('equipo.destroy', $data_detalle_equipo) }}" method="POST">
         @csrf
         @method('DELETE')

         <button type="submit">
            Borrar
         </button>
      </form>
   </div>
</div>