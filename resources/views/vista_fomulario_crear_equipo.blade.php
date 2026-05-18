<div>
    <h1>Crear equipo</h1>

    <form method="POST" action="{{ route('equipo.store') }}">
        @csrf

        <p>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre">
        </p>

        <p>
            <label for="url_logo">URL logo</label>
            <input type="text" id="url_logo" name="url_logo">
        </p>

        <p>
            <label for="region">Region</label>
            <input type="text" id="region" name="region">
        </p>

        <button type="submit">Crear equipo</button>
    </form>
</div>
