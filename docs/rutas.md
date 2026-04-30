 ## Resumen de rutas
  | Verbo  | URI                  | Acción      | Método del controlador           | Nombre           |
  |--------|----------------------|-------------|----------------------------------|------------------|
  | GET    | /                    | Redirect    | (closure inline)                 | —                |
  | GET    | /ciclos              | Listar      | CicloFormativoController@index   | ciclos.index     |
  | GET    | /ciclos/create       | Form crear  | CicloFormativoController@create  | ciclos.create    |
  | POST   | /ciclos              | Guardar     | CicloFormativoController@store   | ciclos.store     |
  | GET    | /ciclos/{ciclo}      | Detalle     | CicloFormativoController@show    | ciclos.show      |
  | GET    | /ciclos/{ciclo}/edit | Form editar | CicloFormativoController@edit    | ciclos.edit      |
  | PUT    | /ciclos/{ciclo}      | Actualizar  | CicloFormativoController@update  | ciclos.update    |
  | DELETE | /ciclos/{ciclo}      | Borrar      | CicloFormativoController@destroy | ciclos.destroy   |

  Para verlas en consola directamente: `php artisan route:list --name=ciclos`

  ## Detalle de cada ruta

  ### `GET /` — redirect a `/ciclos`

  Closure inline en `routes/web.php`, no tiene método de controlador. Devuelve `redirect()->route('ciclos.index')`. Lo puse para que al abrir
  `http://localhost:8000` el usuario aterrice directo en el listado en vez de en la pantalla de bienvenida de Laravel.

  ### `GET /ciclos` — listado con búsqueda y filtros

  - **Método:** `index(Request $request)`
  - **Vista:** `resources/views/ciclos/index.blade.php`
  - **Qué hace:** monto la query builder y voy añadiendo los filtros que lleguen por URL. Al final ordeno por nombre, pagino de 10 en 10 y uso
  `withQueryString()` para que los filtros no se pierdan al cambiar de página.
  - **Parámetros opcionales (GET):**
    - `q` — texto libre, busca en `nombre` o `familia_profesional` con LIKE
    - `grado` — `Grado Superior` / `Grado Medio`
    - `modalidad` — `Presencial` / `Semipresencial`
    - `estado` — `activos` / `inactivos` (lo convierto a booleano antes de filtrar por la columna `activo`)

  ### `GET /ciclos/create` — formulario de alta

  - **Método:** `create()`
  - **Vista:** `resources/views/ciclos/create.blade.php`
  - **Qué hace:** devuelve el formulario vacío. El form lleva `novalidate` para que la validación la haga el servidor y los mensajes salgan en español.

  ### `POST /ciclos` — guardar ciclo

  - **Método:** `store(CicloFormativoRequest $request)`
  - **Validación:** inyecto el Form Request `CicloFormativoRequest`, así que si los datos no pasan las reglas el controlador ni se ejecuta y Laravel rebota
  al formulario con los errores.
  - **Reglas más importantes:** `nombre` requerido, único en la tabla y máximo 150 caracteres. La regla `unique` la pongo aquí sin `ignore` porque al crear
  no hay un ciclo previo con el que comparar.
  - **Tras guardar:** redirige a `ciclos.index` con un flash de éxito.

  ### `GET /ciclos/{ciclo}` — ver detalle

  - **Método:** `show(CicloFormativo $ciclo)`
  - **Vista:** `resources/views/ciclos/show.blade.php`
  - **Qué hace:** Route Model Binding inyecta el ciclo a partir del id (si no existe, Laravel devuelve 404 automáticamente). Le hago
  `load('programaciones')` para evitar el N+1 al pintar la lista de programaciones asociadas.

  ### `GET /ciclos/{ciclo}/edit` — formulario de edición

  - **Método:** `edit(CicloFormativo $ciclo)`
  - **Vista:** `resources/views/ciclos/edit.blade.php`
  - **Qué hace:** devuelve el mismo tipo de formulario que `create`, pero precargado con los valores actuales del ciclo gracias al Route Model Binding.

  ### `PUT /ciclos/{ciclo}` — actualizar ciclo

  - **Método:** `update(CicloFormativoRequest $request, CicloFormativo $ciclo)`
  - **Validación:** mismas reglas que `store`, pero la regla `unique` lleva `->ignore($this->ciclo)` para que el ciclo no choque con su propio nombre al
  editar (si no, no podrías guardar la edición sin cambiar el nombre).
  - **Tras actualizar:** redirige a `ciclos.show` con flash de éxito.

  ### `DELETE /ciclos/{ciclo}` — borrar ciclo

  - **Método:** `destroy(CicloFormativo $ciclo)`
  - **Qué hace:** antes de borrar compruebo si el ciclo tiene programaciones asociadas. Si las tiene, redirige a `ciclos.index` con un flash de error y NO
  lo borra. Si no las tiene, lo elimina y redirige al listado con flash de éxito.
  - **Defensa en profundidad:** la migración tiene `ON DELETE CASCADE` por si alguien borra el ciclo desde fuera de la app (phpMyAdmin, otro módulo, etc.).
  El controlador es la capa UX-friendly y la BD es el último seguro.

  ## Notas adicionales

  - No hay middleware de autenticación: el Módulo A (auth/roles) no estaba asignado, así que todas las rutas son públicas. En un escenario real iría todo
  bajo `auth`.
  - Todas las rutas que reciben `{ciclo}` usan **Route Model Binding**: la dependencia se tipa como `CicloFormativo` y Laravel resuelve la instancia o
  devuelve 404, sin tener que hacer `find()` manual.
  - El parámetro de la URL se llama `{ciclo}`, y eso es lo que aprovecho en el Form Request para hacer `Rule::unique()->ignore($this->ciclo)` — el nombre
  del parámetro tiene que coincidir.
