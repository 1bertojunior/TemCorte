<?php

    namespace App\Models;
    use MF\Model\Model;

    class Social extends Model{

        private $id;
        private $facebook;
        private $instagram;
        private $whatsapp;

        // Método mágico get
        public function __get($attr){
            return $this->$attr;
        }
        // Método mágico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function getOne($id = 0){
            // echo "ID: " . $id;
            $query = "
                SELECT
                    s.facebook, s.instagram, s.whatsapp
                FROM
                    social AS s
                WHERE
                    id = :id
            ";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            return $result;

        }
    
    
    }

?>
        