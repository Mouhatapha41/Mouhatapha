<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM authors WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Informations de l'auteur</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
        </head>
        <body>
            <section class="section">
                <div class="container">
                    <h1 class="title is-3">Informations de l'auteur</h1>
                    
                    <div class="box">
                        <figure >
                            <img  src="<?php echo $row['profile']; ?>" alt="Photo de profil" width = "180" height = "180">
                        </figure>

                        <div class="content">
                            <p><strong>Nom :</strong> <?php echo $row['lastname']; ?></p>
                            <p><strong>Prénom :</strong> <?php echo $row['firstname']; ?></p>
                            <p><strong>Email :</strong> <?php echo $row['email']; ?></p>
                            <p><strong>Titre :</strong> <?php echo $row['title']; ?></p>
                        </div>
                    </div>

                    <a href="read.php" class="button is-primary">Retour</a>
                </div>
            </section>
        </body>
        </html>

        <?php
    }
}
?>
