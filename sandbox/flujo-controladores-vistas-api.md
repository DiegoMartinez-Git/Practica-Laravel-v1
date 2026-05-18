# Flujo de trabajo para controladores, vistas, API, roles y autenticacion

Este documento sirve como guia de practica para continuar el proyecto despues de modelos, migraciones, factories y seeders.

## 1. Decidir el modelo de autenticacion

Objetivo: elegir quien inicia sesion en la aplicacion.

Opcion recomendada para practicar:

- Usar `App\Models\User` para login, sesiones y roles.
- Usar `App\Models\Usuario` como entidad de dominio: jugador, perfil, equipo y logros.

Necesitas:

- Tabla `users` para autenticacion.
- Campo de rol en `users`, por ejemplo `role`.
- Middleware para restringir rutas por rol.

Roles iniciales recomendados:

- `admin`: puede gestionar todo.
- `organizador`: puede gestionar torneos, partidas y equipos.
- `jugador`: puede ver datos y gestionar su perfil.

## 2. Preparar rutas web y rutas API

Objetivo: separar controladores que devuelven vistas de controladores que devuelven JSON.

Necesitas:

- `routes/web.php` para vistas Blade.
- `routes/api.php` para endpoints JSON.
- Registrar `routes/api.php` en `bootstrap/app.php` si el proyecto no lo tiene activo.

Estructura recomendada:

```text
app/Http/Controllers/
app/Http/Controllers/Api/V1/
```

Ejemplo de rutas web:

```text
GET    /torneos
GET    /torneos/{torneo}
GET    /admin/torneos/create
POST   /admin/torneos
GET    /admin/torneos/{torneo}/edit
PUT    /admin/torneos/{torneo}
DELETE /admin/torneos/{torneo}
```

Ejemplo de rutas API:

```text
GET    /api/v1/torneos
GET    /api/v1/torneos/{torneo}
POST   /api/v1/torneos
PUT    /api/v1/torneos/{torneo}
DELETE /api/v1/torneos/{torneo}
```

## 3. Crear controladores web

Objetivo: construir pantallas con Blade.

Controladores recomendados:

```text
TorneoController
EquipoController
VideojuegoController
PartidaController
UsuarioController
PerfilController
PatrocinadorController
LogroController
```

Metodos a practicar:

```text
index   -> listado
show    -> detalle
create  -> formulario de creacion
store   -> guardar nuevo registro
edit    -> formulario de edicion
update  -> actualizar registro
destroy -> borrar registro
```

Necesitas:

- Validacion con `FormRequest`.
- Redirecciones con mensajes de sesion.
- Vistas Blade por entidad.
- Paginacion en listados.
- Carga de relaciones con `with()`.

Ejemplo de carpetas de vistas:

```text
resources/views/layouts/app.blade.php
resources/views/torneos/index.blade.php
resources/views/torneos/show.blade.php
resources/views/torneos/create.blade.php
resources/views/torneos/edit.blade.php
```

## 4. Crear controladores API

Objetivo: exponer datos en JSON sin mezclarlo con las vistas.

Controladores recomendados:

```text
Api/V1/TorneoController
Api/V1/EquipoController
Api/V1/VideojuegoController
Api/V1/PartidaController
Api/V1/UsuarioController
Api/V1/PerfilController
Api/V1/PatrocinadorController
Api/V1/LogroController
```

Necesitas:

- `JsonResource` para transformar respuestas.
- `FormRequest` para validar entradas.
- Codigos HTTP correctos.
- Paginacion en listados.
- Versionado con `/api/v1`.

Recursos recomendados:

```text
TorneoResource
EquipoResource
VideojuegoResource
PartidaResource
UsuarioResource
PerfilResource
PatrocinadorResource
LogroResource
```

## 5. Crear validaciones con FormRequest

Objetivo: sacar la validacion de los controladores.

Requests recomendados:

```text
StoreTorneoRequest
UpdateTorneoRequest
StoreEquipoRequest
UpdateEquipoRequest
StoreVideojuegoRequest
UpdateVideojuegoRequest
StorePartidaRequest
UpdatePartidaRequest
```

Necesitas validar:

- Campos obligatorios.
- Tipos de dato.
- Existencia de claves foraneas con `exists`.
- Unicidad con `unique`.
- Fechas validas.
- Decimales y enteros dentro de rango.

## 6. Gestionar relaciones desde controladores

Objetivo: practicar Eloquent con relaciones reales.

Relaciones importantes:

- `Videojuego` tiene muchos `Torneo`.
- `Torneo` pertenece a `Videojuego`.
- `Torneo` pertenece a muchos `Equipo`.
- `Equipo` pertenece a muchos `Torneo`.
- `Equipo` pertenece a muchos `Patrocinador`.
- `Usuario` pertenece a `Equipo`.
- `Usuario` tiene un `Perfil`.
- `Usuario` pertenece a muchos `Logro`.

