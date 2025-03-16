<?php
include 'db.php';
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']); 
        $sql = "SELECT * FROM authors INNER JOIN password ON authors.id = password.id WHERE authors.email = '$email' AND password.password = '$password'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            header('Location: read.php');
            exit();
        } else {
            $error_message = "Email ou mot de passe incorrect.";
        }
    } else {
        $error_message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
</head>
<body class="has-background-light">

<!-- Header -->
<section class="hero is-primary">
    <div class="hero-body has-text-centered">
        <h1 class="title is-2">CRUDISTA</h1>
        <p class="subtitle">Bienvenue sur notre plateforme</p>
    </div>
</section>

<!-- Pour le formulaire d'authentification -->
<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-4">
                <div class="box">
                    <h2 class="title is-4 has-text-centered">Connexion</h2>
                    <?php if ($error_message){ ?>
                        <div class="notification is-danger">
                            <?= $error_message ?>
                        </div>
                    <?php } ?>
                    <form action="authentification.php" method="post">
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control">
                                <input class="input" type="email" name="email" placeholder="Entrez votre email" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Mot de passe</label>
                            <div class="control">
                                <input class="input" type="password" name="password" placeholder="Entrez votre mot de passe" required>
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <button class="button is-primary is-fullwidth" type="submit">Se connecter</button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</section>

</body>
</html>
