<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seu Filme</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Seu filme</a>
      <form class="d-flex" action="index.php" method="post">
        <input class="form-control me-sm-2" type="get" placeholder="Escreva..." id="pesquisa" name="pesquisa">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Pesquisar</button>
      </form>
    </div>
    </div>
  </nav><br><br>

  <div class="container text-center">
    <div class='row'>
       
    <?php
  if (isset($_POST['pesquisa'])) {
    $APIKEY = "c7ab045a7a61bb551d1eea508a6d67c2";

    $search = $_POST['pesquisa'];

    $url = "http://api.themoviedb.org/3/search/movie?query={$search}&api_key={$APIKEY}&language=pt-BR";
    $json = file_get_contents($url);
    $obj = json_decode($json);

    $total_pages = $obj->total_pages;


    for ($x = 1; $x <= $total_pages; $x++) {

      $url_single = "http://api.themoviedb.org/3/search/movie?query={$search}&api_key={$APIKEY}&language=pt-BR&page={$x}";
      $json_single = file_get_contents($url_single);
      $obj_single = json_decode($json_single);

      foreach ($obj_single->results as $resultado) {
        echo "
        
            <div class='col-sm-4 row' style=' margin-top: 5%; margin-left:0.2%;'>
                <div class='card border-primary' style='width: 18rem, height: 40%;'>
                  
                    <img src='https://image.tmdb.org/t/p/original/$resultado->poster_path' class='card-img-top' style='margin-top: 2%; border-radius: 5%' alt='...'>
                    <h3 class='card-title m-auto' style='text-align: center; '><strong>$resultado->title</strong></h3>
                    <div class='card-body'>                   
                        <p class='card-text' style='text-align: justify'>$resultado->overview</p>
                    </div>
                </div><br><br><br>
            
        </div>";
    }
  }
}
else{

  $APIKEY = "c7ab045a7a61bb551d1eea508a6d67c2";
  
  $url = "https://api.themoviedb.org/3/movie/top_rated?api_key={$APIKEY}&language=pt-BR&page=1";
  $json = file_get_contents($url);
  $obj = json_decode($json);
  
  $total_pages = $obj->total_pages;
  
  
  for ($x=1; $x <= $total_pages; $x++) {
    $url_single = "https://api.themoviedb.org/3/movie/top_rated?api_key={$APIKEY}&language=pt-BR&page={$x}";
    $json_single = file_get_contents($url_single);
    $obj_single = json_decode($json_single);
    
    foreach($obj_single->results as $resultado) {
    echo "
         
    <div class='col-sm-4 row' style=' margin-top: 5%; margin-left:0.2%;'>
    <div class='card border-primary' style='width: 18rem, height: 40%;'>
      
        <img src='https://image.tmdb.org/t/p/original/$resultado->poster_path' class='card-img-top' style='margin-top: 2%; border-radius: 5%' alt='...'>
        <h3 class='card-title m-auto' style='text-align: center; '><strong>$resultado->title</strong></h3>
        <div class='card-body'>                   
            <p class='card-text' style='text-align: justify'>$resultado->overview</p>
        </div>
    </div><br><br><br>

</div>";
 }

}

}

  ?>


    </div>
</div>



</body>
</html>


