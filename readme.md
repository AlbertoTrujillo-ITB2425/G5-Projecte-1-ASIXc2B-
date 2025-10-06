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

1. Instalar i activar eines necesaries:
   ```bash
   sudo apt update && sudo apt upgrade -y
   sudo apt install apache2 php libapache2-mod-php php-mysql mariadb-server git unzip -y
   ```
   
2. Clona el repositori:
   ```bash
   sudo git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git
   ```

3. Mou els fitxers al directori web `/var/www/html`:
   ```bash
   cd G5-Projecte-1-ASIXc2B-/
   sudo mv * /var/www/html 
   ```
   
4. Afegir usuari root amb passwd root a mysql
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

