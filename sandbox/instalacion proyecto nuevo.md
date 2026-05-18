# Instalacion Proyecto Nuevo (Laravel)

Este documento deja un proyecto Laravel limpio en la raiz de `Practica-Laravel_v1`, manteniendo el historial Git (`.git`) y la configuracion de remotos (`origin` y `upstream`).

## 1) Verificar herramientas base

```bash
php -v
composer --version
node -v
npm -v
git --version
```

Que hace cada comando:
- `php -v`: confirma que PHP esta instalado y su version.
- `composer --version`: confirma Composer (dependencias PHP).
- `node -v` y `npm -v`: confirman entorno frontend (Vite, assets).
- `git --version`: confirma que Git esta disponible.

## 2) Verificar remotos del repositorio

```bash
git remote -v
```

Que debe salir:
- `origin`: tu fork (donde subes cambios).
- `upstream`: repo original (de donde sincronizas).

Si necesitas corregirlos:

```bash
git remote set-url origin https://github.com/TU_USUARIO/TU_FORK.git
git remote add upstream https://github.com/USUARIO_O_ORG/REPO_ORIGINAL.git
# Si upstream ya existe:
git remote set-url upstream https://github.com/USUARIO_O_ORG/REPO_ORIGINAL.git
```

## 3) Crear Laravel limpio en esta carpeta raiz

Estrategia usada: crear en temporal y copiar aqui manteniendo `.git`.

```bash
# crear plantilla limpia
composer create-project laravel/laravel /tmp/laravel-clean

# vaciar raiz actual excepto .git
find . -mindepth 1 -maxdepth 1 ! -name '.git' -exec rm -rf {} +

# copiar plantilla limpia al repo actual
rsync -av --exclude='.git' /tmp/laravel-clean/ ./
```

Que hace:
- `create-project`: descarga e instala Laravel base.
- `find ... rm -rf`: limpia la carpeta actual sin borrar historial Git.
- `rsync`: copia la estructura Laravel nueva a la raiz de este repo.

## 4) Instalar dependencias del proyecto

```bash
composer install
npm install
```

Que hace:
- `composer install`: instala paquetes PHP definidos en `composer.lock`.
- `npm install`: instala paquetes frontend definidos en `package.json`.

## 5) Configurar entorno (`.env`) y clave de app

```bash
cp -n .env.example .env
php artisan key:generate
```

Que hace:
- `cp -n`: crea `.env` sin sobreescribir si ya existe.
- `key:generate`: crea `APP_KEY` para cifrado/sesiones.

## 6) Base de datos

### Opcion A (rapida/local): SQLite

```bash
# el archivo suele crearse solo; por si acaso:
touch database/database.sqlite

# en .env:
# DB_CONNECTION=sqlite
# DB_DATABASE=/ruta/absoluta/al/proyecto/database/database.sqlite

php artisan migrate
php artisan db:seed
```

### Opcion B (igual que entorno backend clasico): MySQL/MariaDB

Configurar en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=clave
```

Luego:

```bash
php artisan migrate
php artisan db:seed
```

Que hace:
- `migrate`: crea tablas desde migraciones.
- `db:seed`: carga datos iniciales (si hay seeders implementados).

## 7) Arranque del proyecto

Terminal 1:
```bash
php artisan serve
```

Terminal 2:
```bash
npm run dev
```

Que hace:
- `serve`: levanta backend Laravel local.
- `npm run dev`: compila assets en modo desarrollo (Vite).

## 8) Verificacion final

```bash
php artisan --version
php artisan route:list
php artisan migrate:status
```

Que valida:
- Laravel responde.
- Las rutas estan cargadas.
- Las migraciones estan aplicadas.

## 9) Guardar cambios en Git

```bash
git add .
git commit -m "Inicializa Laravel limpio en raiz del repo"
git push -u origin main
```

## 10) Sincronizar con upstream cuando haga falta

```bash
git fetch upstream
git checkout main
git merge upstream/main
git push origin main
```

---

## Nota importante sobre "igual que backend-eac"

Este proceso deja un Laravel limpio y funcionando. Para que tenga exactamente el mismo comportamiento de `backend-eac` necesitas incorporar su dominio (migraciones personalizadas, modelos, controladores, servicios, rutas y vistas) y volver a ejecutar pruebas/migraciones segun corresponda.
