<?php
   class Baraja{
      public array $conjunto_cartas = [];

      public function crea_baraja(){
         foreach(['red', 'yellow', 'blue', 'green'] as $color){
            for ($i = 0; $i <= 12; $i++){
               array_push($this->conjunto_cartas, new Carta($color, $i));
            }
         }
         array_push($this->conjunto_cartas, new Carta(' ', 13));
      }

      public function mezcla(){
         shuffle($this->conjunto_cartas);
         // echo '<pre>';
         // var_dump($this->conjunto_cartas);
         // echo '</pre>';
      }

      public function pinta_baraja(){
         foreach($this->conjunto_cartas as $carta){
            echo $carta->pinta_carta_link();
         }
      }

      public function getBaraja(){
         return $this->conjunto_cartas;
      }
   }
?>