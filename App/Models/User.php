<?php

    namespace App\Models;
    use MF\Model\Model;

    use MF\Model\Container;

    class User extends Model{
        private $id;
        private $name;
        private $surname;
        private $email;
        private $cpf;
        private $password;
        private $fk_level;
        private $fk_address;
        private $fk_social;

        public function __get($attr){
            return $this->$attr;
        }

        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function __construct(\PDO $db){
            parent::__construct($db);
            $this->level = 3;
            $this->address = 1;
            $this->social = 1;
        }

        public function init($data = []){
  
            if(!empty($data)){
                if(isset($data['id'])) $this->__set("id",$data['id'] );
                if(isset($data['name'])) $this->__set("name",$data['name'] );
                if(isset($data['surname'])) $this->__set("surname",$data['surname'] );
                if(isset($data['email'])) $this->__set("email",$data['email'] );
                if(isset($data['cpf'])) $this->__set("cpf",$data['cpf'] );
                if(isset($data['password'])) $this->__set("password",$data['password'] );
                if(isset($data['level'])) $this->__set("fk_level", $data['level'] );
                if(isset($data['address'])) $this->__set("fk_address",$data['address'] );
                if(isset($data['social'])) $this->__set("fk_social",$data['social'] );
            }

        }

        public function get(){
            $result = [
                "id" => $this->__get("id"),
                "name" => $this->__get("name"),
                "surname" => $this->__get("surname"),
                "email" => $this->__get("email"),
                "cpf" => $this->__get("cpf"),
                "password" => $this->__get("password"),
                "fk_level" => $this->__get("fk_level"),
                "level" => $this->__get("fk_level"),
                "address" => $this->getAddress(),
                // "address" => [
                    // "fk_address" => $this->__get("fk_address"),
                    // "data" => $this->getAddress()
                // ],
                "social" => $this->getSocial()
                // "social" => [
                //     "fk_social" => $this->__get("fk_social"),
                //     "data" => $this->getSocial()
                // ],
            ];

            return $result;
        }

        // REGISTRE USER
        public function registre(){
            // $query = "INSERT INTO user(name, surname, email, password) VALUES (:name, :surname, :email, :password)";
            $query = "INSERT INTO user (name, surname, email, cpf, password, fk_level, fk_address, fk_social)
            VALUES (:name, :surname, :email, :cpf, :password, :level, :address, :social)";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':name', $this->__get('name'));
            $stmt->bindValue(':surname', $this->__get('surname'));
            $stmt->bindValue(':cpf', preg_replace('/\D/', '', $this->__get('cpf') ) );
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':password', $this->__get('password'));
            $stmt->bindValue(':level', $this->__get('level'));
            $stmt->bindValue(':address', $this->__get('address'));
            $stmt->bindValue(':social', $this->__get('social'));
            $stmt->execute();

            return $this;
        }

        // UPDATE USER
        public function update(){
            $result = 0;
            
            try{
                $sql = "
                    UPDATE user
                        SET
                            name = :name,
                            surname = :surname,
                            email = :email,
                            cpf = :cpf,
                            fk_address = :fk_address,
                            modified = NOW()
                        WHERE
                            id = :id
                    ;
                ";
                
                $stmt = $this->db->prepare($sql);
                
                $stmt->bindValue(':id', $this->__get('id'));
                $stmt->bindValue(':name', $this->__get('name'));
                $stmt->bindValue(':surname', $this->__get('surname'));
                $stmt->bindValue(':cpf', $this->__get('cpf'));
                $stmt->bindValue(':email', $this->__get('email'));
                $stmt->bindValue(':fk_address', $this->__get('fk_address'));
            
                $stmt->execute();
                $result = 1;
                
                // echo "<pre>";
			    // print_r($_SESSION['user']);
			    // echo "</pre>";

                // UPDATE SESSION
                // $user = Container::getModel('User');


            } catch(PDOException $e) {
                // tratamento do erro
                echo "Erro: " . $e->getMessage();
            }
           
            return $result;
        }

        public function getAddress(){
            $address = Container::getModel('address');
            $address->__set("id", $this->__get("fk_address") );

            return $address->getFull();


            // return $address->getOne($this->__get("fk_address"));
            // return 1;
        }
        public function getSocial(){
            $social = Container::getModel('social');
            return $social->getOne($this->__get("fk_social"));
            // return 1;
        }

        //validar se cadastro pode ser feito
        public function checkRegister(){
            $val = true;

            if(strlen($this->__get('name')) < 2 || strlen($this->__get('surname')) < 3) $val = false;
            if(strlen($this->__get('email')) <= 8 &&  !filter_var($this->__get('email'), FILTER_VALIDATE_EMAIL)) $val = false;
            if(strlen($this->__get('password')) < 3) $val = false;
            
            return $val;
        }

        //recupar um usuário por e-mail
        public function getUserByEmail(){
            $query = "SELECT id, name, email FROM user WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        //autenticar usuário
        public function auth(){
            $query = "SELECT id, name, surname, email, cpf, fk_level, fk_address, fk_social FROM user WHERE :email = email AND :password = password ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':password', $this->__get('password'));
            $stmt->execute();

            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if(!empty($user)){
                $this->__set('id', $user['id']);
                $this->__set('name', $user['name']);
                $this->__set('surname', $user['surname']);
                $this->__set('cpf',  preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $user['cpf']) );
                $this->__set('level', $user['fk_level']);
                $this->__set('address', $user['fk_address']);
                $this->__set('social', $user['fk_social']);
            }

            // echo "<pre>";
            // print_r($this);

            return $this;
        }

        //info do user auth
        public function getInfoUser(){
            // $query = "SELECT name, surname FROM users WHERE id = :id_user";

            $query = "
                SELECT
                    id, name, surname, email, cpf, fk_level, fk_address, fk_social
                FROM
                    user
                WHERE
                    id = :id_user
            ";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id_user', $this->__get('id'));
            $stmt->execute();

            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if(!empty($user)){
                $this->__set('id', $user['id']);
                $this->__set('name', $user['name']);
                $this->__set('surname', $user['surname']);
                $this->__set('cpf', $user['cpf']);
                $this->__set('level', $user['fk_level']);
                $this->__set('address', $user['fk_address']);
                $this->__set('social', $user['fk_social']);

                $user_session = [
                    "id" => $this->__get("id"),
                    "name" => $this->__get("name"),
                    "surname" => $this->__get("surname"),
                    "email" => $this->__get("email"),
                    "cpf" =>  preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $this->__get("cpf")),
                    "password" => $this->__get("password"),
                    "level" => $this->__get("level"),
                    "address" => $this->__get("address"),
                    "social" => $this->__get("social"),

                ];

                $_SESSION['user'] = $user_session;

            }            

            return $this;

        }

        // pegar todos os clientes
        public function getAllClients(){
            $query = "
                SELECT 
                    id, name, surname, email, cpf        
                FROM
                    user
                WHERE
                    fk_level  = :level                    
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':level', $this->__get("fk_level"));
            $stmt->execute();
            // $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result[$row['id']] = [
                    'fullname' => $row['name'] . " " . $row['surname'],
                    'email' => $row['email'],
                    'cpf' => $row['cpf']
                ];
                // echo "<pre>";
                // print_r($row);
                // echo "</pre>";
            }
            return $result;
        }

        // GET SCHEDULING BY USER
        public function getScheduling(){
           
            // echo "ok";
        }

    }

?>