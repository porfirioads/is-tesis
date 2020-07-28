# Tesis de Ingeniería de Software

Este proyecto contiene la implementación de la API REST del "Sistema Integral 
de Gestión del Ayuntamiento de Zacatecas" (SIGAZ), mismo que es usado como
evidencia y prueba del trabajo de investigación en el trabajo de tesis de
Ingeniería de Software de Porfirio Ángel Díaz Sánchez.

## Instrucciones

### Prerrequisitos

- Docker
- Docker Compose

### Configuración del proyecto

**Instalar dependencias de Laravel:**

```bash
docker run --rm -v $(pwd):/app composer install
```

**Configurar variables de entorno de la aplicación:**

```bash
# Crear archivo .env
cp .env.example .env

# Abrirlo para edición.
vim .env

# Las configuraciones de interés son las siguientes:
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=sigaz
DB_USERNAME=sigaz
DB_PASSWORD=sigaz_4YUNT4M13NT0
HOST_USER_ID=1001
```

**Asignación de permisos en host:**

```bash
# El usuario y grupo www son los que acceden por default a los archivos en una
# aplicación de Nginx, para que el proyecto trabaje correctamente, es necesario
# crearlos también en el equipo host.

# Leer id del usuario a crear.
HOST_USER_ID=$(grep HOST_USER_ID .env | xargs)
HOST_USER_ID=${HOST_USER_ID#*=}
echo "$HOST_USER_ID"

# Crear grupo www (usar un id no existente).
sudo groupadd -g $HOST_USER_ID www

# Crear usuario www.
sudo useradd -u $HOST_USER_ID -ms /bin/bash -g www www

# INSTRUCCIONES PARA MACOS
# Ver gids en uso.
dscl . list /Groups PrimaryGroupID | tr -s ' ' | sort -n -t ' ' -k2,2
# Crea el grupo
sudo dscl . create /Groups/www gid $HOST_USER_ID
# Crea el usuario
sudo dscl . create /Groups/www GroupMembership www

# Asigna propietarios del proyecto.
sudo chown -R www:porfirioadmin tesis-ing-software/

# Asignar permisos apropiados a carpetas.
sudo chmod -R 775 tesis-ing-software/
cd tesis-ing-software
sudo chmod -R 775 storage/

# Probablemente ocupe volver a ejecutar el chown.
```

**Levantar contenedores de Docker:**

```bash
docker-compose up -d
```

**Generar key para el proyecto:**

```bash
docker-compose exec app php artisan key:generate
```

**Guardar configuración en caché de la aplicación:**

```bash
docker-compose exec app php artisan config:cache
```

**Crear usuario de MySQL:**

```bash
# Inicia bash en contenedor db.
docker-compose exec db bash

# Inicia MySQL con la contraseña especificada en docker-compose.yml.
mysql -u root -p

# Crea el usuario y se le asignan permisos.
GRANT ALL ON sigaz.* TO 'sigaz'@'%' IDENTIFIED BY 'sigaz_4YUNT4M13NT0';
FLUSH PRIVILEGES;

# Sale de MySQL y del contenedor.
EXIT;
exit
```

**Visitar url de proyecto.**

```
http://your_server_ip
```

## Comandos de Docker

**Rebuild servicios:**

```bash
docker-compose build
```

**Enumera contenedores en ejecución:**

```bash
docker-compose ps
```

**Inicia los contenedores de un servicio:**

```bash
docker-compose start
```

**Reinicia los contenedores de un servicio:**

```bash
docker-compose restart
```

**Detiene los contenedores de un servicio:**

```bash
docker-compose stop
```

**Elimina contenedores y vuelve a crearlos:**

```bash
docker stop $(docker ps -q)
docker rm $(docker ps -aa)
docker rmi $(docker images -q)
systemctl stop docker
systemctl start docker
docker-compose up -d
```

**Aplicar cambios después de cambiar Dockerfile o docker-compose.yml:**

```bash
docker-compose down
docker-compose build
docker-compose up -d
```

## Comandos de Laravel

**Instalar dependencia de composer:**

```bash
docker run --rm -v $(pwd):/app composer require [--dev] nombre_del_paquete
```

**Crear seeder:**

```bash
docker-compose exec app php artisan make:seeder UserSeeder
```

**Crear migración:**

