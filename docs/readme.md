# Manual d'Instal·lació del Projecte PHP amb NGINX

**Projecte:** Aplicació PHP – Equip G5 (ASIXc2B)
**Repositori:** [https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git](https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git)
**Entorn objectiu:** Servidor Ubuntu Server (sense entorn gràfic) i Ubuntu Desktop als clients
**Tecnologies:** NGINX, PHP-FPM, MariaDB, Git

---

## 1. Requisits previs

* Accés al servidor via SSH.
* Usuari amb permisos `sudo`.
* Connexió a internet.
* Sistema operatiu: Ubuntu Server (última versió estable).
* Paquets necessaris:

  * Al servidor: `nginx`, `php`, `php-fpm`, `php-mysql`, `mariadb-server`, `git`.
  * Als clients (opcional): navegador web, accés a la xarxa local o entrada DNS.

---

## 2. Preparació del servidor

Actualitzar el sistema i instal·lar els paquets necessaris:

```
sudo apt update && sudo apt upgrade -y
sudo apt install nginx php php-fpm php-mysql mariadb-server git unzip -y
```

Activar i iniciar els serveis principals:

```
sudo systemctl enable nginx mariadb php8.1-fpm
sudo systemctl start nginx mariadb php8.1-fpm
```

*Nota: comprova que la versió de PHP instal·lada coincideix amb el nom del servei (ex: `php8.2-fpm`).*

---

## 3. Configuració de la base de dades

Accedir a MariaDB:

```
sudo mysql
```

Crear la base de dades i l'usuari per a l'aplicació:

```sql
CREATE DATABASE crud_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci Where false;

USE crud_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);
```

Importar dades si hi ha un fitxer `.sql`:

```
mysql -u g5user -p projecte_g5 < /ruta/al/fitxer.sql
```

---

## 4. Desplegament del projecte

Anar al directori web:

```
cd /var/www/html
sudo rm -rf *
```

Clonar el repositori:

```
sudo git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git .
```

Assignar permisos correctes:

```
sudo chown -R www-data:www-data /var/www/html
sudo find . -type d -exec chmod 755 {} \;
sudo find . -type f -exec chmod 644 {} \;
```
<img width="725" height="251" alt="image" src="https://github.com/user-attachments/assets/305b3701-769d-41bd-b90d-1d68e8476a87" />

---

## 5. Configuració de NGINX

Crear un fitxer de configuració per al projecte:

```
sudo nano /etc/nginx/sites-available/projecte-g5
```

Exemple bàsic de configuració:

```
server {
    listen 80;
    server_name projecte-g5.local;

    root /var/www/html;
    index index.php index.html;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }

    access_log /var/log/nginx/g5_access.log;
    error_log /var/log/nginx/g5_error.log;
}
```

Activar el lloc i reiniciar NGINX:

```
sudo ln -s /etc/nginx/sites-available/projecte-g5 /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl reload nginx
```

---

## 6. Configuració de l'aplicació

Editar el fitxer `config.php` (o `.env`) i afegir-hi les dades de connexió a la base de dades:

```php
$host = "localhost";
$dbname = "projecte_g5";
$user = "g5user";
$password = "g5password";
```

---

## 7. Verificació del funcionament

1. Des d’un navegador, accedir a:
   `http://<IP_DEL_SERVIDOR>`
   o bé `http://projecte-g5.local` (si s’ha configurat el DNS o `/etc/hosts`).

2. Si cal revisar errors:

```
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/php8.1-fpm.log
```

3. Comprovar que:

   * PHP-FPM està actiu.
   * La connexió a la base de dades funciona.
   * Les rutes i permisos són correctes.

---

## 8. Bones pràctiques per entorns de producció

* Desactivar la visualització d’errors en `php.ini`:

```
display_errors = Off
```

* Excloure fitxers sensibles (`.env`, backups, etc.) amb `.gitignore`.
* Activar HTTPS amb Let’s Encrypt:

```
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx
```

* Programar còpies de seguretat periòdiques (fitxers i base de dades).

---

## 9. Instal·lació en equips client (Ubuntu Desktop)

1. Assegurar-se que l’equip client està a la mateixa xarxa que el servidor.
2. Afegir el domini local al fitxer `/etc/hosts`:

```
sudo nano /etc/hosts
```

Afegir una línia com aquesta:

```
192.168.XX.XX    projecte-g5.local
```

3. Obrir un navegador i accedir a:

```
http://projecte-g5.local
```

---

## 10. Comandes ràpides per al desplegament

```
cd /var/www/html
sudo rm -rf *
sudo git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git .
sudo chown -R www-data:www-data .
```

---

## 11. Autors del projecte

**Equip G5 – ASIXc2B**
Institut Tecnològic de Barcelona

* Alberto Trujillo
* Òscar Bravo
* Aleix Tomàs

