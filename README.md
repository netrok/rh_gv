<p align="center">
  <img src="https://readme-typing-svg.herokuapp.com/?color=0D8ABC&lines=Sistema+de+Recursos+Humanos+RH+GV;Laravel+12+%7C+Livewire+%7C+PostgreSQL;100%25+Modular+y+Escalable" />
</p>

<p align="center">
  <img src="https://img.shields.io/github/languages/top/ernestoramirez/rh_laravel12?style=for-the-badge" />
  <img src="https://img.shields.io/github/last-commit/ernestoramirez/rh_laravel12?style=for-the-badge" />
  <img src="https://img.shields.io/github/license/ernestoramirez/rh_laravel12?style=for-the-badge" />
</p>

---

# 💼 Sistema de Recursos Humanos RH-GV

Proyecto de gestión de Recursos Humanos desarrollado con **Laravel 12**, **Jetstream**, **Livewire** y **PostgreSQL**. Implementa autenticación, control de roles y permisos, gestión de empleados y más módulos.

---

## 🚀 Tecnologías utilizadas

- ⚙️ Laravel 12
- 🧪 Livewire + Jetstream
- 🛡️ Spatie Roles & Permisos
- 🐘 PostgreSQL
- 🎨 Tailwind CSS (Jetstream)
- 🧑‍💻 Laravel Herd (entorno local)
- 🐙 GitHub para control de versiones

---

## 🔐 Autenticación y Seguridad

- Registro y login con Jetstream
- Verificación de email
- Middleware por roles (`SuperAdmin`, `RRHH`, etc.)
- Rutas protegidas con autorización avanzada

---

## 🧍‍♂️ Gestión de Empleados

- CRUD completo de empleados
- Validaciones en frontend y backend
- Formulario Livewire reutilizable
- Tabla estilizada y paginación futura
- Campos clave: nombre, puesto, departamento, CURP, RFC, NSS, etc.

---

## 🛠️ Instalación local

```bash
git clone https://github.com/ernestoramirez/rh_laravel12.git
cd rh_laravel12
cp .env.example .env
# Editar credenciales PostgreSQL en .env
composer install
npm install && npm run build
php artisan migrate --seed
php artisan serve
