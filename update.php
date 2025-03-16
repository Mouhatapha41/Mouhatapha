<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un auteur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body class="has-background-white">

    <!-- Barre de navigation avec bouton Retour -->
    <nav class="navbar is-dark">
        <div class="container">
            <div class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item has-background-danger has-text-white" href="read.php">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container is-flex is-flex-direction-column is-align-items-center mt-6">

        <?php
        include 'db.php';
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM authors WHERE id = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>
        
        <div class="box has-text-centered" style="color: #2ecc71;"> <!-- Vert menthe -->
            <h1 class="title is-3">Modifier l'auteur</h1>

            <figure class="image is-128x128 is-inline-block">
                <img src="<?php echo $row['profile']; ?>" alt="Photo de profil">
            </figure>

            <form action="update.php" method="post" enctype="multipart/form-data" class="mt-4">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <div class="field">
                    <label class="label">Nom</label>
                    <div class="control">
                        <input class="input" type="text" name="lastname" value="<?php echo $row['lastname']; ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Prénom</label>
                    <div class="control">
                        <input class="input" type="text" name="firstname" value="<?php echo $row['firstname']; ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" value="<?php echo $row['email']; ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Titre</label>
                    <div class="control">
                        <div class="select">
                            <select name="title">
                                <option value="Dr" <?php if ($row['title'] == 'Dr') echo 'selected'; ?>>Dr.</option>
                                <option value="Prof" <?php if ($row['title'] == 'Prof') echo 'selected'; ?>>Prof.</option>
                                <option value="Ms" <?php if ($row['title'] == 'Ms') echo 'selected'; ?>>Mme.</option>
                                <option value="Mr" <?php if ($row['title'] == 'Mr') echo 'selected'; ?>>Mr.</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field mt-4">
                    <div class="control">
                        <button class="button is-success is-fullwidth">Soumettre</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'], $_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['title'])) {
                $id = $_POST['id'];
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $title = $_POST['title'];
                $updated_at = date('Y-m-d H:i:s');


                $sql = "UPDATE authors SET lastname = '$lastname', firstname = '$firstname', email = '$email', title = '$title', updated_at = '$updated_at' WHERE id = '$id' ";


                if (mysqli_query($conn, $sql)) { ?>
                    <div class="notification is-success has-text-centered mt-6">
                        <h1 class="title is-4">Auteur modifié avec succès</h1>
                    </div>
                    <?php header('refresh: 1; read.php');
                } else {
                    echo "<div class='notification is-danger has-text-centered mt-6'>Erreur : " . mysqli_error($conn) . "</div>";
                }
            }
        }
        ?>

    </div>

</body>
</html>
