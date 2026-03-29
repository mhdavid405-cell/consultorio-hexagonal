# 🏥 Consultorio Médico - Sistema de Gestión de Consultorio

[![PHP](https://img.shields.io/badge/PHP-8.0-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-orange.svg)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple.svg)](https://getbootstrap.com/)
[![Docker](https://img.shields.io/badge/Docker-✓-blue.svg)](https://www.docker.com/)

Sistema completo de gestión para consultorio médico con **arquitectura hexagonal**, migrado desde código espagueti a una estructura limpia y mantenible.

## 📋 Características

- ✅ **Arquitectura Hexagonal** (Puertos y Adaptadores)
- ✅ **Autenticación y Roles**: Admin, Doctor, Paciente
- ✅ **CRUD Completo**: Pacientes, Citas, Servicios, Atenciones
- ✅ **Atención Médica**: Signos, diagnóstico, tratamiento
- ✅ **Generación de Recetas**: Ticket de atención
- ✅ **Portal del Paciente**: Ver datos y citas
- ✅ **Docker**: Contenedor para fácil despliegue

## 🏗️ Tecnologías

| Capa | Tecnología |
|------|------------|
| Backend | PHP 8.0+ (puro, sin frameworks) |
| Base de datos | MySQL 8.0 |
| Frontend | Bootstrap 5, CSS3, JavaScript |
| Librerías | SweetAlert2, DataTables, FontAwesome |
| Infraestructura | Docker |

## 👥 Roles y Permisos

| Rol | Acceso |
|-----|--------|
| 👨‍⚕️ **Admin/Doctor** | Acceso total: gestionar pacientes, citas, atenciones |
| 👤 **Paciente** | Ver sus datos, ver sus citas, agendar nuevas citas |

## 🚀 Instalación

### Opción 1: Local con PHP

\\\ash
# Clonar repositorio
git clone https://github.com/mhdavid405-cell/consultorio-hexagonal.git
cd consultorio-hexagonal

# Configurar base de datos
mysql -u root -p < usuarios_prueba.sql

# Editar credenciales en conexion.php (si es necesario)

# Iniciar servidor PHP
php -S localhost:8080
\\\

### Opción 2: Docker

\\\ash
# Levantar contenedor
docker-compose up -d

# Acceder a la aplicación
http://localhost:8080
\\\

## 👤 Usuarios de Prueba

| Usuario | Contraseña | Rol |
|---------|------------|-----|
| prueba | 123456 | Admin |
| admin | admin123 | Admin |
| Juan Perez | 123456 | Paciente |

## 📱 Funcionalidades

### Módulo de Autenticación
- Login con recordar usuario
- Cambio de contraseña
- Recuperación de contraseña
- Registro de nuevos pacientes

### Módulo de Pacientes
- Listar pacientes con búsqueda
- Agregar nuevo paciente (crea usuario automáticamente)
- Editar datos personales y clínicos
- Eliminar paciente

### Módulo de Citas
- Agendar citas (paciente, servicio, médico, fecha, hora)
- Editar y eliminar citas
- Cambiar estado (Agendada, Atendida, Cancelada)

### Módulo de Atención Médica
- Registrar signos vitales
- Registrar diagnóstico
- Registrar tratamiento
- Generar receta/ticket de atención

### Portal del Paciente
- Ver datos personales
- Ver historial de citas
- Solicitar nuevas citas

## 📁 Estructura del Proyecto (Arquitectura Hexagonal)

\\\
consultorio-hexagonal/
├── public/                     # Assets públicos
│   ├── css/                    # Estilos CSS
│   ├── vendor/                 # Librerías
│   └── images/                 # Imágenes
│
├── templates/                  # Vistas (separadas de la lógica)
│   ├── index.php               # Login
│   ├── menu.php                # Menú principal
│   ├── pacientes/              # CRUD de pacientes
│   ├── citas/                  # CRUD de citas
│   └── auth/                   # Autenticación
│
├── src/                        # Código fuente
│   ├── Domain/                 # Núcleo del negocio
│   │   ├── Entity/             # Entidades
│   │   └── Repository/         # Puertos
│   ├── Application/            # Casos de uso
│   │   └── UseCase/            # Lógica de aplicación
│   └── Infrastructure/         # Adaptadores
│       ├── Persistence/        # Repositorios MySQL
│       └── Web/                # Controladores
│
├── config/                     # Configuración
├── docker/                     # Archivos Docker
├── conexion.php                # Configuración de BD
├── usuarios_prueba.sql         # Datos de prueba
├── Dockerfile
├── docker-compose.yml
└── README.md
\\\

## 📊 Antes vs Después

| Aspecto | Código Original | Después de Migración |
|---------|-----------------|---------------------|
| **Organización** | Archivos sueltos, código mezclado | Capas bien definidas (Domain, Application, Infrastructure) |
| **Mantenibilidad** | Difícil, cambios afectan todo | Fácil, cambios aislados por capa |
| **Testabilidad** | Imposible | Posible (unitario e integración) |
| **Acoplamiento** | Alto (todo depende de todo) | Bajo (capas independientes vía interfaces) |
| **Escalabilidad** | Limitada | Alta |
| **Documentación** | Inexistente | Completa |

## 📸 Capturas de Pantalla

| Login | Dashboard Doctor | Lista Pacientes |
|-------|------------------|-----------------|
| ![Login](docs/login.png) | ![Doctor](docs/doctor.png) | ![Pacientes](docs/pacientes.png) |

| Lista Citas | Atender Cita | Ticket/Receta |
|-------------|--------------|---------------|
| ![Citas](docs/citas.png) | ![Atender](docs/atender.png) | ![Ticket](docs/ticket.png) |

## 📄 Licencia

MIT

## 👨‍💻 Autor

**Manzano Hernandez David Axel**

Migración a arquitectura hexagonal - Proyecto original migrado de código espagueti a una arquitectura limpia y mantenible.

---

⭐️ ¡No olvides dejar una estrella si te gustó el proyecto!
