<?php

    namespace App\Models;
    use MF\Model\Model;

    use MF\Model\Container;

    class city extends Model{

        private $id;
        private $name;
        private $initials;
        private $fk_state;

        // Método mágico get
        public function __get($attr){
            return $this->$attr;
        }
        // Método mágico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function get(){
            $query = "
                SELECT
                    c.id, c.name, c.initials, c.fk_state
                FROM
                    city AS c
                WHERE
                    id = :id
            ";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get("id"));
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if( !empty($result) ){
                if( isset($result['name']) ) $this->__set("name",$result['name'] );
                if( isset($result['initials']) ) $this->__set("initials", $result['initials'] );
                if( isset($result['fk_state']) ) $this->__set("fk_state",$result['fk_state'] );
            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return $result;
        }
        
        public function getFull(){
            $city = $this->get();
            $state = Container::getModel('state');
            $state->__set("id", $city['fk_state']);


            // created state
            $city['state'] = $state->getFull();
            // $city['state'] = [
            //     "id" => $city['fk_state'],
            //     "teste" => $state->getFull()
            // ];

            // delete fk_city
            unset($city['fk_state']);


            // echo "<pre>";
            // print_r($city);
            // echo "</pre>";

            return $city;
        }

        // Cidades
        public function getCities(){
            $query = "SELECT c.id, c.name, c.initials AS city_initials, s.initials AS state_initials FROM city AS c INNER JOIN state AS s ON c.fk_state = s.id";
            //colocar ano dinâmico
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $cities = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $cities[$row['id']] = [
                    "name" => $row['name'],
                    "city_initials" => $row['city_initials'],
                    "state_initials" => $row['state_initials'],

                ];
            }
            
            echo json_encode($cities);
        }

    }

?>
        