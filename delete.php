<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de l'auteur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body class="has-background-white">

    <div class="container is-flex is-flex-direction-column is-align-items-center mt-6">
        
        <?php
        include 'db.php';
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM authors WHERE id = '$id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                ?>
                
                <div class="box has-text-centered has-text-link">
                    <h1 class="title is-3">Suppression de l'auteur</h1>
                    
                    <figure class="image is-128x128 is-inline-block">
                        <img src="<?php echo $row['profile']; ?>" alt="Photo de profil">
                    </figure>

                    <div class="content">
                        <p><strong>Nom :</strong> <?php echo $row['lastname']; ?></p>
                        <p><strong>Prénom :</strong> <?php echo $row['firstname']; ?></p>
                        <p><strong>Email :</strong> <?php echo $row['email']; ?></p>
                        <p><strong>Titre :</strong> <?php echo $row['title']; ?></p>
                    </div>

                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="button is-danger">Confirmer</button>
                        <a href="read.php" class="button is-link">Annuler</a>
                    </form>
                </div>

                <?php
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $sql = "DELETE FROM password WHERE id = '$id'; DELETE FROM authors WHERE id = '$id';";
                if (mysqli_multi_query($conn, $sql)) { ?>
                    <div class="notification is-success has-text-centered mt-6">
                        <h1 class="title is-4">Auteur supprimé avec succès</h1>
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