Casos a practicar:

- Crear torneo con videojuego.
- Asignar equipos a torneo con `attach`.
- Actualizar siembras con `sync`.
- Asignar patrocinadores a equipos.
- Asignar logros a usuarios.

Ejemplo conceptual:

```php
$torneo->equipos()->sync([
    $equipoId => ['posicion_siembra' => 1],
]);
```

## 7. Autenticacion web

Objetivo: proteger las vistas privadas.

Necesitas:

- Login.
- Logout.
- Registro opcional.
- Middleware `auth`.
- Redireccion si el usuario no esta autenticado.

Opciones:

- Usar Breeze para ir rapido.
- Hacer login manual para practicar mas.

Para practicar arquitectura, puedes empezar manual y luego comparar con Breeze.

## 8. Autenticacion API

Objetivo: proteger endpoints JSON.

Opcion recomendada:

- Laravel Sanctum.

Necesitas:

- Instalar y configurar Sanctum si no esta.
- Endpoint de login API.
- Generar token.
- Proteger rutas con `auth:sanctum`.
- Endpoint de logout API para revocar token.

Flujo esperado:

```text
POST /api/v1/login
GET  /api/v1/user
POST /api/v1/logout
```

## 9. Roles y permisos

Objetivo: limitar acciones segun el tipo de usuario.

Primera version recomendada:

- Campo `role` en `users`.
- Middleware propio `role`.

Reglas iniciales:

- `admin`: CRUD completo.
- `organizador`: CRUD de torneos, partidas y equipos.
- `jugador`: lectura y perfil propio.

Rutas protegidas:

```text
/admin/*
POST /api/v1/*
PUT /api/v1/*
DELETE /api/v1/*
```

## 10. Orden recomendado de desarrollo

1. Crear `TorneoController` web.
2. Crear vistas Blade de torneos.
3. Crear `VideojuegoController` web.
4. Crear `EquipoController` web.
5. Crear `FormRequest` para torneos, videojuegos y equipos.
6. Crear rutas web protegidas para admin.
7. Crear login web.
8. Crear middleware de roles.
9. Crear controladores `Api/V1`.
10. Crear `JsonResource`.
11. Instalar/configurar Sanctum.
12. Proteger API con tokens.
13. Crear tests de controladores.

## 11. Tests minimos

Objetivo: comprobar que las rutas principales funcionan.

Tests recomendados:

- Usuario invitado no entra en `/admin`.
- Usuario autenticado entra al dashboard.
- Admin puede crear torneo.
- Organizador puede crear partida.
- Jugador no puede borrar torneo.
- API devuelve JSON.
- API protegida rechaza peticiones sin token.
- Seeder puede ejecutarse sin errores.

## 12. Checklist por cada controlador

Antes de dar por terminado un controlador:

- Tiene rutas definidas.
- Tiene validacion con `FormRequest`.
- Usa relaciones Eloquent correctamente.
- Devuelve vista o JSON, no ambas cosas mezcladas.
- Usa paginacion en `index`.
- Protege acciones sensibles con middleware.
- Tiene mensajes de exito/error.
- Tiene tests basicos.

## 13. Lista concreta de lo siguiente

Esta es la primera tanda recomendada para empezar ya con controladores.

### Controladores web prioritarios

Crea primero estos tres:

```text
app/Http/Controllers/TorneoController.php
app/Http/Controllers/VideojuegoController.php
app/Http/Controllers/EquipoController.php
```

Motivo:

- `TorneoController` practica relaciones con `Videojuego`, `Equipo` y `Partida`.
- `VideojuegoController` practica un CRUD sencillo con relacion 1:N hacia torneos.
- `EquipoController` practica relaciones N:M con torneos y patrocinadores.

Despues crea estos:

```text
app/Http/Controllers/PartidaController.php
app/Http/Controllers/UsuarioController.php
app/Http/Controllers/PerfilController.php
app/Http/Controllers/PatrocinadorController.php
app/Http/Controllers/LogroController.php
```

### Controladores API prioritarios

Crea la misma idea, pero separada para JSON:

```text
app/Http/Controllers/Api/V1/TorneoController.php
app/Http/Controllers/Api/V1/VideojuegoController.php
app/Http/Controllers/Api/V1/EquipoController.php
```

Despues:

```text
app/Http/Controllers/Api/V1/PartidaController.php
app/Http/Controllers/Api/V1/UsuarioController.php
app/Http/Controllers/Api/V1/PerfilController.php
app/Http/Controllers/Api/V1/PatrocinadorController.php
app/Http/Controllers/Api/V1/LogroController.php
```

### Controladores de autenticacion

