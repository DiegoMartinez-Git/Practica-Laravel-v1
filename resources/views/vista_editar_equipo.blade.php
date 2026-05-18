<div>

    <h1>Editar equipo</h1>

    <form method="POST" action="{{ route('equipo.update',$data_detalle_equipo) }}">
        @csrf
   @method('PUT')
        <p>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ $data_detalle_equipo->nombre }}">
        </p>

        <p>
            <label for="url_logo">URL logo</label>
            <input type="text" id="url_logo" name="url_logo" value="{{ $data_detalle_equipo->url_logo }}">
        </p>

        <p>
            <label for="region">Region</label>
            <input type="text" id="region" name="region" value="{{ $data_detalle_equipo->region }}">
        </p>

        <button type="submit">Editar equipo</button>
    </form>
</div>
