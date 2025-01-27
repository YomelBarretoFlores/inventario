

## Requisito Previo

- [XAMPP](https://www.apachefriends.org/index.html) instalado en tu sistema.


## Instalación

### Paso 1: Configuración de XAMPP
1. Instala **XAMPP** desde el enlace oficial.
2. Coloca el proyecto dentro de la carpeta `C:\xampp\htdocs`.
3. Abre el panel de control de XAMPP y enciende los servicios **Apache** y **MySQL**.

### Paso 2: Configuración de la Base de Datos
1. Abre **phpMyAdmin** accediendo a `http://localhost/phpmyadmin` en tu navegador.
2. Crea una nueva base de datos llamada `inventiolite`.
3. Importa el archivo `schema.sql` que se encuentra en la carpeta principal del proyecto. Este archivo contiene las tablas necesarias para ejecutar el sistema.

### Paso 3: Acceso al Sistema
1. Accede al sistema ingresando en el navegador: `http://localhost/<nombre_de_tu_proyecto>`.
2. Credenciales por defecto para el administrador:
   - **Usuario**: `admin`
   - **Contraseña**: `admin`

## Estructura del Proyecto

- **`core/`**: Contiene el núcleo del sistema y las clases base.
- **`app/`**: Contiene controladores, vistas y modelos del proyecto.
- **`public/`**: Archivos accesibles públicamente como CSS, JS, e imágenes.
- **`schema.sql`**: Archivo con la estructura inicial de la base de datos.

## Características

- Gestión de productos y categorías.
- Administración de clientes y proveedores.
- Reportes en formatos PDF y Excel.
- Manejo de inventarios con operaciones de entrada y salida.


