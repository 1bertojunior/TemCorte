<?php

    namespace App\Models;
    use MF\Model\Model;

    class Service extends Model{

        private $id;
        private $name;
        private $duration;

        // Método mágico get
        public function __get($attr){
            return $this->$attr;
        }
        // Método mágico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        // GET
        public function get(){
            $query = "
                SELECT
                    id, name, duration
                FROM
                    service
                WHERE
                    id = :id
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get("id"));
            $stmt->execute();
            
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result;
        }

        // CREATED
        public function created(){
            $sql = "
                INSERT INTO
                    service
                    (name, duration)
                VALUES
                    (:name, :duration)
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':name', $this->__get("name"));
            $stmt->bindValue(':duration', $this->__get("duration"));
            $result = $stmt->execute();
                
            return $result && $stmt->rowCount() > 0;
        }

        // UPDATE
        public function update(){
            $result = 0;
            
            try{
                $sql = "
                    UPDATE service
                        SET
                            name = :name,
                            duration = :duration,
                            modified = NOW()
                        WHERE
                            id = :id
                    ;
                ";
                
                $stmt = $this->db->prepare($sql);
                
                $stmt->bindValue(':id', $this->__get('id'));
                $stmt->bindValue(':name', $this->__get('name'));
                $stmt->bindValue(':duration', $this->__get('duration'));
            
                $stmt->execute();
                $result = 1;

            } catch(PDOException $e) {
                // tratamento do erro
                echo "Erro: " . $e->getMessage();
            }
           
            return $result;

        }

        // DELETE
        public function delete(){
            $query = "
                DELETE
                    FROM
                        service
                WHERE
                    id = :id
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get("id"));
            $stmt->execute();

            return $stmt->rowCount();
        }

        // Serviços
        public function getAll(){
            $query = "SELECT id, name, duration FROM service";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $service = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            return $service;
        }

        public function getPercByUser($client = 0){
            $query = "
                SELECT 
                    fk_service,
                    COUNT(*) * 100 / (SELECT COUNT(*) FROM scheduling WHERE fk_client = :client) AS perc
                FROM scheduling
                WHERE fk_client = :client
                GROUP BY fk_service; 
            ";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':client', $client);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }

        public function getPercByEmployee($client = 0){
            $query = "
                SELECT 
                    fk_service,
                    COUNT(*) * 100 / (SELECT COUNT(*) FROM scheduling WHERE fk_employee = :employee) AS perc
                FROM scheduling
                WHERE fk_employee = :employee
                GROUP BY fk_service; 
            ";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $client);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            //  echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            return $result;
        }

        public function getPercServiceByUser($client = 0){
            $service = $this->getAll();
            $percSer = $this->getPercByUser($client);


            $result = array();

            foreach ($service as $item1) {
                $id = $item1['id'];
                $found = false;
                foreach ($percSer as $item2) {
                    if ($item2['fk_service'] == $id) {
                        $found = true;
                        $perc = $item2['perc'];
                        break;
                    }
                }
                if ($found) {
                    $result[] = array(
                        "id" => $id,
                        "name" => $item1['name'],
                        "duration" => $item1['duration'],
                        "perc" => $perc
                    );
                } else {
                    $result[] = array(
                        "id" => $id,
                        "name" => $item1['name'],
                        "duration" => $item1['duration'],
                        "perc" => 0
                    );
                }
            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return $result;
        }

        public function getPercServiceByEmployee($client = 0){
            $service = $this->getAll();
            $percSer = $this->getPercByEmployee($client);


            $result = array();

            foreach ($service as $item1) {
                $id = $item1['id'];
                $found = false;
                foreach ($percSer as $item2) {
                    if ($item2['fk_service'] == $id) {
                        $found = true;
                        $perc = $item2['perc'];
                        break;
                    }
                }
                if ($found) {
                    $result[] = array(
                        "id" => $id,
                        "name" => $item1['name'],
                        "duration" => $item1['duration'],
                        "perc" => $perc
                    );
                } else {
                    $result[] = array(
                        "id" => $id,
                        "name" => $item1['name'],
                        "duration" => $item1['duration'],
                        "perc" => 0
                    );
                }
            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return $result;
        }

        public function getServiceById(){
            $query = "
                SELECT 
                    s.id, s.name, s.duration
                FROM 
                    service AS s
                WHERE 
                    id = :id;
            ";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return $result;
        }

        // Active services by city, employee and day

    }

?>
        