```bash
docker-compose exec app php artisan make:migration nombre_migracion
```

**Aplicar migraciones:**

```bash
# Solo migraciones.
docker-compose exec app php artisan migrate:fresh

# Migraciones y seeders.
docker-compose exec app php artisan migrate:fresh --seed
```

**Crear controlador:**

```bash
docker-compose exec app php artisan make:controller nombre_controlador
```

**Crear modelo:**

```bash
docker-compose exec app php artisan make:model Models/nombre_modelo
```

**Crear middleware:**

```bash
docker-compose exec app php artisan make:middleware nombre_middleware
```

**Generar helpers para ides:**

```bash
# Clean bootstrap/compiled.php
docker-compose exec app php artisan clear-compiled

# Cachear configuración
docker-compose exec app php artisan config:cache

# PHPDoc generation for Laravel Facades
docker-compose exec app php artisan ide-helper:generate

# PHPDocs for models
docker-compose exec app php artisan ide-helper:models

# PhpStorm Meta file
docker-compose exec app php artisan ide-helper:meta
```

**Visualización de logs:**

```bash
# Ver log de laravel
docker-compose exec app tail -f -n 100 /var/www/storage/logs/laravel.log
```

**Generar JWT token:**

```bash
docker-compose exec app php artisan jwt:secret
```

## Testing

**Crear unit test:**

```bash
docker-compose exec app php artisan make:test UserTest --unit
```

**Crear feature test:**

```bash
docker-compose exec app php artisan make:test UserTest
```

**Correr pruebas:**

```bash
# Unit test PHPUnit
docker-compose exec app php artisan optimize:clear && docker-compose exec app vendor/bin/phpunit --testdox --testsuite=Unit

# Feature test PHPUnit
docker-compose exec app php artisan optimize:clear && docker-compose exec app vendor/bin/phpunit --testdox --testsuite=Feature
```

**Code coverage:**

```bash
# Unit
docker-compose exec app php artisan optimize:clear && docker-compose exec app vendor/bin/phpunit --coverage-text --testsuite=Unit
docker-compose exec app php artisan optimize:clear && docker-compose exec app vendor/bin/phpunit --coverage-html tests/coverage-unit --testsuite=Unit

# Feature
docker-compose exec app php artisan optimize:clear && docker-compose exec app vendor/bin/phpunit --coverage-text --testsuite=Feature
docker-compose exec app php artisan optimize:clear && docker-compose exec app vendor/bin/phpunit --coverage-html tests/coverage-feature --testsuite=Feature
```

## Solución de errores

**Mensaje:** docker: Got permission denied while trying to connect to the 
Docker daemon socket at unix:///var/run/docker.sock: Post 
http://%2Fvar%2Frun%2Fdocker.sock/v1.40/containers/create: dial unix 
/var/run/docker.sock: connect: permission denied. See 'docker run --help'.

**Mensaje:** ERROR: Couldn't connect to Docker daemon at http+docker://localhost - is it running?
If it's at a non-standard location, specify the URL with the DOCKER_HOST environment variable.

**Solución:** 

```
sudo chmod 666 /var/run/docker.sock
sudo chown $USER /var/run/docker.sock
```

---

**Mensaje:** Error general de configuración o archivos no actualizados.

**Solución:**

```bash
docker run --rm -v $(pwd):/app composer dump-autoload
docker run --rm -v $(pwd):/app composer dump-autoload -o
docker-compose exec app php artisan optimize:clear
docker-compose exec app php artisan clear-compiled
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan config:cache
```

### IDE Helper generation

**Mensaje:**

```
ErrorException 
array_merge(): Argument #1 is not an array
at vendor/barryvdh/laravel-ide-helper/src/Console/ModelsCommand.php:96
```

**Solución:**

```bash
docker-compose exec app php artisan config:cache
```

### Clases no encontradas al momento de ejecutar tests.

**Mensaje:**

```
Illuminate\Contracts\Container\BindingResolutionException: Target class [ReporteSeeder] does not exist.
```

**Solución:**

```
docker run --rm -v $(pwd):/app composer dump-autoload
```

## TODO's

[ ] Crear automáticamente las bases de datos de producción y de pruebas.
[ ] Asignarle automáticamente un usuario a las bases de datos anteriormente creadas.

## Commands to create
- make test
- run test
- make test coverage report
- set permission
