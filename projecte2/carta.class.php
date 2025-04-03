<?php
   class Carta{
      public string $palo;
      public int $num; //10 es +2, 11 es cambio de sentido, 12 salto turno, 13 cambio color
      public int $index;

      public function __construct(string $color, int $num){
         $this->palo = $color;
         $this->num = $num;
      }

      public function pinta_carta(){
         if(in_array($this->num, [0,1,2,3,4,5,6,7,8,9,10,11,12])){
            return '<img src="./images/'.$this->num.'_'.$this->palo.'.png" alt="'.$this->num.'_'.$this->palo.'">';
         }else if($this->num==13){
            return '<img src="./images/color_changer_'.$this->palo.'.png" alt="color_changer_'.$this->palo.'">';
         }
      }

      public function pinta_carta_link(){
         if(in_array($this->num, [0,1,2,3,4,5,6,7,8,9,10,11,12])){
            return '<a href="?palo='.$this->palo.'&num='.$this->num.'"><img src="./images/'.$this->num.'_'.$this->palo.'.png" alt="'.$this->num.'_'.$this->palo.'"></a>';
         }else if($this->num==13){
            return '<a href="?num='.$this->num.'"><img src="./images/color_changer_'.$this->palo.'.png" alt="color_changer_'.$this->palo.'"></a>';
         }
      }

      public function pinta_carta_girada(){
         return '<img src="./images/carta_girada.png" alt="carta_girada">';
      }
   }
?>
