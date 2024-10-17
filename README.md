Documentación Técnica de Zirius
Descripción del Proyecto
Zirius es una aplicación diseñada para facilitar la gestión y el acceso a guiones y recursos para asesores. La plataforma permite a los usuarios iniciar sesión, editar guiones y colaborar de manera eficiente en un entorno moderno y amigable.

Requisitos Previos
Antes de comenzar, asegúrate de tener instalados los siguientes programas:

PHP: versión 7.4 o superior
MySQL: versión 5.7 o superior
Servidor Web: Apache o Nginx
Composer: para gestionar las dependencias de PHP (si es necesario)
Instalación
Clona el repositorio:

bash
Copiar código
git clone https://github.com/orzaca/Zirius.git
cd Zirius
Configura el entorno:

Crea una base de datos en MySQL llamada Ziriuson_Zirius.
Importa el archivo SQL de estructura de base de datos (si está disponible) en tu base de datos.
Configura las credenciales de la base de datos:

Abre el archivo DB.php y actualiza las credenciales de la base de datos:
php
Copiar código
<?php
$host = 'localhost';
$db   = 'Ziriuson_Zirius';
$user = 'tu_usuario';
$pass = 'tu_contraseña';
Instala dependencias (si es necesario):

bash
Copiar código
composer install
Inicia el servidor:

Usa el servidor local de PHP:
bash
Copiar código
php -S localhost:8000
Uso
Iniciar sesión:

Accede a la página de inicio de sesión en http://localhost:8000/pages/login.php.
Ingresa tu correo electrónico y contraseña.
Navegación:

Una vez dentro, navega a las diferentes secciones utilizando el menú de navegación.
Puedes editar los guiones haciendo clic en las opciones correspondientes.
Funciones:

Editar, eliminar y agregar guiones.
Visualizar estadísticas y notificaciones.
Estructura del Proyecto
La estructura básica del proyecto es la siguiente:

bash
Copiar código
Zirius/
├── assets/
│   ├── img/                  # Imágenes de la aplicación
├── css/                      # Archivos CSS
│   ├── styles.css            # Estilos generales
├── js/                       # Archivos JavaScript
│   ├── script.js             # Lógica de la aplicación
├── pages/                    # Páginas de la aplicación
│   ├── login.php             # Página de inicio de sesión
│   ├── dashboard_telefonico.php # Dashboard para usuarios telefónicos
│   ├── dashboard_redes.php   # Dashboard para usuarios de redes
│   ├── pagina1.php           # Página 1
│   ├── pagina2.php           # Página 2
├── DB.php                    # Archivo de conexión a la base de datos
├── README.md                 # Documentación de proyecto
Contribuciones
Si deseas contribuir a este proyecto, sigue estos pasos:

Fork el repositorio.
Crea una nueva rama:
bash
Copiar código
git checkout -b nombre-de-tu-rama
Realiza tus cambios y haz commit:
bash
Copiar código
git commit -m "Descripción de tus cambios"
Envía un pull request.
Licencia
Este proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.

Contacto
Para consultas y soporte, puedes contactarme:

Nombre: Orlando Zambrano
Cel: 3104214197
