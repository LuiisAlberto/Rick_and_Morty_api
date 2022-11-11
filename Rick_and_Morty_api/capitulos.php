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
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid ">
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
        <p class="fs-2 text-white mt-4">Todos Los Capitulos</p>
    </div>

    <div class="container">
        <div class="row">
            <?php
            $page = 1;
            //curl
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode?page=" . $page);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);
            $episodios = $data['results'];

            foreach ($episodios as $episodios) {
                $name = $episodios['name'];
                $episode = $episodios['episode'];
                $air_date = $episodios['air_date'];
                $url = $episodios['url'];
                $created = $episodios['created'];
                echo "<div class='col-12 col-md-6 col-lg-4 col-xl-3 mt-5'>
                            <div class='card mb-3'>
                                <div class='card-header'>
                                    <h5 class='card-title'>$name</h5>
                                </div>
                                <div class='card-body'>
                                    <p class='card-text'>Episodio: $episode</p>
                                    <p class='card-text'>Fecha de Emisión: $air_date</p>
                                    <p class='card-text'>Creado: $created</p>

                                </div>
                                <div class='card-footer'>
                                    <a href='capitulo_especifico.php?id=" . $episodios['id'] . "' class='btn btn-primary'>Mas información del capitulo: '" . $episodios['name'] . "'</a>
                                </div>
                            </div>
                        </div>";
            }
            $pages = $data['info']['pages'];
            ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center flex-wrap justify-content-around mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination d-flex justify-content-center flex-wrap">
                        <?php
                            for ($i = 1; $i <= $pages; $i++) {
                                echo "<li class='page-item'><a class='page-link' href='capitulo.php?page=$i'>$i</a></li>";
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</body>


</html>