<div>
       <ol>
         @foreach ($data_sedes2 /* $data_sedes  */ as $sede)
         
         <li> Sedes
            <p>id: {{ $sede->id }}</p>
            <p>equipo_id: {{ $sede->equipo_id}}</p>
            <p>direccion: {{ $sede->direccion }}</p>
            <p>ciudad: {{ $sede->ciudad }}</p>
            <p>pais: {{ $sede->pais }}</p>
            <p>metros_cuadrados: {{ $sede->metros_cuadrados }}</p>
            <p>nombre_Equipo: {{ $sede?->equipo->nombre/* nombre_Equipo */ }}</p>
            <p>created_at: {{ $sede->created_at }}</p>
         </li>

         @endforeach
      </ol>
</div>
