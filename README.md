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
