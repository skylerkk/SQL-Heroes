<?php
include "functions.php";
?>

<!doctype html>
<html lang="en">

<head>
    <title>SQL Heroes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light col-12">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Add New Hero</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hero Name Change</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Delete a Hero</a>
                    </li>
                    </ul>
                </div>
            </nav>
            
            <?php 
                $conn = start_server();
                $heroquery = "SELECT id, name, about_me, biography FROM heroes WHERE id = '{$conn->real_escape_string($_POST['heropage'])}'";
                $hero = $conn->query($heroquery);
                stop_server($conn);
                if($hero->num_rows>0){
                    while($row = $hero->fetch_assoc()){

                        echo "<h2>{$row['name']}</h2> <nl>";
                        echo "<p>{$row['about_me']}</p> <nl>";
                        echo "<p>{$row['biography']}</p> <nl>";
                        echo "<form action='index.php'>";
                            echo "<button class='btn btn-secondary'>Back</button>";
                        echo "</form>";
                    }
                }
            ?>

            

        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>