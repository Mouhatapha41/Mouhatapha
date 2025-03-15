<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Auteurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar is-dark">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="#">
                    <strong>CRUDISTA</strong>
                </a>
            </div>
            <div class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item" href="authentification.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bouton Ajouter un auteur -->
    <div class="container mt-3 has-text-right">
        <a href="create.php" class="button is-link">
            <span class="icon"><i class="fas fa-plus"></i></span>
            <span>Ajouter un auteur</span>
        </a>
    </div>

    <div class="container mt-5">
        <h1 class="title is-3 has-text-centered">Liste des auteurs</h1>

        <div class="box">
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';
                    $sql = "SELECT * FROM authors";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['firstname'] . "</td>";
                            echo "<td>" . $row['lastname'] . "</td>";
                            echo "<td>
                                    <a href='visualiser.php?id=" . $row['id'] . "' class='button is-small is-info'><span class='icon'><img src='visualiser.png'></span></a>
                                    <a href='update.php?id=" . $row['id'] . "' class='button is-small is-warning'><span class='icon'><img src='update_crud.png'></span></a>
                                    <a href='delete.php?id=" . $row['id'] . "' class='button is-small is-danger'><span class='icon'><img src='delete_CRUD.png'></span></a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='has-text-centered'>Base de données vide</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
