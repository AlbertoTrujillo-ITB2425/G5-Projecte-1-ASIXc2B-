**G5 Projecte 1 – Gestio d’usuaris amb PHP i MySQL**

---

## 📝 Descripció

Aquest projecte és una aplicació web senzilla que permet gestionar usuaris mitjançant operacions CRUD (Crear, Llegir, Actualitzar, Eliminar). Està desenvolupat amb PHP, MySQL i HTML, i pensat per ser desplegat en un servidor Apache.

---

## 🧱 Estructura del projecte

```
├── index.php       → Llista d’usuaris
├── add.php         → Formulari per afegir usuaris
├── edit.php        → Formulari per editar usuaris
├── delete.php      → Eliminació d’usuaris
├── db.php          → Connexió amb la base de dades
├── docs/           → Documentació tècnica i funcional
└── readme.md       → Fitxer de presentació del projecte
```

---

## ⚙️ Tecnologies utilitzades

- PHP 8
- MySQL/MariaDB
- HTML5
- Apache2
- Ubuntu Server

---

## Com executar el projecte

1. Clona el repositori:
   ```bash
   sudo git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git
   ```

2. Mou els fitxers a `/var/www/html` si treballes amb Apache:
   ```bash
   cd G5-Projecte-1-ASIXc2B-/
   sudo mv * /var/www/html 
   ```
3. Afegir usuari root amb passwd root a mysql
   ```bash
   sudo mysql
   ```

   ```sql
   CREATE USER 'root'@'localhost' IDENTIFIED BY 'root';
   GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;
   FLUSH PRIVILEGES;
   EXIT;
   ```

   ```sql
   mysql -u root -p
   ```
   
5. Crea la base de dades db_crud i la taula `users` amb els camps `id`, `name`, `email`.
   ```sql
   CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

   USE crud_db;
   
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL
   );
   ```
   
6. Accedeix a `http://localhost/index.php` per començar.

---

## 📂 Documentació

Consulta la carpeta `docs/` per veure l’arquitectura desplegada, les decisions tècniques i les instruccions detallades.

---

