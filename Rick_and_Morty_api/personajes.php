<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Rick and Morty</title>
</head>

<body class="bg">
    <header class="text-center">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="assets/img/Rick_and_Morty.svg" alt="Logo Rick_and_Morty" class="img-fluid rick">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="capitulos.php?page=1">Capítulos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5" href="personajes.php?page=1">Personajes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="text-center text-white">
        <p class="fs-2 text-white mt-4">Todos Los Personajes</p>
    </div>

    <div class="container">
        <div class="row">
            <?php
            $page = 1;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/character/?page=" . $page);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $response = curl_exec($ch);
                curl_close($ch);

                //traer a todos los personajes de la pagina 1
                $data = json_decode($response, true);
                $results = $data['results'];
                foreach ($results as $result) {
                    echo "<div class='col-6 col-md-4 col-lg-3 mt-5'>
                            <div class='card mb-3'>
                                <img src=" . $result['image'] . " class='card-img-top'>
                                <div class='card-body text-break'>
                                    <h5 class='card-title text-break'>'" . $result['name'] . "'</h5>
                                    <p class='card-text'>Estatus: '" . $result['status'] . "'</p>
                                    <p class='card-text'>Especie: '" . $result['species'] . "'</p>
                                    <p class='card-text'>Genero: '" . $result['gender'] . "'</p>
                                </div>
                            </div>   
                        </div>";
                }
            }

            $pages = $data['info']['pages'];
            ?>
        </div>
    </div>

    <div class="container">
        <ul class="pagination justify-content-center mt-4" id="pagination">
            <?php
            //paginacion solo con los botones de anterior y siguiente
            if ($page > 1) {
                echo "<li class='page-item'><a class='page-link' href='personajes.php?page=" . ($page - 1) . "'>Anterior</a></li>";
            }
            if ($page < $pages) {
                echo "<li class='page-item'><a class='page-link' href='personajes.php?page=" . ($page + 1) . "'>Siguiente</a></li>";
            }
            
            ?>
        </ul>
    </div>

</body>

<script src="assets/js/bootstrap.min.js"></script>



</html>