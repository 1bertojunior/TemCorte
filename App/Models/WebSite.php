<?php

    namespace App\Models;
    use MF\Model\Model;

    class website extends Model{

        private $id;
        private $name;
        private $description;
        private $address;
        private $social;

        // Método mágico get
        public function __get($attr){
            return $this->$attr;
        }
        // Método mágico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function update(){
            $sql = "
                UPDATE
                    website
                SET
                    name = :name,
                    description = :description,
                    email = :email,
                    phone = :phone,
                    modified = NOW()
                WHERE
                    id = :id
                ;
            ";
                
            $stmt = $this->db->prepare($sql);
                
            $stmt->bindValue(':id', 1);
            $stmt->bindValue(':name', $this->__get('name'));
            $stmt->bindValue(':description', $this->__get('description'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':phone', $this->__get('phone'));
            $stmt->execute();

            $result = $stmt->rowCount() > 0;
    
            return $result;
        }

        public function getData(){
            $query = "SELECT w.name, w.description, w.email, w.phone FROM website AS w;";

            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
  
            // $result['phone_mask'] = $this->maskPhone($result['phone']);
            $result['phone_mask'] = $this->Mask('(##) #####-####', substr($result['phone'],3));
            // echo "<pre>";
            // print_r($result);

            return $result;
        }

        public function getAddress(){
            $query = "
                SELECT a.street, a.neighborhood, a.num, c.name AS city, st.name AS state, st.initials AS initials_state
                FROM website AS w
                INNER JOIN address AS a ON (w.fk_address = a.id)
                    INNER JOIN city AS c ON (a.fk_city = c.id)
                        INNER JOIN state AS st ON (c.fk_state = st.id)
            ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
           
            return $result;
        }

        public function getSocial(){
            $query = "
                SELECT so.facebook, so.instagram, so.whatsapp
                FROM website AS w INNER JOIN social AS so ON (w.fk_social = so.id)
            ";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result;
        }


        function Mask($mask,$str){
            $str = str_replace(" ","",$str);
        
            for($i=0;$i<strlen($str);$i++){
                $mask[strpos($mask,"#")] = $str[$i];
            }
        
            return $mask;
        }

    }

?>
        