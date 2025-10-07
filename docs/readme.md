# Manual d'Instal·lació del Projecte PHP amb NGINX

- **Projecte:** Aplicació PHP – Equip G5 (ASIXc2B)
- **Repositori:** [https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git](https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git)
- **Entorn objectiu:** Servidor Ubuntu Server (sense entorn gràfic) i Ubuntu Desktop als clients
- **Tecnologies:** APACHE2, PHP-FPM, MariaDB, Git
- **Arquitectura:** El projecte segueix una estructura **monolítica** amb una separació funcional per fitxers. Cada fitxer PHP representa una acció concreta dins de la aplicacio (Crear, Llegir, Actualitzar, Eliminar) usuaris.

## Distribucio Servers:
- Alberto Trujillo: Client amb entorn grafic amb visual studio per desenvolupar el codi php i pujar al git
- Oscar Bravo: Servidor base de dades 
- Aleix Tomas: Servidor Web fa un clone del contingut que te el git 

## Estructura del projecte 
<img width="480" height="270" alt="image" src="https://github.com/user-attachments/assets/0d0c9211-1cad-47f9-a595-43d059daaa4d" />

---

## 1. Requisits previs

* Accés al servidor via SSH.
* Usuari amb permisos `sudo`.
* Connexió a internet.
* Sistema operatiu: Ubuntu Server (última versió estable).
* Paquets necessaris:

  * Al servidor: `apache2`, `php`, `php-fpm`, `php-mysql`, `mariadb-server`, `git`.
  * Als clients (opcional): navegador web, accés a la xarxa local o entrada DNS.

---

## 2. Preparació del servidor

Actualitzar el sistema i instal·lar els paquets necessaris:

```
sudo apt update && sudo apt upgrade -y
sudo apt install apache2 php libapache2-mod-php php-mysql mariadb-server git unzip -y

```
<img width="865" height="204" alt="Captura de pantalla de 2025-10-07 15-51-32" src="https://github.com/user-attachments/assets/672c0a22-5c0f-476b-880a-6fa307c151b7" />



Activar i iniciar els serveis principals:

```
sudo systemctl enable apache2 mariadb php8.1-fpm
sudo systemctl start apache2 mariadb php8.1-fpm
```

*Nota: comprova que la versió de PHP instal·lada coincideix amb el nom del servei (ex: `php8.2-fpm`).*

---

## 3. Configuració de la base de dades

Accedir a MariaDB:

```
sudo mysql -u root -p
```
Cambiar passwd a usuari root

```sql
ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';
FLUSH PRIVILEGES;
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
<img width="716" height="359" alt="image" src="https://github.com/user-attachments/assets/c8c30c9b-e249-472b-9f1f-ce6c849e7a89" />

---

## 4. Desplegament del projecte

Anar al directori web:

```
cd /var/www/html
sudo rm -rf *
```

Clonar el repositori:

```
sudo git clone https://github.com/AlbertoTrujillo-ITB2425/G5-Projecte-1-ASIXc2B-.git
cd G5-Projecte-1-ASIXc2B-/
sudo mv * /var/www/html 
```

Assignar permisos correctes:

```
sudo chown -R www-data:www-data /var/www/html

```
<img width="725" height="251" alt="image" src="https://github.com/user-attachments/assets/305b3701-769d-41bd-b90d-1d68e8476a87" />

---

## 5. Configuració de APACHE

Crear un fitxer de configuració per al projecte:

```
sudo nano /etc/nginx/sites-available/projecte-g5
```

Exemple bàsic de configuració:

```
<VirtualHost *:80>
    DocumentRoot /var/www/html
    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
---

## 6. Configuració de l'aplicació

Editar el fitxer `db.php` i afegir-hi les dades de connexió a la base de dades:

```php
$servername = "locahost";
$username = "root"; //Aqui l'usuari que te privilegis per modificar la base de dades 
$password = "root"; //La contrasenya corresponent
$dbname = "crud_db"; //Nom de la base de dades si es diu diferent modifica-ho

```
## 7.Correcio d'errors i commit final
<img width="1079" height="240" alt="Captura de pantalla de 2025-10-06 15-46-35" src="https://github.com/user-attachments/assets/ef33b02a-b2c9-4e60-bd63-6244ee79c879" />

---

## 8. Verificació del funcionament

index.php:
<img width="670" height="244" alt="image" src="https://github.com/user-attachments/assets/03abebe9-a1b5-4bae-8d0d-348bd017ada4" />

---

add.php:
<img width="670" height="244" alt="Captura de pantalla de 2025-10-06 15-54-38" src="https://github.com/user-attachments/assets/69e6bc9e-1705-4664-9b64-7e417a251a84" />
<img width="670" height="271" alt="image" src="https://github.com/user-attachments/assets/58e7a107-4497-4044-a983-e440823577ad" />

---

delete.php
<img width="670" height="271" alt="image" src="https://github.com/user-attachments/assets/468a34ae-0199-476f-98de-9c6924fb446f" />

---

edit.php
<img width="670" height="146" alt="Captura de pantalla de 2025-10-06 15-56-49" src="https://github.com/user-attachments/assets/842dbd7f-2982-4c83-a1ef-e7199d72bdcd" />
<img width="670" height="146" alt="image" src="https://github.com/user-attachments/assets/9720b4ce-7a4e-4241-93cb-c2bb7cfb340f" />




```
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/php8.1-fpm.log
```

## MYSQL EN FUNCIONAMENT: 
<img width="677" height="622" alt="image" src="https://github.com/user-attachments/assets/ec7d4d28-ec7d-4ab0-9826-68ff676e33ec" />


**Equip G5 – ASIXc2B**
Institut Tecnològic de Barcelona

* Alberto Trujillo
* Òscar Bravo
* Aleix Tomàs

