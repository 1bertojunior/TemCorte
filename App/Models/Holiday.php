<?php

    namespace App\Models;
    use MF\Model\Model;

    class Holiday extends Model{

        private $id;
        private $name;
        private $date;
        private $permanent;
        private $fk_employee;
        private $fk_city;

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
                    id, name, date, permanent
                FROM
                    holiday
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
        public function create(){
            $sql = "
                INSERT INTO
                    holiday
                    (name, date, permanent, fk_employee, fk_city)
                VALUES
                    (:name, :date, :permanent, :fk_employee, :fk_city)
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':name', $this->__get("name"));
            $stmt->bindValue(':date', $this->__get("date"));
            $stmt->bindValue(':permanent', $this->__get("permanent"));
            $stmt->bindValue(':fk_employee', 1);
            $stmt->bindValue(':fk_city', 1);
            $result = $stmt->execute();
                
            return $result && $stmt->rowCount() > 0;
        }

        // UPDATE
        public function update(){
            $result = 0;
            
            try{
                $sql = "
                    UPDATE holiday
                        SET
                            name = :name,
                            date = :date,
                            permanent = :permanent,
                            modified = NOW()
                        WHERE
                            id = :id
                    ;
                ";
                
                $stmt = $this->db->prepare($sql);
                
                $stmt->bindValue(':id', $this->__get('id'));
                $stmt->bindValue(':name', $this->__get('name'));
                $stmt->bindValue(':date', $this->__get('date'));
                $stmt->bindValue(':permanent', $this->__get('permanent'));
            
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
                        holiday
                WHERE
                    id = :id
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get("id"));
            $stmt->execute();

            $result = $stmt->rowCount();
            // echo "Result: " . $result;

            return $result;
        }



        // Serviços
        public function getAll(){
            $query = "SELECT 
                id, name, date, permanent                    
            FROM
                holiday
            WHERE
                -- fk_employee  = :employee
                fk_employee  = :employee AND
                YEAR(date) = YEAR(NOW())
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get("fk_employee"));
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }

        public function getPermanent(){
            $query = "SELECT 
                id, name, date                    
            FROM
                holiday
            WHERE
                -- fk_employee  = :employee
                fk_employee  = :employee AND
                permanent = 1
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get("fk_employee"));
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }

        public function getNext(){
            $query = "
                SELECT 
                    id, name, date, permanent                    
                FROM
                    holiday
                WHERE
                    fk_employee  = :employee
                    AND
                    date BETWEEN CURRENT_DATE AND CURRENT_DATE + INTERVAL 7 DAY
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get("fk_employee"));
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }


        public function getPercByUser($client = 0){
            $query = "
                SELECT 
                    id, name, date, permanent                    
                FROM
                    scheduling
                WHERE
                    fk_client = :client        
            ";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':client', $client);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

        // 
        public function getAllFormated(){
            $this->__set("fk_employee", 1);
            $result = $this->getAll();

          

			if(is_array($result) ){
            	// print_r($result);
				$days = array();
				for ($i = 0; $i < count($result); $i++) {
					array_push($days, $result[$i]["date"]);
				}

				$result= $days;

			}

            return $result;

        }

    }

?>
        