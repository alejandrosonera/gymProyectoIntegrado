# 🏋️ SoneGym — Plataforma Web de Gestión Integral de Gimnasio

**SoneGym** es una aplicación web *full-stack* desarrollada como Proyecto Integrado del Ciclo Formativo de Grado Superior en **Desarrollo de Aplicaciones Web (DAW)**. La plataforma digitaliza la operativa diaria de un centro deportivo mediante un sistema multi-rol para la reserva de clases dirigidas, gestión de aforos, comercio electrónico interno y pago de suscripciones.

---

## 📸 Capturas de pantalla

> *(Arrastra aquí desde el editor de GitHub 3 o 4 capturas de tu memoria: la portada de SoneGym, el horario de clases con Livewire, el carrito de compra y el formulario de pago con Stripe)*

---

## ✨ Funcionalidades por rol de usuario

### 👤 Cliente
- **Autenticación y registro:** Alta con selección de rol, inicio de sesión tradicional y acceso mediante cuenta de **Google**.
- **Reserva de clases en tiempo real:** Buscador dinámico instantáneo, consulta de horarios, plazas disponibles y botón de inscripción/cancelación con **validación automática de solapamientos** (impide reservar dos clases el mismo día a la misma hora).
- **Tienda online y carrito:** Catálogo de productos y membresías, gestión dinámica de cantidades en el carrito (`+1`, `-1`, vaciar) e historial detallado de pedidos realizados.
- **Pasarela de pagos:** Procesamiento de compras y contratación de planes mensuales (*Básico, Premium y Élite*) integrado con la API de **Stripe**.

### 👟 Entrenador
- **Gestión CRUD de clases:** Creación, edición y eliminación de sus propias sesiones mediante ventanas modales con validación de formularios y confirmación preventiva (**SweetAlert2**).
- **Control de asistencia:** Visualización en tiempo real del listado de clientes inscritos en cada clase.

### 🛠️ Administrador
- **Gestión CRUD de la tienda:** Alta, modificación, control de stock, subida de imágenes y eliminación de productos del catálogo.
- **Supervisión general:** Acceso al listado completo de clases, horarios y monitores del centro.

---

## 💻 Stack Tecnológico

- **Backend:** PHP 8.1+, Laravel (11/12), Laravel Jetstream, Eloquent ORM
- **Frontend e Interactividad:** Laravel Livewire, Blade, Tailwind CSS, JavaScript, SweetAlert2, FontAwesome, Vite
- **Base de datos:** SQLite (desarrollo) y MySQL 8.0 (producción)
- **Pagos e Integraciones:** Stripe API (elementos de tarjeta y cobros)
- **Despliegue e Infraestructura:** AWS EC2 (Ubuntu 22.04 LTS), Apache2, Composer, Node.js / npm

---

## 🗄️ Estructura de Base de Datos

El modelo relacional consta de **7 tablas principales** gestionadas mediante migraciones y *seeders* de Laravel:
- `users` (con diferenciación de roles: `cliente`, `entrenador`, `admin`)
- `clases` y tabla pivote `clase_user` (relación `N:M` para inscripciones y control de aforo)
- `productos`, `carritos`, `pedidos` y `detalle_pedidos` (gestión completa del flujo e-commerce)

---

## 🚀 Instalación y ejecución en local

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/alejandrosonera/gymProyectoIntegrado.git](https://github.com/alejandrosonera/gymProyectoIntegrado.git)
   cd gymProyectoIntegrado