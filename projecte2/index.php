<?php
session_start();

include_once 'carta.class.php';
include_once 'baraja.class.php';
include_once 'partida.class.php';
include_once 'carta.class.php';
include_once 'jugador.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   // comprovar formulario enviado 
   if (!isset($_POST['numPlayers']) || !isset($_POST['numCartas'])) {
       header('Location: formulario_uno.php');
       exit;
   } else {
       // crear partida y guardarla en la sesión
       $prueba = new Baraja(); 
       $prueba->crea_baraja();
       $prueba->mezcla();
       
       $pruebaPartida = new Partida($_POST['numPlayers'], $_POST['numCartas'], $prueba->getBaraja());
       $_SESSION['partida'] = serialize($pruebaPartida);
   }

} else {
   // comprovar si hay partida en la sesión
   if (isset($_SESSION['partida'])) {
      // recuperar partida de la sesión
      $pruebaPartida = unserialize($_SESSION['partida']);

      if (isset($_GET['accion'])) {
         if ($_GET['accion'] == 'robar') {
            $pruebaPartida->robarCarta();

         } elseif ($_GET['accion'] == 'cambiar_color' && isset($_GET['color'])) {
            $pruebaPartida->cambiarColor();
         }
         $_SESSION['partida'] = serialize($pruebaPartida);

      } elseif (isset($_GET['palo']) || isset($_GET['num'])) {
         $pruebaPartida->jugarCarta($_GET['palo'], $_GET['num']);
         $_SESSION['partida'] = serialize($pruebaPartida);
      }


   } else {
       header('Location: formulario_uno.php');
       exit;
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Uno - <?php 
         if (isset($_GET['palo'])) {
            if ($_GET['palo'] == 'red') {
               echo '🟥';
            } elseif ($_GET['palo'] == 'yellow') {
               echo '🟨';
            } elseif ($_GET['palo'] == 'blue') {
               echo '🟦';
            } elseif ($_GET['palo'] == 'green') {
               echo '🟩';
            } elseif (!isset($_GET['palo'])){
               echo '⬛';
            }else{
               echo '⬛';
            }
         }
      ?></title>
   <link rel="stylesheet" href="styles.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
   <div>
      <?php 
         $pruebaPartida->jugar();
      ?>
      <button class="btn btn-secondary"><a href="logout.php" class="text-decoration-none link-light">Terminar partida</a></button>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>