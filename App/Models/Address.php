<?php

    namespace App\Models;
    use MF\Model\Model;

    use MF\Model\Container;

    class Address extends Model{

        private $id;
        private $street;
        private $neighborhood;
        private $num;
        private $cep;
        private $fk_city;

        // Método mágico get
        public function __get($attr){
            return $this->$attr;
        }
        // Método mágico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function register(){
            $query = "
                INSERT INTO
                    address (street, neighborhood, num, cep, fk_city)
                VALUES
                    (:street, :neighborhood, :num, :cep, :fk_city)
                ;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':street', $this->__get('street'));
            $stmt->bindValue(':neighborhood', $this->__get('neighborhood'));
            $stmt->bindValue(':num', $this->__get('num'));
            $stmt->bindValue(':cep', "64678000");
            $stmt->bindValue(':fk_city', 1);

            $stmt->execute();

            // echo $last_insert_id = $this->db->lastInsertId();

            return $last_insert_id = $this->db->lastInsertId();
        }

        public function update(){

            $query = "
                UPDATE
                    address
                SET
                    street = :street,
                    neighborhood = :neighborhood,
                    num = :num,
                    cep = :cep,
                    fk_city = :fk_city,
                    modified = NOW()
                WHERE
                    id = :id
                ;
            ";

            $stmt = $this->db->prepare($query);

            $stmt->bindValue(':id', $this->__get('id'));        
            $stmt->bindValue(':street', $this->__get('street'));
            $stmt->bindValue(':neighborhood', $this->__get('neighborhood'));
            $stmt->bindValue(':num', $this->__get('num'));
            $stmt->bindValue(':cep', "64678000");
            $stmt->bindValue(':fk_city', 1);
            $stmt->execute();
        }


        public function getFull(){
            $result = $this->get();

            $city = Container::getModel('city');
            $city->__set("id", $this->__get('fk_city'));
            
            // criando cidade
            $result['city'] = $city->getFull();


            // removendo fk_city
            unset($result['fk_city']);
            
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return $result;
        }

        public function get(){
            $query = "
                SELECT
                    a.id, a.street, a.neighborhood, a.num, a.cep, a.fk_city
                FROM
                    address AS a
                WHERE
                    id = :id
            ";
            
            $stmt = $this->db->prepare($query);
            // $stmt->bindValue(':id', $id);
            $stmt->bindValue(':id', $this->__get("id"));
            $stmt->execute();

            // echo "ID: " . $this->__get("id");

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if( !empty($result) ){
                if( isset($result['street']) ) $this->__set("street",$result['street'] );
                if( isset($result['neighborhood']) ) $this->__set("neighborhood", $result['neighborhood'] );
                if( isset($result['num']) ) $this->__set("num",$result['num'] );
                if( isset($result['cep']) ) $this->__set("cep",$result['cep'] );
                if( isset($result['fk_city']) ) $this->__set("fk_city",$result['fk_city'] );
            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return $result;
            // return $this;

        }
    
    
    }

?>
        