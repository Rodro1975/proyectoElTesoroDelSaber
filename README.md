# El Tesoro del Saber

### Descripción

**El Tesoro del Saber** es un proyecto de desarrollo web destinado a gestionar una plataforma educativa que permite a los usuarios acceder a recursos literarios. El sistema facilita la gestión de pedidos de libros, administración de usuarios, y ofrece un entorno seguro para realizar estas operaciones. El proyecto se desarrolló utilizando tecnologías como PHP, HTML, CSS y Bootstrap para el frontend, y se integra con una base de datos MySQL en el backend.

### Funcionalidades

- **Registro de Pedidos:** Los usuarios pueden registrar nuevos pedidos de libros ingresando el título, autor, precio y fecha del pedido.
- **Gestión de Usuarios:** El sistema permite la administración de usuarios, incluyendo la creación de nuevos usuarios, roles, y perfiles de cliente.
- **Catálogo Digital:** Visualización de los libros disponibles en la plataforma.
- **Seguridad y Autenticación:** Sistema de autenticación seguro utilizando sesiones, con validación de credenciales para proteger el acceso.
- **Asistencia en Línea:** Funcionalidad para que los usuarios soliciten ayuda en línea dentro de la plataforma.

### Tecnologías Utilizadas

- **Lenguajes:** PHP, HTML, CSS, JavaScript
- **Frameworks y Librerías:** Bootstrap, jQuery
- **Base de Datos:** MySQL
- **Servidor Local:** XAMPP
- **Control de Versiones:** Git y GitHub

### Estructura del Proyecto

```
proyectoElTesoroDelSaber/
│
├── css/
│   └── estilos.css
│
├── html/
│   └── inicio.html
│
├── images/
│   └── logo.png
│
├── js/
│   └── script.js
│
├── php/
│   ├── registrarPedidos.php
│   ├── gestionarUsuarios.php
│   └── ...otros archivos PHP
│
├── index.php
├── README.md
└── ...
```

### Instalación y Configuración

1. **Clona el repositorio:**

   ```bash
   git clone https://github.com/Rodro1975/proyectoElTesoroDelSaber.git
   ```

2. **Configura el entorno local:**
   - Instala [XAMPP](https://www.apachefriends.org/) para levantar un servidor local con Apache y MySQL.
   - Coloca el proyecto en la carpeta `htdocs` de XAMPP: `C:/xampp/htdocs/proyectoElTesoroDelSaber`.
   - Asegúrate de que los servicios de Apache y MySQL estén corriendo.

3. **Configura la base de datos:**
   - Importa el archivo SQL que se encuentra en el repositorio dentro de la base de datos de MySQL.
   - Modifica las credenciales de la base de datos en los archivos PHP donde sea necesario.

4. **Ejecuta el proyecto:**
   - En tu navegador, accede a `http://localhost/proyectoElTesoroDelSaber/`.

### Contribuciones

Si deseas contribuir a este proyecto:

1. **Haz un fork** del repositorio.
2. **Crea una nueva rama** para tu funcionalidad o corrección de errores: `git checkout -b feature/nueva-funcionalidad`.
3. **Realiza tus cambios** y asegúrate de que todo funcione correctamente.
4. **Haz un pull request** para que tus cambios sean revisados.

### Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.

---

### Contacto

Si tienes alguna duda o sugerencia, no dudes en contactarme a través de GitHub o por correo electrónico.

---

Este `README.md` puede ser modificado a medida que el proyecto avance y nuevas funcionalidades se añadan. 
