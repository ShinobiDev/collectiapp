# collectiapp

## 📖 Descripción del Proyecto

`collectiapp` es una aplicación backend (API RESTful) construida con **Laravel 10**, diseñada para la gestión de colecciones. Incorpora una arquitectura limpia con modelos, DTOs (Data Transfer Objects), servicios para la lógica de negocio, y controladores, asegurando un código robusto, mantenible y escalable. La API está protegida con **autenticación JWT** (JSON Web Tokens).

## ✨ Características Principales

* **Laravel 10:** Framework PHP moderno y robusto.
* **Arquitectura Modular:** Separación de responsabilidades con Modelos, DTOs, Servicios y Controladores.
* **API RESTful:** Endpoints bien definidos para la interacción con los recursos.
* **Autenticación JWT:** Seguridad de la API mediante tokens.
* **Validación de Datos:** Uso de Form Requests para una validación de entrada de datos rigurosa.
* **Manejo de Errores:** Respuestas JSON consistentes con mensajes claros y códigos de estado HTTP semánticos.
* **Seeders y Factories:** Datos de prueba para un desarrollo y testing ágil.

## 🚀 Empezando

Sigue estos pasos para tener el proyecto funcionando en tu máquina local.

### Prerrequisitos

Asegúrate de tener instalado lo siguiente:

* **PHP >= 8.1:** La versión de PHP requerida por Laravel 10.
* **Composer:** Gestor de dependencias de PHP.
* **Node.js & npm (opcional, para frontend):** Si planeas integrar un frontend.
* **Base de Datos:** MySQL, PostgreSQL, SQLite, etc. (MySQL es comúnmente usado).
* **Servidor Web:** Nginx o Apache (o el servidor de desarrollo de PHP).

### Instalación

1.  **Clonar el repositorio:**
    ```bash
    git clone [https://github.com/tu-usuario/collectiapp.git](https://github.com/tu-usuario/collectiapp.git)
    cd collectiapp
    ```

2.  **Instalar dependencias de Composer:**
    ```bash
    composer install
    ```

3.  **Configurar el archivo de entorno (`.env`):**
    Copia el archivo de ejemplo y genera la clave de la aplicación:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configurar la base de datos en `.env`:**
    Abre el archivo `.env` y ajusta las credenciales de tu base de datos:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=collectiapp_db # O el nombre de tu base de datos
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generar la clave secreta de JWT:**
    ```bash
    php artisan jwt:secret
    ```

6.  **Ejecutar las migraciones y seeders:**
    Esto creará las tablas en tu base de datos y las poblará con datos de prueba.
    ```bash
    php artisan migrate:fresh --seed
    ```

7.  **Iniciar el servidor de desarrollo de Laravel (opcional):**
    ```bash
    php artisan serve
    ```
    La API estará disponible en `http://127.0.0.1:8000`.

## ⚙️ Estructura del Proyecto

La estructura de carpetas clave para entender `collectiapp` es la siguiente:

collectiapp/
├── app/
│   ├── DTOs/               # Data Transfer Objects (para entrada/salida de datos)
│   │   └── Status/
│   │       └── StatusDTO.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── API/        # Controladores API (como StatusController, AuthController)
│   │   │       └── StatusController.php
│   │   │       └── AuthController.php
│   │   ├── Requests/       # Form Requests (validación de DTOs de entrada)
│   │   │   └── StoreStatusRequest.php
│   │   │   └── UpdateStatusRequest.php
│   │   └── Resources/      # API Resources (opcional, para DTOs de salida)
│   ├── Models/             # Modelos Eloquent (representan tablas de la DB)
│   │   └── Status.php
│   │   └── User.php
│   │   └── ... (otros modelos)
│   └── Services/           # Servicios (lógica de negocio y manipulación de datos)
│       └── StatusService.php
├── database/
│   ├── factories/          # Factories para generar datos de prueba
│   ├── migrations/         # Esquemas de la base de datos
│   └── seeders/            # Clases para poblar la base de datos
├── routes/
│   └── api.php             # Definición de rutas API
├── .env                    # Variables de entorno
├── composer.json           # Dependencias de Composer
└── README.md

## 🔐 Autenticación y Rutas Protegidas

La API utiliza JWT para la autenticación. Todas las rutas CRUD para `Status` están protegidas.

### Endpoints de Autenticación (`/api/auth`)

* **`POST /api/auth/register`**: Registra un nuevo usuario.
    * **Body:** `name`, `type_document_id`, `document`, `email`, `password`, `password_confirmation`, `birthday` (opcional).
* **`POST /api/auth/login`**: Inicia sesión y devuelve un token JWT.
    * **Body:** `email`, `password`.
* **`POST /api/auth/logout`**: Invalida el token JWT del usuario actual.
* **`POST /api/auth/refresh`**: Refresca un token JWT expirado para obtener uno nuevo.
* **`GET /api/auth/me`**: Obtiene los datos del usuario autenticado.

### Rutas Protegidas (`/api/statuses`)

Estas rutas requieren un token JWT válido en el encabezado `Authorization: Bearer <your_token>`.

* **`GET /api/statuses`**: Obtiene todos los estados.
* **`POST /api/statuses`**: Crea un nuevo estado.
    * **Body:** `name`.
* **`GET /api/statuses/{id}`**: Obtiene un estado por su ID.
* **`PUT /api/statuses/{id}`**: Actualiza un estado existente.
    * **Body:** `name`.
* **`DELETE /api/statuses/{id}`**: Elimina un estado.

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Si encuentras un error o tienes una sugerencia, por favor abre un *issue* o envía un *pull request*.

## 📄 Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).

