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
DB_DATABASE=laravel
DB_USERNAME=laraveluser
DB_PASSWORD=your_laravel_db_password
```

**Levantar contenedores de Docker:**

```bash
docker-compose up -d
```

**Enumerar contenedores en ejecución:**

```bash
docker ps
```

**Generar key para el proyecto:**

```bash
docker-compose exec app php artisan key:generate
```

**Guardar configuración en caché de la aplicación:**

```bash
docker-compose exec app php artisan config:cache
```

**Visitar url de proyecto.**

```
http://your_server_ip
```
