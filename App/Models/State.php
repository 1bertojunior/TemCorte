<?php

    namespace App\Models;
    use MF\Model\Model;

    class State extends Model{

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

        // Cidades
        public function get(){
            $query = "
                SELECT
                    s.id, s.name, s.initials
                FROM
                    state AS s
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

        public function getFull(){
            $state = $this->get();

            return $state;

            echo "<pre>";
            print_r($state);
            echo "</pre>";
        }

    }

?>
        