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

    <div class="container">
        <div class="row">
        <?php
                //traer el dato de episodio
                $id = $_GET['id'];

                $capitulo = $id;
                //curl 
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode/" . $capitulo);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                $response = curl_exec($ch);
                curl_close($ch);

                //json
                $data = json_decode($response, true);
               
                //traer los personajes del episodio
                $results = $data['characters'];
                echo "<div class='col-12 d-flex justify-content-center flex-wrap justify-content-around'>
                    <div class='mt-3 text-center text-white'>
                        <p class='card-text '><h1>Personajes Del Episodio:</h1></p>
                        <p class='card-text '><h1>" . $data['name'] . "</h1></p>
                        <p class='card-text '><h1>'" . $data['episode'] . "'</h1></p>
                    </div>   
                </div>";
                //mostrar todos los episodios
                foreach ($results as $result) {
                    //echo "<center>";
                    // echo $result;
                    //traer los personajes del episodio
                    $chPersonaje = curl_init();
                    curl_setopt($chPersonaje, CURLOPT_URL, $result);
                    curl_setopt($chPersonaje, CURLOPT_RETURNTRANSFER, TRUE);
                    $responsePersonaje = curl_exec($chPersonaje);
                    curl_close($chPersonaje);
                    //Json del personaje
                    $dataPersonaje = json_decode($responsePersonaje, true);
                    //Imprimir el personaje
                    echo "<div class='col-12 col-md-6 col-lg-3 col-xl-4 d-flex justify-content-center flex-wrap justify-content-around'>
                        <div class='card mb-3'>
                            <img src=" . $dataPersonaje['image'] . " class='card-img-top'>
                            <div class='card-body'>
                                <h5 class='card-title'>'" . $dataPersonaje['name'] . "'</h5>
                                <p class='card-text'>Estatus: '" . $dataPersonaje['status'] . "'</p>
                                <p class='card-text'>Especie: '" . $dataPersonaje['species'] . "'</p>
                                <p class='card-text'>Genero: '" . $dataPersonaje['gender'] . "'</p>
                            </div>
                        </div>   
                    </div>";
                }
                ?>
        </div>
    </div>

    <div class="container">
        <div class="row">
        </div>
    </div>

</body>


</html>