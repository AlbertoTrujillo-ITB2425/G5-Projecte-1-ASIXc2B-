# 👤 G5 Projecte 1 – Gestió d’usuaris amb PHP i MySQL

## Què és aquest projecte?

És una web molt senzilla per **gestionar usuaris**: pots crear, veure, editar i esborrar usuaris des d’una pàgina web. Utilitza **PHP**, **MySQL** i **HTML**. Està pensada per funcionar en un servidor Ubuntu amb Apache.

---

## 📁 Arxius del projecte

```
├── index.php       → Llista de tots els usuaris
├── add.php         → Formulari per afegir nous usuaris
├── edit.php        → Formulari per editar usuaris
├── delete.php      → Esborra un usuari
├── db.php          → Connexió a la base de dades
├── docs/           → Documentació i ajuda
└── readme.md       → Aquest fitxer
```

---

## 🛠️ Requisits

- Un servidor Ubuntu
- Apache2
- PHP
- MySQL o MariaDB
- Git

---

## 🚀 Com instal·lar i posar-ho en marxa

1. **Instal·la els programes necessaris:**
   ```bash
   sudo apt update
   sudo apt install apache2 php libapache2-mod-php php-mysql mariadb-server git unzip -y
   sudo systemctl enable apache2 mariadb
   sudo systemctl start apache2 mariadb
   ```

2. **Descarrega el projecte:**
   ```bash
   git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git
   ```

3. **Copia els arxius a la carpeta web:**
   ```bash
   cd G5-Projecte-1-ASIXc2B-
   sudo mv * /var/www/html/
   ```

4. **Crea la base de dades i la taula:**

   Entra a MySQL:
   ```bash
   sudo mysql
   ```

   Escriu això a la consola de MySQL:
   ```sql
   CREATE DATABASE crud_db;
   USE crud_db;
   CREATE TABLE users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(100) NOT NULL,
     email VARCHAR(100) NOT NULL
   );
   EXIT;
   ```

5. **Obre la web al navegador:**  
   Ves a: [http://localhost/index.php](http://localhost/index.php)

---

## ℹ️ Més informació

- Consulta la carpeta [`docs/`](./docs) si necessites ajuda o vols saber com està fet.

---

## 📝 Notes

- Si tens algun error, revisa que tens tots els programes instal·lats i la base de dades creada.
- Per qualsevol dubte, pregunta al professor o obre una “issue” a GitHub.
