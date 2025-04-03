<?php
   class Jugador{
      public array $mano;
      public int $id;

      public function __construct($id){
         $this->id = $id;
         $this->mano = array();
      }

      public function afegirCarta($carta){
         array_push($this->mano, $carta);
      }

      public function eliminarCarta($carta){
         $nuevaMano = array();

         foreach($this->mano as $mano){
            if( ($mano->palo && $mano->num) != ($carta->palo && $carta->num)){
               array_push($nuevaMano, $mano);
            }
         }
         $this->mano = $nuevaMano;

      }

      public function mostra_ma(){
         $cartas = '';
         foreach($this->mano as $mano){
            $cartas .= $mano->pinta_carta_link();
         }
         return $cartas;
      }

      public function mostra_cartas_ocultas(){
         $cartas = '';
         foreach($this->mano as $mano){
            $cartas .= $mano->pinta_carta_girada();
         }
         return $cartas;
      }
   }
?>