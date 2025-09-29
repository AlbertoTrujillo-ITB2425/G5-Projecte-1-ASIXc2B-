# 📘 Manual de Instalació del Projecte PHP amb **NGINX** – *Equip G5 ASIXc2B*

> **Repositori del projecte**:
> [https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git](https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git)
> **Entorn objectiu**: Servidor Ubuntu Server + Desktop Ubuntu per desenvolupadors
> **Tecnologies**: **NGINX**, PHP-FPM, MariaDB/MySQL, Git

---

## 🧰 1. Requisits previs

* Accés SSH al servidor.
* Usuari amb permisos `sudo`.
* Connexió a internet.
* Paquets: `nginx`, `php`, `php-fpm`, `php-mysql`, `mariadb-server`, `git`.

---

## 🔄 2. Preparació del servidor

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install nginx php php-fpm php-mysql mariadb-server git unzip -y
```

Activa i arrenca els serveis:

```bash
sudo systemctl enable nginx mariadb php8.1-fpm  # Ajusta la versió segons el sistema
sudo systemctl start nginx mariadb php8.1-fpm
```

---

## 🗄️ 3. Configuració de la base de dades

1. Accedeix a MariaDB:

```bash
sudo mysql
```

2. Executa:

```sql
CREATE DATABASE projecte_g5;
CREATE USER 'g5user'@'localhost' IDENTIFIED BY 'g5password';
GRANT ALL PRIVILEGES ON projecte_g5.* TO 'g5user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

3. Si tens un `.sql` per importar:

```bash
mysql -u g5user -p projecte_g5 < ruta/al/fitxer.sql
```

---

## 📁 4. Desplegament del projecte

1. Accedeix al directori web:

```bash
cd /var/www/html
sudo rm -rf *  # Només si és exclusiu pel projecte
```

2. Clona el repositori:

```bash
sudo git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git .
```

3. Permisos correctes:

```bash
sudo chown -R www-data:www-data /var/www/html
sudo find . -type d -exec chmod 755 {} \;
sudo find . -type f -exec chmod 644 {} \;
```

---

## ⚙️ 5. Configuració de NGINX

1. Crea un fitxer nou de configuració per al projecte:

```bash
sudo nano /etc/nginx/sites-available/projecte-g5
```

2. Exemple de configuració bàsica:

```nginx
server {
    listen 80;
    server_name projecte-g5.local;  # Canvia-ho pel teu domini o IP

    root /var/www/html;
    index index.php index.html;

    location / {
        try_files $uri $uri/ =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;  # Comprova la versió
    }

    location ~ /\.ht {
        deny all;
    }

    access_log /var/log/nginx/g5_access.log;
    error_log /var/log/nginx/g5_error.log;
}
```

> ⚠️ **Assegura't que `php8.1-fpm.sock` existeix. Pots canviar la versió a `php8.2-fpm.sock` si cal.**

3. Habilita el site i reinicia NGINX:

```bash
sudo ln -s /etc/nginx/sites-available/projecte-g5 /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl reload nginx
```

---

## ⚠️ 6. Configuració de l’aplicació

Si existeix un fitxer `config.php`, `.env` o similar, edita’l i assegura’t que conté:

```php
$host = "localhost";
$dbname = "projecte_g5";
$user = "g5user";
$password = "g5password";
```

---

## ✅ 7. Comprovar que tot funciona

1. Obre el navegador i visita: `http://IP_DEL_SERVIDOR` o `http://projecte-g5.local` (si tens el DNS o `/etc/hosts` configurat).

2. Per depurar errors:

```bash
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/php8.1-fpm.log
```

3. Revisa que:

* El servei PHP-FPM està actiu.
* La connexió a la base de dades funciona.
* Les rutes de fitxers són correctes.

---

## 🛡️ 8. Consells finals per producció

* Desactiva `display_errors` a `php.ini`:

  ```ini
  display_errors = Off
  ```
* Si hi ha `.env`, afegeix-lo a `.gitignore`.
* Activa HTTPS amb Let's Encrypt:

  ```bash
  sudo apt install certbot python3-certbot-nginx -y
  sudo certbot --nginx
  ```
* Fes còpies de seguretat periòdiques.

---

## 📎 Comandes ràpides per desplegament

```bash
cd /var/www/html
sudo rm -rf *
sudo git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git .
sudo chown -R www-data:www-data .
```

---

## 👥 Autors del projecte

* **Equip G5 – ASIXc2B**
* Institut Tecnològic de Barcelona
* Alberto Trujillo, Oscar Bravo i Aleix Tomas

---

