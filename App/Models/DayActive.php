<?php

    namespace App\Models;
    use MF\Model\Model;
    use MF\Model\Container;

    class DayActive extends Model{

        private $id;
        private $status;
        private $fk_employee;
        private $fk_day;
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
            $day = Container::getModel('day');
            // $allDays = $day->getAll();
            
            $result = [];

            $query = "
                SELECT 
                    id, fk_day, status                   
                FROM
                    day_active
                WHERE
                    fk_day = :fk_day                           
                    AND
                    fk_employee  = :fk_employee 
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':fk_day', $this->__get("fk_day"));
            $stmt->bindValue(':fk_employee', $this->__get("fk_employee"));
            $stmt->execute();

            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";

            if( is_array($row) ){
                $day->__set('id', $row['fk_day']);
                $d = $day->getById();

                $result = [
                    'id' => $row['id'],
                    'name' => $d['name'],
                    'initials' => $d['initials'],
                    'status' => $row['status']
                ];
            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

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
            
            $sql = "
                UPDATE
                    day_active
                SET                
                    status = :status,
                    modified = NOW()
                WHERE
                    id = :id
                ;
            ";
                
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindValue(':id', $this->__get('id'));
            $stmt->bindValue(':status', $this->__get('status'));
            $stmt->execute();
            
            $result = $stmt->rowCount() > 0;

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

        // 
        // public function getAll(){
        //     $query = "
        //         SELECT 
        //             id, fk_day                   
        //         FROM
        //             day_active
        //         WHERE
        //             fk_employee  = :employee        
        //     ";
        //     $stmt = $this->db->prepare($query);
        //     $stmt->bindValue(':employee', $this->__get("fk_employee"));
        //     $stmt->execute();

        //     $result = [];
        //     $day = Container::getModel('day');

        //     while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
        //         $day->__set("id", $row['fk_day']);

        //         $result[$row['id']] = [
        //             "id" => $row['id'],
        //             "day" =>$day->getById()
        //         ];

        //     }

        //     // echo "<pre>";
        //     // print_r($result);
        //     // echo "</pre>";
            
        //     return $result;
        // }

        // Serviços
        public function getAll(){
            
            $day = Container::getModel('day');
            // $allDays = $day->getAll();
            
            $result = [];

            $query = "
                SELECT 
                    id, status, fk_day
                FROM
                    day_active
                WHERE
                    fk_employee  = :fk_employee        
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':fk_employee', $this->__get("fk_employee"));
            $stmt->execute();

            while( $row = $stmt->fetch(\PDO::FETCH_ASSOC) ){
                $day->__set('id', $row['fk_day']);
                $d = $day->getById();

                $result[ $row['id'] ]= [
                    'name' => $d['name'],
                    'initials' => $d['initials'],
                    'status' => $row['status']
                ];

                
            }
            
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            // $daysActive = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($daysActive);
            // echo "</pre>";

            // foreach($allDays as $i => $day) {
            //     $result[$i] = [
            //         'name' => $day['name'],
            //         'active' => false
            //     ];
                
            //     foreach($daysActive as $day_active) {
                    
            //         if($day_active['fk_day'] == $day['id']) {
            //             $result[$i]['active'] = true; 
            //             break;
            //         }
            //     }
            // }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }

    }
?>
        