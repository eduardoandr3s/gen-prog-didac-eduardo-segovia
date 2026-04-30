 # Generador Automático de Programaciones Didácticas

  Trabajo Final de Grado — Curso 2025-2026
  IES Sant Vicent Ferrer (Algemesí)
  Autor: Eduardo Andrés Segovia Román
  Repo: https://github.com/eduardoandr3s/gen-prog-didac-eduardo-segovia

  ## De qué va el proyecto

  He desarrollado una aplicación web en Laravel para gestionar los ciclos formativos del centro y las programaciones didácticas que cuelgan de cada uno. El
  proyecto completo se reparte en 6 módulos (A-F) y a mí me ha tocado el **Módulo B: CRUD de Ciclos Formativos**, que es lo que está implementado en este
  repo.

  ## Módulo implementado: B (CRUD Ciclos Formativos)

  Lo que se puede hacer con el módulo:

  - Listar los ciclos formativos paginados de 10 en 10
  - Buscar por nombre o familia profesional y filtrar por grado, modalidad o estado
  - Crear ciclos nuevos con validación en el servidor
  - Ver el detalle de un ciclo y las programaciones que tiene asociadas
  - Editar ciclos manteniendo los valores anteriores en el formulario
  - Borrar ciclos (con protección si tienen programaciones asociadas)

  ## Lo que necesitas para correrlo

  - PHP 8.2 o superior
  - Composer
  - Node.js LTS + NPM
  - MySQL 5.7 o superior (yo uso XAMPP)
  - Git
  - Laravel 12 (se instala con Composer al hacer `composer install`)

  ## Instalación

  ```bash
  # 1. Clono el repo
  git clone https://github.com/eduardoandr3s/gen-prog-didac-eduardo-segovia.git
  cd gen-prog-didac-eduardo-segovia

  # 2. Instalo las dependencias de PHP
  composer install

  # 3. Instalo las dependencias de JS (para Vite)
  npm install

  # 4. Copio el archivo de entorno
  cp .env.example .env

  # 5. Genero la APP_KEY
  php artisan key:generate

  # 6. Creo la BD `generador_pd` en MySQL (con utf8mb4_unicode_ci)
  #    y ajusto las credenciales en .env:
  #    DB_DATABASE=generador_pd
  #    DB_USERNAME=root
  #    DB_PASSWORD=

  # 7. Lanzo migraciones + seeders
  php artisan migrate:fresh --seed

  # 8. Arranco el servidor
  php artisan serve
  ```

  Abres `http://localhost:8000` y la raíz redirige sola al listado de ciclos.

  ## Estructura del módulo

  - **Modelo:** `app/Models/CicloFormativo.php` — tiene el `hasMany` hacia programaciones
  - **Controlador:** `app/Http/Controllers/CicloFormativoController.php` — resource con los 7 métodos
  - **Form Request:** `app/Http/Requests/CicloFormativoRequest.php` — reglas y mensajes en español
  - **Vistas:** `resources/views/ciclos/` (index, create, edit, show)
  - **Migración:** `database/migrations/2026_04_08_070203_create_ciclos_formativos_table.php`
  - **Seeder:** `database/seeders/CicloFormativoSeeder.php` — 10 ciclos repartidos en 5 familias

  ## Decisiones técnicas que destacaría

  - **Route Model Binding** en todos los métodos que reciben un ciclo, así me ahorro andar haciendo `find()` a mano.
  - **Form Request** en lugar de validar dentro del controlador: separo la lógica de validación y puedo personalizar los mensajes en español de forma
  limpia.
  - **Validación de unicidad** del nombre con `Rule::unique()->ignore($this->ciclo)`. El `ignore` está para que no falle al editar un ciclo (no choca
  consigo mismo).
  - **Defensa en profundidad en el borrado:** el controlador no deja borrar un ciclo si tiene programaciones, y la migración tiene `ON DELETE CASCADE` como
  segunda capa por si el borrado viniera desde fuera de la app (phpMyAdmin u otro módulo).
  - **Eager loading** con `$ciclo->load('programaciones')` en la vista de detalle, así me evito el problema del N+1.
  - **Filtros que se mantienen al paginar** usando `withQueryString()` en el `paginate`.
  - **Atributo `novalidate`** en los formularios para que los errores los pinte el servidor en español y no el navegador en inglés.

  ## Datos de prueba

  Cuando lanzas `php artisan migrate:fresh --seed` se cargan:

  - 10 ciclos formativos repartidos en 5 familias profesionales (Informática, Administración, Comercio, Sanidad, Electricidad)
  - 1 ciclo marcado como inactivo (para probar el badge "Inactivo")
  - 2 programaciones didácticas asociadas al ciclo de Desarrollo de Aplicaciones Web

  ## Tests

  Hay un test básico en `tests/Feature/ExampleTest.php` que comprueba que la raíz `/` redirige al listado de ciclos. Para ejecutarlo:

  ```bash
  php artisan test
  ```

  ## Documentación adicional

  Dentro de la carpeta `docs/` están:

  - `diagrama-er.png` — diagrama Entidad-Relación de la BD
  - `rutas.md` — descripción detallada de las rutas y controladores
  - `manual-usuario.md` — manual de uso con capturas de cada pantalla