Para web:

```text
app/Http/Controllers/Auth/LoginController.php
app/Http/Controllers/Auth/RegisterController.php
```

Para API:

```text
app/Http/Controllers/Api/V1/AuthController.php
```

## 14. Rutas que deberias crear

### Rutas web publicas

Estas rutas devuelven vistas y no requieren login al principio:

```text
GET /                       -> HomeController o vista welcome
GET /torneos                -> TorneoController@index
GET /torneos/{torneo}       -> TorneoController@show
GET /videojuegos            -> VideojuegoController@index
GET /videojuegos/{videojuego} -> VideojuegoController@show
GET /equipos                -> EquipoController@index
GET /equipos/{equipo}       -> EquipoController@show
```

### Rutas web de autenticacion

```text
GET  /login     -> LoginController@showLoginForm
POST /login     -> LoginController@login
POST /logout    -> LoginController@logout
GET  /register  -> RegisterController@showRegistrationForm
POST /register  -> RegisterController@register
```

### Rutas web protegidas de administracion

Estas deberian ir con middleware `auth` y luego con middleware de rol:

```text
GET    /admin/torneos/create        -> TorneoController@create
POST   /admin/torneos               -> TorneoController@store
GET    /admin/torneos/{torneo}/edit -> TorneoController@edit
PUT    /admin/torneos/{torneo}      -> TorneoController@update
DELETE /admin/torneos/{torneo}      -> TorneoController@destroy

GET    /admin/videojuegos/create             -> VideojuegoController@create
POST   /admin/videojuegos                    -> VideojuegoController@store
GET    /admin/videojuegos/{videojuego}/edit  -> VideojuegoController@edit
PUT    /admin/videojuegos/{videojuego}       -> VideojuegoController@update
DELETE /admin/videojuegos/{videojuego}       -> VideojuegoController@destroy

GET    /admin/equipos/create       -> EquipoController@create
POST   /admin/equipos              -> EquipoController@store
GET    /admin/equipos/{equipo}/edit -> EquipoController@edit
PUT    /admin/equipos/{equipo}     -> EquipoController@update
DELETE /admin/equipos/{equipo}     -> EquipoController@destroy
```

### Rutas API publicas

```text
GET /api/v1/torneos                  -> Api/V1/TorneoController@index
GET /api/v1/torneos/{torneo}         -> Api/V1/TorneoController@show
GET /api/v1/videojuegos              -> Api/V1/VideojuegoController@index
GET /api/v1/videojuegos/{videojuego} -> Api/V1/VideojuegoController@show
GET /api/v1/equipos                  -> Api/V1/EquipoController@index
GET /api/v1/equipos/{equipo}         -> Api/V1/EquipoController@show
```

### Rutas API de autenticacion

```text
POST /api/v1/login   -> Api/V1/AuthController@login
GET  /api/v1/user    -> usuario autenticado con auth:sanctum
POST /api/v1/logout  -> Api/V1/AuthController@logout
```

### Rutas API protegidas

Estas deberian ir con `auth:sanctum` y roles:

```text
POST   /api/v1/torneos          -> Api/V1/TorneoController@store
PUT    /api/v1/torneos/{torneo} -> Api/V1/TorneoController@update
DELETE /api/v1/torneos/{torneo} -> Api/V1/TorneoController@destroy

POST   /api/v1/videojuegos                  -> Api/V1/VideojuegoController@store
PUT    /api/v1/videojuegos/{videojuego}     -> Api/V1/VideojuegoController@update
DELETE /api/v1/videojuegos/{videojuego}     -> Api/V1/VideojuegoController@destroy

POST   /api/v1/equipos          -> Api/V1/EquipoController@store
PUT    /api/v1/equipos/{equipo} -> Api/V1/EquipoController@update
DELETE /api/v1/equipos/{equipo} -> Api/V1/EquipoController@destroy
```

## 15. Orden exacto para practicar controladores

1. `VideojuegoController@index` y `show`.
2. Vistas `videojuegos/index.blade.php` y `videojuegos/show.blade.php`.
3. `TorneoController@index` y `show`, cargando `videojuego` y `equipos`.
4. Vistas `torneos/index.blade.php` y `torneos/show.blade.php`.
5. `EquipoController@index` y `show`, cargando `usuarios`, `sede`, `torneos` y `patrocinadores`.
6. Formularios `create` y `edit` de videojuegos.
7. `StoreVideojuegoRequest` y `UpdateVideojuegoRequest`.
8. CRUD completo de videojuegos.
9. Repetir el patron con torneos.
10. Repetir el patron con equipos.
11. Crear controladores API `Api/V1`.
12. Crear Resources para API.
13. Anadir login web.
14. Anadir roles.
15. Anadir Sanctum para API.
