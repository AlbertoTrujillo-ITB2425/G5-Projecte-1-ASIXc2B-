<?php
error_reporting(E_ALL); // Activa la visualització d’errors
ini_set('display_errors', 1); // Mostra els errors en pantalla

include 'db.php'; // Assegura’t que el fitxer existeix i defineix $conn correctament
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>CRUD mínim</title>
</head>
<body>
    <h1>Llista d’usuaris</h1>

    <table border="1"> <!-- S'ha eliminat la duplicació de <table> -->
        <tr><th>ID</th><th>Nom</th><th>Email</th><th>Accions</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM users");

        if (!$result) {
            die("Error en la consulta: " . $conn->error); // Afegida gestió d’errors si la consulta falla
        }

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Eliminar</a>
                    </td>
                 </tr>";
        }
        ?>
    </table>

    <h2>Afegir usuari</h2>

    <!-- Comentari HTML correcte, abans estava dins del <form> com a comentari PHP -->
    <!-- Abans hi havia un posts i no funcionava -->

    <form action="add.php" method="post"> <!-- S'ha corregit 'posts' per 'post' -->
        Nom: <input type="text" name="name" required>
        Email: <input type="email" name="email" required>
        <button type="submit">Afegir</button>
    </form>
</body>
</html>
