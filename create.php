<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['title']) && isset($_POST['password'])) {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $password = md5($_POST['password']); // Hacher le mot de passe avec md5
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        
        // Ajout de la photo de profil
        $profile = $_FILES['profile_picture']['name'];
        $profile_tmp = $_FILES['profile_picture']['tmp_name'];
        $profile_path = "photo_profil/$profile";
        move_uploaded_file($profile_tmp, $profile_path);

        $sql1 = "INSERT INTO authors (lastname, firstname, email, title, created_at, updated_at, profile) 
                 VALUES ('$lastname', '$firstname', '$email', '$title', '$created_at', '$updated_at', '$profile_path')";
        
        if (mysqli_query($conn, $sql1)) {
            $id = mysqli_insert_id($conn);
            $sql2 = "INSERT INTO password (id, password) VALUES ('$id', '$password')";
            
            if (mysqli_query($conn, $sql2)) {
                header('Location: read.php');
                exit();
            } else {
                echo "Erreur : " . $sql2 . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erreur : " . $sql1 . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un auteur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css">
</head>
<body>

<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="read.php">
            Retour
        </a>
    </div>
</nav>

<section class="section">
    <div class="container">
        <h1 class="title is-3 has-text-centered">Adding an author</h1>

        <div class="box">
            <form action="create.php" method="post" enctype="multipart/form-data">
                <div class="field">
                    <label class="label">Firstname</label>
                    <div class="control">
                        <input class="input" type="text" name="firstname" placeholder="Firstname" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Lastname</label>
                    <div class="control">
                        <input class="input" type="text" name="lastname" placeholder="Lastname" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Title</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="title">
                                <option value="Dr">Dr.</option>
                                <option value="Prof">Prof.</option>
                                <option value="Ms">Ms.</option>
                                <option value="Mr">Mr.</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input class="input" type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Photo de profil</label>
                    <div class="control">
                        <input  type="file" name="profile_picture">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button class="button is-primary is-fullwidth" type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

</body>
</html>
