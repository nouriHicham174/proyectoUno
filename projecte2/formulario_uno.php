<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Uno - Seleccione jugadores y cartas</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="styles.css">
</head>
<body>
   <video id="background-video" autoplay loop muted poster="https://assets.codepen.io/6093409/river.jpg">
   <source src="./images/video_fondo_uno.mp4" type="video/mp4">
   </video>
   <section class="mt-5 text-center">
      <h2>UNO</h2>
   </section>
   <section class="container mt-2">
      <form action="index.php" method="post">
         <div class="d-flex justify-content-around">
         <div>
            <legend>Seleccione jugadores</legend>
            <div class="form-check">
               <input class="form-check-input" type="radio" name="numPlayers" value="2" checked>
               <label class="form-check-label">
                  2
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" name="numPlayers" value="3">
               <label class="form-check-label">
                  3
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" name="numPlayers" value="4">
               <label class="form-check-label">
                  4
               </label>
            </div>
         </div>
         <div class="g-3 align-items-center">
            <div class="col-auto">
               <legend for="numCartas" class="col-form-label">Numero de cartas</legend>
            </div>
            <div class="col-auto">
               <input type="number" class="form-control" name="numCartas" value="4" min="4" max="8">
            </div>
            <div class="col-auto">
               <span id="passwordHelpInline" class="form-text">
                  Elija entre 4-8.
               </span>
            </div>
         </div>
         </div>
         <button type="submit" class="btn btn-secondary mx-auto px-4" style="display: block;">Enviar</button>
      </form>
   </section>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>