### 📘 Manual de Instalació del Projecte PHP – *Equip G5 ASIXc2B*

> **Repositori del projecte**:
> [https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git](https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git)
> **Entorn objectiu**: Servidor Linux sense entorn gràfic on es pujen els archius i s'emmagatzema la web (Ubuntu Server) + Desktop amb Entorn Grafic per desenvolupadors (Ubuntu Desktop)
> **Tecnologies**: Apache2, PHP, MariaDB/MySQL, Git

---

## 🧰 1. Requisits previs

* Tenir accés SSH al servidor.
* Usuari amb permisos `sudo`.
* Paquets instal·lats: `apache2`, `php`, `mariadb-server`, `git`.
* Connexió a internet.

---

## 🔄 2. Preparació del servidor

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 php php-mysql mariadb-server git unzip -y
```

Activa i arrenca els serveis:

```bash
sudo systemctl enable apache2 mariadb
sudo systemctl start apache2 mariadb
```

---

## 🗄️ 3. Configuració de la base de dades

1. Accedeix al client de MariaDB:

```bash
sudo mysql
```

2. Executa les instruccions següents:

```sql
CREATE DATABASE projecte_g5;
CREATE USER 'g5user'@'localhost' IDENTIFIED BY 'g5password';
GRANT ALL PRIVILEGES ON projecte_g5.* TO 'g5user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

3. Si hi ha un fitxer `.sql` amb la base de dades al repo, importa'l així:

```bash
mysql -u g5user -p projecte_g5 < ruta/al/fitxer.sql
```

---

## 📁 4. Desplegament del projecte

1. Accedeix al directori web:

```bash
cd /var/www/html
sudo rm -rf *  # Només si és un servidor exclusiu pel projecte
```

2. Clona el repositori:

```bash
sudo git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git .
```

3. Dona permisos correctes:

```bash
sudo chown -R www-data:www-data /var/www/html
sudo find . -type d -exec chmod 755 {} \;
sudo find . -type f -exec chmod 644 {} \;
```

---

## ⚙️ 5. Configuració d’Apache (virtualhost opcional)

Si només teniu aquest projecte al servidor, podeu usar el fitxer per defecte. Si voleu fer servir un **VirtualHost**:

```bash
sudo nano /etc/apache2/sites-available/projecte-g5.conf
```

Contingut bàsic:

```apache
<VirtualHost *:80>
    ServerName projecte-g5.local
    DocumentRoot /var/www/html

    <Directory /var/www/html>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/g5_error.log
    CustomLog ${APACHE_LOG_DIR}/g5_access.log combined
</VirtualHost>
```

Activa el site i reinicia Apache:

```bash
sudo a2ensite projecte-g5.conf
sudo a2dissite 000-default.conf
sudo systemctl reload apache2
```

---

## ⚠️ 6. Configuració de l’aplicació

* Comproveu si hi ha un fitxer `config.php`, `.env` o similar.
* Editeu-lo amb les dades de la base de dades que heu creat abans:

```php
$host = "localhost";
$dbname = "projecte_g5";
$user = "g5user";
$password = "g5password";
```

---

## ✅ 7. Comprovar que tot funciona

1. Al navegador: accedeix a `http://IP_DEL_SERVIDOR` o al domini configurat.

2. Si hi ha errors:

   ```bash
   sudo tail -f /var/log/apache2/error.log
   ```

3. Si l'aplicació no carrega bé, comprova:

   * La connexió a la base de dades
   * Els permisos dels fitxers
   * Si falta alguna extensió PHP (`php-mbstring`, `php-xml`, etc.)

---

## 🛡️ 8. Consells finals per producció

* No deixeu el `display_errors` activat en producció.
* Si feu servir `.env`, afegiu-lo a `.gitignore`.
* Activeu HTTPS si s'exposa el servidor a internet (Let’s Encrypt).
* Feu còpies de seguretat periòdiques de la base de dades.

---

## 📎 Exemple de comandes ràpides per desplegar

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


