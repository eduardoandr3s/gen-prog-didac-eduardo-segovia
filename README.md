
  # Generador Automático de Programaciones Didácticas

  Trabajo Final de Grado — Curso 2025-2026
  IES Sant Vicent Ferrer (Algemesí)
  Autor: Eduardo Andrés Segovia Román

  ## Descripción del proyecto

  Aplicación web desarrollada en Laravel que permite gestionar los ciclos formativos del centro y las
  programaciones didácticas asociadas a cada ciclo. El proyecto global está dividido en 6 módulos (A-F) y este
  repositorio implementa el **Módulo B: CRUD de Ciclos Formativos**.

  ## Módulo implementado: B (CRUD Ciclos Formativos)

  El módulo permite:

  - Listar los ciclos formativos con paginación (10 por página)
  - Buscar por nombre o familia profesional y filtrar por grado, modalidad o estado
  - Crear nuevos ciclos con validación en servidor
  - Consultar el detalle de un ciclo y ver sus programaciones asociadas
  - Editar ciclos existentes manteniendo los valores previos
  - Eliminar ciclos (con protección contra borrado si tienen programaciones)

  ## Requisitos previos

  - PHP 8.2 o superior
  - Composer
  - Node.js LTS + NPM
  - MySQL 5.7 o superior (XAMPP recomendado)
  - Git

  ## Instalación

  ```bash
  # 1. Clonar el repositorio
  git clone https://github.com/eduardoandr3s/gen-prog-didac-eduardo-segovia.git
  cd gen-prog-didac-eduardo-segovia

  # 2. Instalar dependencias PHP
  composer install

  # 3. Instalar dependencias JS (para Vite)
  npm install

  # 4. Copiar el archivo de entorno y configurarlo
  cp .env.example .env

  # 5. Generar la clave de la aplicación
  php artisan key:generate

  # 6. Crear la base de datos `generador_pd` en MySQL
  #    (con utf8mb4_unicode_ci) y ajustar las credenciales en .env:
  #    DB_DATABASE=generador_pd
  #    DB_USERNAME=root
  #    DB_PASSWORD=

  # 7. Ejecutar migraciones y cargar datos de prueba
  php artisan migrate:fresh --seed

  # 8. Arrancar el servidor de desarrollo
  php artisan serve
  ```

  Acceder a `http://localhost:8000` — la ruta raíz redirige automáticamente al listado de ciclos.

  ## Estructura del módulo

  - **Modelo:** `app/Models/CicloFormativo.php` (con relación `hasMany` hacia programaciones)
  - **Controlador:** `app/Http/Controllers/CicloFormativoController.php` (resource con 7 métodos)
  - **Form Request:** `app/Http/Requests/CicloFormativoRequest.php` (validación y mensajes en español)
  - **Vistas:** `resources/views/ciclos/` (index, create, edit, show)
  - **Migración:** `database/migrations/2026_04_08_070203_create_ciclos_formativos_table.php`
  - **Seeder:** `database/seeders/CicloFormativoSeeder.php` (10 ciclos de 5 familias profesionales)

  ## Decisiones técnicas destacadas

  - **Route Model Binding** en todos los métodos que reciben un ciclo, evitando llamadas manuales a `find()`.
  - **Form Request** en vez de validación inline: separa la lógica de validación y permite mensajes personalizados en
  español.
  - **Validación de unicidad** del nombre del ciclo con `Rule::unique()->ignore($this->ciclo)` para que no falle al
  editar.
  - **Defensa en profundidad en el borrado:** el controlador impide borrar un ciclo si tiene programaciones, y la
  migración tiene `ON DELETE CASCADE` como segunda capa por si el borrado viene desde fuera de la app.
  - **Eager loading** (`$ciclo->load('programaciones')`) en la vista de detalle para evitar N+1 queries.
  - **Filtros persistentes al paginar** usando `withQueryString()`.
  - **Atributo `novalidate`** en los formularios para que los errores vengan siempre del servidor en español, no del
  navegador en inglés.

  ## Datos de prueba incluidos

  Tras ejecutar `php artisan migrate:fresh --seed` se cargan:

  - 10 ciclos formativos de 5 familias profesionales (Informática, Administración, Comercio, Sanidad, Electricidad)
  - 1 ciclo marcado como inactivo (para probar el badge "Inactivo")
  - 2 programaciones didácticas asociadas al ciclo de Desarrollo de Aplicaciones Web

  ## Documentación adicional

  - Diagrama Entidad-Relación: `docs/diagrama-er.png`
  - Descripción detallada de rutas: `docs/rutas.md`
  - Manual de usuario: `docs/manual-usuario.md`
