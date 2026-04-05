# 🏥 Consultorio Médico — Migración a Arquitectura Hexagonal

[![PHP](https://img.shields.io/badge/PHP-8.0-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-orange.svg)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple.svg)](https://getbootstrap.com/)
[![Docker](https://img.shields.io/badge/Docker-✓-blue.svg)](https://www.docker.com/)

Sistema completo de gestión para consultorio médico, nacido como mi primer proyecto escolar
de alta exigencia y evolucionado mediante una migración completa de código espagueti a
arquitectura hexagonal (Puertos y Adaptadores).

---

## 🧩 Historia del Proyecto

El sistema comenzó como código sin estructura: archivos PHP mezclando lógica de negocio,
consultas SQL e HTML en la raíz del proyecto, sin separación de responsabilidades ni
capas definidas. Las únicas "carpetas" eran una para clientes y otra para doctores,
con imágenes sueltas dispersas por el proyecto.

La migración no fue trivial. Durante el proceso se presentó un problema de BOM
(Byte Order Mark) en los archivos — caracteres invisibles al inicio de los PHP que
rompían silenciosamente la ejecución. La solución fue detectar los archivos afectados,
recrearlos desde cero y migrar el código limpio a la nueva estructura.

El resultado es un sistema con capas bien definidas, conexión por variables de entorno,
Docker para despliegue reproducible y una separación clara entre dominio, aplicación
e infraestructura.

---

## ✅ Características

- **Arquitectura Hexagonal** (Puertos y Adaptadores)
- **Autenticación y Roles**: Admin/Doctor y Paciente
- **CRUD Completo**: Pacientes, Citas, Servicios, Atenciones
- **Atención Médica**: Signos vitales, diagnóstico y tratamiento
- **Generación de Recetas**: Ticket de atención imprimible
- **Portal del Paciente**: Consulta de datos e historial de citas
- **Docker**: Despliegue reproducible con un solo comando

---

## 🏗️ Tecnologías

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.0+ (puro, sin frameworks) |
| Base de datos | MySQL 8.0 |
| Frontend | Bootstrap 5, CSS3, JavaScript |
| Librerías | SweetAlert2, DataTables, FontAwesome |
| Infraestructura | Docker |

---

## 📊 Antes vs Después

| Aspecto | Código Original | Después de Migración |
|---|---|---|
| **Organización** | Archivos sueltos en la raíz, HTML y SQL mezclados | Capas definidas: Domain, Application, Infrastructure |
| **Mantenibilidad** | Difícil, cualquier cambio afectaba todo | Cambios aislados por capa |
| **Testabilidad** | Imposible | Posible a nivel unitario e integración |
| **Acoplamiento** | Alto, todo dependía de todo | Bajo, capas independientes vía interfaces |
| **Escalabilidad** | Muy limitada | Alta |
| **Configuración** | Credenciales hardcodeadas en el código | Variables de entorno con `.env` |
| **Documentación** | Inexistente | Completa |

---

## 📁 Estructura del Proyecto
consultorio-hexagonal/
├── src/
│   ├── Domain/                  # Núcleo del negocio
│   │   ├── Entity/              # Entidades (Paciente, Cita, etc.)
│   │   └── Repository/          # Puertos (interfaces)
│   ├── Application/
│   │   └── UseCase/             # Casos de uso
│   └── Infrastructure/
│       ├── Persistence/         # Repositorios MySQL
│       └── Web/                 # Controladores HTTP
├── templates/                   # Vistas separadas de la lógica
│   ├── pacientes/
│   ├── citas/
│   └── auth/
├── public/                      # Assets públicos
├── config/                      # Configuración
├── docs/                        # Capturas de pantalla
├── .env.example                 # Variables de entorno requeridas
├── Dockerfile
└── docker-compose.yml

---

## 👥 Roles y Permisos

| Rol | Acceso |
|---|---|
| 👨‍⚕️ **Admin / Doctor** | Gestión total: pacientes, citas, atenciones, recetas |
| 👤 **Paciente** | Ver datos personales, historial y agendar citas |

---

## 🚀 Instalación

### Opción 1: Docker (Recomendado)
```bash
# 1. Clonar repositorio
git clone https://github.com/mhdavid405-cell/consultorio-hexagonal.git
cd consultorio-hexagonal

# 2. Copiar variables de entorno
cp .env.example .env
# Editar .env con tus credenciales

# 3. Levantar contenedores
docker-compose up -d

# 4. Abrir en navegador
http://localhost:8080
```

### Opción 2: Local con PHP
```bash
# 1. Clonar repositorio
git clone https://github.com/mhdavid405-cell/consultorio-hexagonal.git
cd consultorio-hexagonal

# 2. Configurar base de datos
mysql -u root -p < usuarios_prueba.sql

# 3. Copiar y configurar variables de entorno
cp .env.example .env

# 4. Levantar servidor PHP
php -S localhost:8080
```

---

## 👤 Usuarios de Prueba

| Usuario | Contraseña | Rol |
|---|---|---|
| `admin` | `admin123` | Admin / Doctor |
| `pruebaprueba ` | `123` | Paciente |

> ⚠️ Solo para entorno local de pruebas.

---

## 📸 Capturas de Pantalla

| Login | Dashboard Doctor | Lista de Pacientes |
|---|---|---|
| ![Login](docs/login.png) | ![Doctor](docs/doctor.png) | ![Pacientes](docs/pacientes.png) |

| Lista de Citas | Atender Cita | Ticket / Receta |
|---|---|---|
| ![Citas](docs/citas.png) | ![Atender](docs/atender.png) | ![Ticket](docs/ticket.png) |

---

## 📄 Licencia

MIT

---

## 👨‍💻 Autor

**Manzano Hernandez David Axel**
📧 mhdavid405@gmail.com

Proyecto escolar migrado de código espagueti a arquitectura hexagonal como ejercicio
real de refactorización y buenas prácticas de desarrollo.

⭐️ Si te fue útil, deja una estrella al repo.