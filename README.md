# 💼 Sistema de Recursos Humanos RH-GV

Proyecto de gestión de Recursos Humanos desarrollado con **Laravel 12**, **Jetstream**, **Livewire** y **PostgreSQL**. Implementa autenticación, control de roles y permisos, gestión de empleados y mucho más.

---

## 🚀 Tecnologías utilizadas

- ⚙️ Laravel 12
- 🧪 Livewire + Jetstream
- 🛡️ Spatie Roles & Permisos
- 🐘 PostgreSQL
- 🎨 Tailwind CSS (Jetstream)
- 🧑‍💻 Herd (Entorno local para macOS)
- 🐙 GitHub (repositorio y versionamiento)

---

## 🔐 Autenticación y Seguridad

- Registro y login con Jetstream
- Verificación de correo
- Middleware por roles (`SuperAdmin`, `RRHH`, etc.)
- Acceso a rutas según permisos

---

## 🧍‍♂️ Gestión de Empleados

- Crear, editar, eliminar empleados
- Validaciones en frontend/backend
- Formulario reutilizable con Livewire
- Visualización con tabla estilizada

---

## 📌 Requisitos

- PHP >= 8.2
- Composer
- Node.js y NPM
- PostgreSQL
- Laravel Herd (o Laravel Valet)

---

## 🛠️ Instalación local

```bash
git clone https://github.com/tu_usuario/rh_laravel12.git
cd rh_laravel12
cp .env.example .env
# Editar las credenciales de base de datos
composer install
npm install && npm run build
php artisan migrate --seed
php artisan serve
