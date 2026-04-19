# Práctica Laravel v1 con Laradock

Este repositorio contiene un proyecto de **Laravel 11** configurado desde cero junto a **Laradock** como entorno de contenedores Docker. A continuación se detalla paso a paso todo el proceso que se ha llevado a cabo para inicializar este entorno, de forma que quede documentado para futuras referencias.

## 🛠 Pasos de Configuración Inicial (Historial de Setup)

### 1. Clonar el repositorio
El primer paso consistió en traernos el repositorio vacío de GitHub a nuestra máquina local:
```bash
git clone git@github.com:DiegoMartinez-Git/Practica-Laravel-v1.git
cd Practica-Laravel-v1
```

### 2. Inicializar el Proyecto Laravel
Dado que la carpeta ya contenía los archivos de Git (`.git`), Composer no permitía usar `create-project` directamente. Por lo tanto, se creó en una carpeta temporal y luego se movieron los archivos a nuestro repositorio:
```bash
composer create-project laravel/laravel tmp_app
cp -a tmp_app/. ./
rm -rf tmp_app
```

### 3. Añadir Laradock como Submódulo
Laradock es el entorno Docker que nos proporciona Nginx, MySQL, PHP, Workspace, etc. Se añade como submódulo para mantenerlo enlazado al proyecto oficial sin mezclarlo con el código de nuestra app.
```bash
git submodule add https://github.com/laradock/laradock.git
```

### 4. Configurar el Entorno de Laradock
Teníamos que copiar el archivo `.env.example` al `.env` que utilizará Docker Compose:
```bash
cd laradock
cp .env.example .env
```
> **Importante (Evitar Colisiones):** Como en la máquina ya existía otro proyecto llamado "laradock" corriendo, Docker agrupaba los contenedores y usaba la configuración equivocada. Para aislar *este* proyecto, se editó el archivo `laradock/.env` y se cambió el nombre del proyecto:
> ```env
> COMPOSE_PROJECT_NAME=practica_laravel_v1
> ```

### 5. Configurar el Dominio Local en Nginx (Laradock)
Para que nuestra aplicación responda al dominio `http://pruebalaravel.com`, se modificó la configuración por defecto de Nginx de Laradock.
En el archivo `laradock/nginx/sites/default.conf` se cambió la directiva `server_name`:
```nginx
    server_name pruebalaravel.com localhost;
```

### 6. Configurar el `.env` de Laravel
Por defecto, Laravel 11 usa SQLite. Lo cambiamos para que se conectase al contenedor MySQL de Laradock. En tu archivo `.env` en la raíz del proyecto se configuró:
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=pruebalaravel
DB_USERNAME=pruebalaravel
DB_PASSWORD=pruebalaravel

REDIS_HOST=redis
```
*(Nota: "mysql" y "redis" son los nombres de los contenedores dentro de la red de Laradock).*

### 7. Inicializar la Base de Datos en MySQL
Como usaste credenciales personalizadas (`pruebalaravel` en lugar de las por defecto de Laradock), tuvimos que entrar al contenedor de MySQL recién creado y ejecutar la consulta SQL manualmente para crear tanto la base de datos como el usuario:
```bash
# Se ejecutó esto desde la carpeta laradock:
docker compose exec mysql mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS pruebalaravel; CREATE USER IF NOT EXISTS 'pruebalaravel'@'%' IDENTIFIED BY 'pruebalaravel'; GRANT ALL PRIVILEGES ON pruebalaravel.* TO 'pruebalaravel'@'%'; FLUSH PRIVILEGES;"
```

### 8. Ejecutar las Migraciones de Laravel
Para crear las tablas base en la nueva base de datos, siempre hay que ejecutar los comandos de `artisan` **desde dentro del contenedor "workspace"**, ya que este contenedor tiene el PHP y las dependencias preparadas:
```bash
# Estando en la carpeta laradock
docker compose exec workspace php artisan migrate
```

---

## 🚀 Cómo arrancar el proyecto para programar

Siempre que quieras trabajar en el proyecto, estos son los pasos para arrancar el servidor:

1. **Asegurar el archivo Hosts (Solo la primera vez)**
   Tu ordenador necesita saber que `pruebalaravel.com` apunta a ti mismo. Añade la siguiente línea al final de tu archivo `/etc/hosts` ejecutando `sudo nano /etc/hosts`:
   ```text
   127.0.0.1   pruebalaravel.com
   ```

2. **Encender los contenedores**
   Abre una terminal, sitúate en tu proyecto y entra en la carpeta `laradock`:
   ```bash
   cd Practica-Laravel-v1/laradock
   docker compose up -d nginx mysql
   ```

3. **Ejecutar comandos en Workspace**
   Cuando necesites ejecutar `php artisan`, instalar un paquete de `composer` o ejecutar `npm run dev`, debes entrar a la consola del workspace:
   ```bash
   docker compose exec workspace bash
   ```
   Una vez dentro (el prompt pondrá `laradock@workspace:/var/www$`), podrás ejecutar tus comandos libremente.

4. **Ver el resultado**
   Abre tu navegador y ve a: [http://pruebalaravel.com](http://pruebalaravel.com)
