<?php
include 'db.php'; // Inclou la connexió amb la base de dades

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Converteix l'identificador rebut per GET a enter
    $result = $conn->query("SELECT * FROM users WHERE id=$id"); // Consulta per obtenir les dades de l'usuari
    $user = $result->fetch_assoc(); // Desa les dades en un array associatiu
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)$_POST['id']; // Converteix l'identificador rebut per POST a enter
    $name  = $_POST['name'];    // Captura el nou nom
    $email = $_POST['email'];   // Captura el nou correu electrònic

    // Error: la sentència SQL està mal escrita
    // "UPDATE users where name=?, email=? WHERE id=?" no és vàlida
    // No es pot utilitzar "WHERE" per assignar valors. Cal fer servir "SET"
    $stmt = $conn->prepare("UPDATE users where name=?, email=? WHERE id=?");

    // La vinculació dels paràmetres és correcta, però no funcionarà per culpa de l'error en la consulta
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute(); // Executa la consulta, però no actualitzarà res correctament

    header("Location: index.php"); // Redirigeix a la pàgina principal després d'intentar desar
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar usuari</title>
</head>
<body>
    <h1>Editar usuari</h1>
    <form method="post">
        <!-- Camp ocult per enviar l'identificador de l'usuari -->
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <!-- Camp de text per al nom, preomplert amb el valor actual -->
        Nom: <input type="text" name="name" value="<?= $user['name'] ?>" required>

        <!-- Camp de correu electrònic, preomplert amb el valor actual -->
        Email: <input type="email" name="email" value="<?= $user['email'] ?>" required>

        <!-- Botó per enviar el formulari -->
        <button type="submit">Desar</button>
    </form>
</body>
</html>
