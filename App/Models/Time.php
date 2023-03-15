<?php

    namespace App\Models;
    use MF\Model\Model;

    class Time extends Model{

        private $id;
        private $name;

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
                   time                   
                FROM
                    time
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
            $sql = "
                SELECT
                    id, time
                FROM
                    time
                ORDER BY
                    time
            ";


            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return is_array($result) ? $result : [];
        }

        public function getAllAM(){
            $sql = "
                SELECT
                    id, time
                FROM
                    time
                WHERE
                    time >= '07:00:00'
                    AND
                    time <= '12:00:00'
                ORDER BY
                    time
            ";


            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return is_array($result) ? $result : [];
        }


        public function getAllPM(){
            $sql = "
                SELECT
                    id, time
                FROM
                    time
                WHERE
                    time >= '12:30:00'
                    AND
                    time <= '22:00:00'
                ORDER BY
                    time
            ";


            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return is_array($result) ? $result : [];
        }



    }
?>
        