# Consultorio Médico — PRODUCT.md

> Este documento existe para explicar el **por qué** detrás de cada decisión técnica y de producto.
> Es tan importante como el código. Un sistema sin contexto es solo archivos.

---

## El problema que resuelve

Un consultorio médico pequeño (1-3 doctores) necesita registrar pacientes, agendar citas,
documentar cada atención y generar un comprobante para el paciente. Sin un sistema,
esto se hace en papel o en hojas de cálculo dispersas. Eso no escala, no es auditable
y genera errores clínicos por información incompleta.

**Problema central:** el médico no tiene un lugar único donde ver el historial completo
de un paciente, sus citas pasadas y el tratamiento que le fue dado en cada visita.

**Usuario primario:** el médico/admin que opera el consultorio día a día.
**Usuario secundario:** el paciente que quiere ver sus citas y datos sin llamar al consultorio.

---

## Historia: de código espagueti a arquitectura limpia

Este proyecto nació como una tarea escolar con el enfoque equivocado: "que funcione".
El resultado fue código que funcionaba pero que nadie —incluyendo yo— podía mantener
sin romper algo más.

### El código original tenía estos problemas reales:

- Consultas SQL directamente dentro de archivos HTML (mezcla de capas)
- Credenciales de base de datos hardcodeadas en múltiples archivos
- Sin separación entre "qué hace el sistema" y "cómo lo hace"
- Duplicación masiva de lógica entre archivos similares
- Imposible testear sin levantar toda la infraestructura

### La decisión: migrar a Arquitectura Hexagonal

La Arquitectura Hexagonal (Ports & Adapters) establece que el núcleo de negocio
no debe saber nada sobre la infraestructura que lo rodea. El dominio define
**qué** necesita; los adaptadores deciden **cómo** lo implementan.

**Beneficio concreto que obtuve:** si mañana quiero cambiar MySQL por PostgreSQL,
solo cambio el adaptador de persistencia. Las reglas de negocio no se tocan.

---

## Decisiones de producto

### ¿Por qué PHP puro y no Laravel o Symfony?

Laravel resuelve muchos problemas pero también oculta las decisiones. Para un proyecto
de portafolio, cada línea de código tiene que ser explicable en una entrevista.
PHP puro fuerza a ser explícito sobre cada decisión de diseño.

La arquitectura hexagonal con PHP puro demuestra que entiendo los patrones de diseño
independientemente del framework — eso es más valioso que saber la API de Laravel.

### ¿Por qué Docker desde el inicio?

Un proyecto que solo corre "en mi máquina" no es un proyecto real. Docker garantiza
que cualquier persona puede levantar el sistema con tres comandos sin instalar nada
más. Eso es un requisito mínimo de profesionalismo técnico, no un extra.

### ¿Por qué SweetAlert2 para las alertas?

Las alertas nativas del navegador (`alert()`, `confirm()`) son bloqueantes y no
son personalizables. SweetAlert2 da feedback visual claro al usuario sin interrumpir
el flujo. Para un sistema médico donde el usuario puede estar bajo presión,
la claridad del feedback es parte del producto, no decoración.

### Features descartadas del MVP

| Feature | Razón del descarte |
|---|---|
| Envío de recordatorios por WhatsApp/SMS | Requiere integración con APIs externas de pago. Alta complejidad sin validar primero el flujo base |
| Historial de cambios / auditoría | Valioso pero no crítico para el MVP. Candidato para V2 |
| Módulo de inventario de medicamentos | Fuera del alcance del consultorio pequeño objetivo |
| Dashboard con gráficas | El valor está en el registro, no en las métricas aún. V2 si hay demanda |
| App móvil | Web responsive es suficiente para validar la propuesta de valor |
| Firma digital en recetas | Requiere infraestructura legal y técnica considerable |

### ¿Por qué generar la receta como ticket imprimible en lugar de PDF?

El 90% de los consultorios pequeños tiene impresoras básicas. Un HTML imprimible
con `window.print()` funciona en cualquier navegador sin dependencias externas.
Un PDF requiere librerías adicionales y aumenta la complejidad de despliegue
sin agregar valor real para el usuario objetivo.

---

## Decisiones de arquitectura

### La migración en tres fases

**Fase 1 — Estructura:** separar vistas, lógica y datos en carpetas distintas
sin cambiar el comportamiento. `templates/` para vistas, `src/Application/UseCase/`
para lógica, `config/` para configuración.

**Fase 2 — Configuración:** eliminar todas las credenciales hardcodeadas.
Crear `.env.example`, documentar cada variable, asegurarse de que `.env`
esté en `.gitignore`. Este paso parece trivial pero es el más importante
desde el punto de vista de seguridad.

**Fase 3 — Limpieza:** eliminar archivos de debug (`test.php`, `test_menu.php`),
backups (`.bak`), y duplicados que se acumularon durante el desarrollo.
El historial de Git ya guarda esa historia — no necesita estar en el repo activo.

### El problema del BOM y cómo se resolvió

Durante la migración, varios archivos PHP tenían un BOM (Byte Order Mark) —
un carácter invisible al inicio del archivo que PHP interpreta como output
antes de los headers, rompiendo silenciosamente `header()`, `session_start()`
y `setcookie()`. Los síntomas: redirecciones que no funcionaban, sesiones
que no se guardaban.

La solución no fue buscar y reemplazar — fue recrear cada archivo afectado
desde cero en un editor configurado correctamente (UTF-8 sin BOM).
Lección: los problemas más costosos de debuggear son los que no generan
mensajes de error claros.

---

## Cómo medir el éxito del MVP

| Métrica | Objetivo | Cómo medirla |
|---|---|---|
| Tiempo de registro de paciente | < 3 minutos | Cronometrar con usuario real |
| Tiempo de agendado de cita | < 2 minutos | Cronometrar con usuario real |
| Errores por sesión de trabajo | < 1 | Observar a un médico usando el sistema |
| Recuperación de historial | < 30 segundos | Buscar paciente y ver citas pasadas |

---

## Roadmap

- **V1 (entregado):** registro de pacientes, citas, atención médica, receta imprimible, portal del paciente
- **V1.1:** buscador en lista de pacientes, filtros de citas por fecha y estado
- **V2:** dashboard con métricas (citas por mes, pacientes atendidos), historial de cambios
- **V3 (si hay demanda):** recordatorios por correo, integración con agenda externa

---

## Reflexión final

Este proyecto me enseñó que la arquitectura no es un fin en sí misma.
La Arquitectura Hexagonal no hace el sistema más rápido ni más bonito —
lo hace más fácil de cambiar. Y en software, lo único constante es que
los requisitos van a cambiar.

La diferencia entre un sistema que puedes mantener y uno que tienes que
reescribir está en haber separado correctamente desde el inicio:
**qué hace el sistema** de **cómo lo hace**.
