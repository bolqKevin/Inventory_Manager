# Inventory_Manager

Para levantar este proyecto PHP en su entorno local, pasos:

Tener instalado PHP
PHP 8.1 o superior además del driver necesario para usar SQL server.

Instalar Composer
El proyecto usa Composer. Descárguelo de getcomposer.org.

Instalar dependencias
Ejecute este comando en la carpeta raíz del proyecto:

- composer install

Configurar el usuario para pruebas
Para poder iniciar sesión, necesita agregar un usuario de prueba:

Para obtener la contraseña debería poder usar el siguiente comando:

- php generate_password.php aca_la_contraseña

luego haga un insert a la tabla usuarios con el hash de que devolvió ese comando

En la carpeta public del proyecto, ejecute:

- php -S 0.0.0.0:5000

Acceda a la aplicación
Abra su navegador y vaya a:

http://localhost:5000

Fin.
