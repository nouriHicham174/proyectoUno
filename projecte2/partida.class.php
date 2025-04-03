<?php
   class Partida{
      public int $num_jugadores;
      public int $num_cartas;
      public int $turno;
      public array $baraja;
      public object $carta_en_mesa;
      public array $array_jugadores;
      public string $sentido;
      public string $color_actual;

      public function __construct(int $num_jugadores, int $num_cartas, array $baraja){
         $this->num_jugadores = $num_jugadores;
         $this->num_cartas = $num_cartas;
         $this->array_jugadores = array();
         $this->baraja = $baraja;
         $this->turno = 0;
         $this->sentido = 'derecha';

         //color actual para cartas de cambio de color
         $this->color_actual = '';

         //crear jugadores
         for($i=0 ; $i<$this->num_jugadores ; $i++){
            array_push($this->array_jugadores, new Jugador($i));
         }

         //añadir cartas
         foreach($this->array_jugadores as $jugador){
            for($i=0 ; $i < $this->num_cartas ; $i++){
               $jugador->afegirCarta($this->moverCartaAlFinal());
            }
         }

         //carta en mesa
         $this->carta_en_mesa = $this->moverCartaAlFinal();

         if ($this->carta_en_mesa->num == 13) {
            array_push($this->baraja, $this->carta_en_mesa);
            $this->carta_en_mesa = $this->moverCartaAlFinal();
        }
         
      }

      public function jugar(){

         //mostrar mano de cada jugador
         foreach($this->array_jugadores as $jugador){
            
            if ($jugador->id == $this->turno) {
               echo '<div class="jugadorActivo">';
               echo $jugador->mostra_ma(); // Mostrar cartas del jugador actual
               echo '<a href="?accion=robar" class="btn btn-primary robar">Robar carta</a>'; // Botón para robar carta
               echo '</div>';
            } else {
               echo '<div class="jugador">';
               echo $jugador->mostra_cartas_ocultas(); // Ocultar cartas de otros jugadores
               echo '</div>';
            }
            
         }

         //mostrar carta en mesa
         echo '<div class="carta_mesa">';
         echo $this->carta_en_mesa->pinta_carta();
         echo '</div>';

      }



      public function jugarCarta($palo, $num){
         $jugador_actual = $this->array_jugadores[$this->turno];
         
         //buscar carta en la mano del jugador
         foreach ($jugador_actual->mano as $key => $carta) {
            if ($carta->palo == $palo || $carta->num == $num) {
               //comprobar si la carta se puede jugar
               if($carta->palo == $this->carta_en_mesa->palo || $carta->num == $this->carta_en_mesa->num || $carta->num == 13){
                  if($carta->num == 13){ //cambio color
                     $this->carta_en_mesa = $carta;
                     unset($jugador_actual->mano[$key]);
                     echo $this->cambiarColor();
                     $this->verificarGanador($jugador_actual);
                     return;

                  } elseif ($carta->num == 10) { // +2
                     printf("carta +2\n");
                     $this->carta_en_mesa = $carta;
                     unset($jugador_actual->mano[$key]);
                     $this->pasarTurno();
                     $this->verificarGanador($jugador_actual);
                     return;

                  } elseif ($carta->num == 11) { // Cambio de sentido
                     printf("cambio de sentido\n");
                     if ($this->sentido == 'derecha') {
                        $this->sentido = 'izquierda';
                     } else {
                        $this->sentido = 'derecha';
                     }
                     $this->carta_en_mesa = $carta;
                     unset($jugador_actual->mano[$key]);
                     $this->pasarTurno();
                     $this->verificarGanador($jugador_actual);
                     return;

                  } elseif ($carta->num == 12) { // Salto de turno
                     printf("salto de turno\n");
                     $this->carta_en_mesa = $carta;
                     unset($jugador_actual->mano[$key]);
                     $this->pasarTurno();
                     $this->pasarTurno();
                     $this->verificarGanador($jugador_actual);
                     return;

                  }else {
                     $this->carta_en_mesa = $carta;
                     unset($jugador_actual->mano[$key]);
                     $this->pasarTurno();
                     $this->verificarGanador($jugador_actual);
                     return;
                  }
                  
               }else{
                  printf("La carta no se puede jugar\n");
               }

            }
         }

      }

      private function verificarGanador($jugador_actual) {
         if (count($jugador_actual->mano) == 0) {
             header('Location: ganador.php');
             exit;
         }
      }

      public function pasarTurno(){
         if ($this->sentido == 'derecha') {
            $this->turno = ($this->turno + 1) % $this->num_jugadores;
         } else {
            $this->turno = ($this->turno - 1 + $this->num_jugadores) % $this->num_jugadores;
         }
      }

      //mover carta al final de la baraja
      public function moverCartaAlFinal(){
         $carta = array_shift($this->baraja);
         array_push($this->baraja, $carta);
         return $carta;
      }

      //robar una carta
      public function robarCarta(){
         $jugador_actual = $this->array_jugadores[$this->turno];
         $jugador_actual->afegirCarta($this->moverCartaAlFinal());
         $this->pasarTurno();
      }

      public function cambiarColor(){
         if (isset($_GET['color'])) {
            $this->color_actual = $_GET['color'];
            $this->carta_en_mesa = new Carta($this->color_actual, 13);    
            $this->pasarTurno();
         } else {
             return '
               <form action="" method="GET">
                     <input type="hidden" name="accion" value="cambiar_color">
                     <select name="color" id="color">
                        <option value="red">Rojo</option>
                        <option value="yellow">Amarillo</option>
                        <option value="blue">Azul</option>
                        <option value="green">Verde</option>
                     </select>
                     <button type="submit">Enviar</button>
               </form>
            ';
         }
     }
   }
?>