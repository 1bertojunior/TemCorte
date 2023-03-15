<?php

    namespace App\Models;
    use MF\Model\Model;

    class Day extends Model{

        private $id;
        private $name;
        private $initials;

        // Método mágico get
        public function __get($attr){
            return $this->$attr;
        }
        // Método mágico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function getById(){
            $query = "
                SELECT 
                   name, initials                   
                FROM
                    day
                WHERE
                    id = :id        
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get("id"));
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result; 
        }

        public function getAll(){
            $query = "
                SELECT 
                    id, name, initials                   
                FROM
                    day     
            ";

            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // print_r($result);

            return $result;
        }

        public function toStr(){
            // $str = $this->getById();
            // return $str;
        }

    }
?>
        