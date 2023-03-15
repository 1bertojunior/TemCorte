<?php

    namespace App\Models;
    use MF\Model\Model;

    class DateTime extends Model{

        private $dateTime;

        // Método mágico get
        public function __get($attr){
            return $this->$attr;
        }
        // Método mágico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function toObj(){
            return strtotime($this->__get('dateTime'));
        }

        public function getDateOnly(){
            return date("Y-m-d", $this->toObj());
        }

        public function getTimeOnly(){
            return date("H:i:s", $this->toObj());
        }


        public function getDate(){
            return date("d/m/Y", $this->toObj());
        }

        public function getTime(){
            return date("H:i", $this->toObj());
        }

        // public function getDate(){
            
        //     return $result;
        // }

    }

?>
        