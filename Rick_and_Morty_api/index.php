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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
    
    <div class="text-center">
        <p class="fs-2 text-white mt-4">Personajes Episodio 1</p>
    </div>

    <div class="container">
        <div id="infoCharacters" class="row">
        <?php
        $capitulo = 1;
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
        foreach ($results as $result) {
          //traer los personajes del episodio
          $chPersonaje = curl_init();
          curl_setopt($chPersonaje, CURLOPT_URL, $result);
          curl_setopt($chPersonaje, CURLOPT_RETURNTRANSFER, TRUE);
          $responsePersonaje = curl_exec($chPersonaje);
          curl_close($chPersonaje);
          //Json del personaje
          $dataPersonaje = json_decode($responsePersonaje, true);
          echo "<div class='col-12 col-md-6 col-lg-4 col-xl-3 mt-4'>
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

    <hr style="background-color: #FFFFFF; height: 10px;">
    <div class="text-center">
        <p class="fs-2 text-white">Personajes Aleatorios</p>
    </div>

    <div class="container">
        <div class="row">
        <?php
        //3 personajes aleatorios en tarjetas centradas con curl
        for ($i = 0; $i < 3; $i++) {
          $chPersonaje = curl_init();
          curl_setopt($chPersonaje, CURLOPT_URL, "https://rickandmortyapi.com/api/character/" . rand(1, 671));
          curl_setopt($chPersonaje, CURLOPT_RETURNTRANSFER, TRUE);
          $responsePersonaje = curl_exec($chPersonaje);
          curl_close($chPersonaje);
          //Json del personaje
          $dataPersonaje = json_decode($responsePersonaje, true);
          echo "<div class='col-12 col-md-6 col-lg-4 col-xl-4 mt-4'>
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

</body>

<script src="assets/js/bootstrap.min.js"></script>




</html>

