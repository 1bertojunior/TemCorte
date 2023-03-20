<?php

    namespace App\Models;
    use MF\Model\Model;
    use MF\Model\Container;

    class TimeActive extends Model{

        private $id;
        private $status;
        private $fk_employee;
        private $fk_time;
        private $fk_city;
        private $fk_day;
        private $type;
        private $start_am;
        private $start_pm;
        private $end_am;
        private $end_pm;


        // Método mágico get
        public function __get($attr){
            return $this->$attr;
        }
        // Método mágico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function get(){
            $day = Container::getModel('day');
            $time = Container::getModel('time');

            $day->__set('id', $this->__get("fk_day"));
            $d = $day->getById();

            $start_am = $this->getFirstTimeActiveAM();
            $end_am = $this->getLastTimeActiveAM();
            
            $start_pm =  $this->getFirstTimeActivePM();
            $end_pm = $this->getLastTimeActivePM();

            $arr_aux = [ 'id' => 0, 'fk_time' => 0 ];

            $result = [
                'id' => $this->__get("fk_day"),
                'name' => $d['name'],
                'initials' => $d['initials'],
                'am' => [
                    'start' => empty( $start_am ) ? $arr_aux : $start_am,
                    'end' =>  empty( $end_am ) ? $arr_aux : $end_am,
                    'time' => $time->getAllAM(),
                ],
                'pm' => [
                    'start' => empty( $start_pm ) ? $arr_aux : $start_pm,
                    'end' =>  empty( $end_pm ) ? $arr_aux : $end_pm,
                    'time' => $time->getAllPM(),
                ],

            ];

            
            return $result;          
        }

        public function getFirstAndLastTimeActiveAM(){
            $start_am = $this->getFirstTimeActiveAM();
            $end_am = $this->getLastTimeActiveAM();

            return [            
                'start' => empty( $start_am ) ? [ 'id' => 0, 'fk_time' => 0 ] : $start_am,
                'end' =>  empty( $end_am ) ? [ 'id' => 0, 'fk_time' => 0 ] : $end_am,
            ];

        }

        public function getFirstAndLastTimeActivePM(){
            $start_pm = $this->getFirstTimeActivePM();
            $end_pm = $this->getLastTimeActivePM();

            return [            
                'start' => empty( $start_pm ) ? [ 'id' => 0, 'fk_time' => 0 ] : $start_pm,
                'end' =>  empty( $end_pm ) ? [ 'id' => 0, 'fk_time' => 0 ] : $end_pm,
            ];

        }

        public function update(){

            $result = 0;
            
            $sql = "
                UPDATE 
                    time_active
                SET
                    status = :status,
                    modified = NOW()
                WHERE
                    fk_employee = :fk_employee
                    AND
                    fk_day = :fk_day
                    AND 
                    fk_time = :fk_time
            ";
                
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status',  $this->__get('status'));
            $stmt->bindValue(':fk_day', $this->__get('fk_day'));
            $stmt->bindValue(':fk_employee', $this->__get('fk_employee'));
            $stmt->bindValue(':fk_time', $this->__get('fk_time'));            
            $stmt->execute();

            // echo "status: " . $this->__get("status") . "<br>";
            // echo "fk_day: " . $this->__get("fk_day") . "<br>";
            // echo "fk_employee: " . $this->__get("fk_employee") . "<br>";
            // echo "fk_time: " . $this->__get("fk_time") . "<br>";
            
            $result = $stmt->rowCount() > 0;

            return $result;

        }

        public function updateAllByDay(){
            $result = 0;
            
            $sql = "
                UPDATE
                    time_active
                SET                
                    status = :status,
                    modified = NOW()
                WHERE
                    fk_day = :fk_day
                    AND
                    fk_employee = :fk_employee
                    AND
                    fk_time >= :start_am
                    AND
                    fk_time <= :end_am

            ";
                
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status',  $this->__get('status') );
            $stmt->bindValue(':fk_day', $this->__get('fk_day') );
            $stmt->bindValue(':fk_employee', $this->__get('fk_employee') );
            $stmt->bindValue(':start_am', $this->__get('start_am'));
            $stmt->bindValue(':end_am', $this->__get('end_am'));
            $stmt->execute();
        
            $result = $stmt->rowCount() > 0;

            return $result;
        }

        public function updateAM(){
            $result = 0;
            
            $sql = "
                UPDATE
                    time_active
                SET                
                    status = :status,
                    modified = NOW()
                WHERE
                    fk_day = :fk_day
                    AND
                    fk_employee = :fk_employee
            ";

            // $aux = ""; 

			// echo "<br>";
            // echo "<br>" . $sql . "<br>";

                
            // $stmt = $this->db->prepare($sql);
            // $stmt->bindValue(':status',  1);
            // $stmt->bindValue(':fk_day', $this->__get('fk_day'));
            // $stmt->bindValue(':fk_employee', $this->__get('fk_employee'));
            // $stmt->execute();
            
            // $result = $stmt->rowCount() > 0;

            echo "result: " . $result;

        }

        // 
        public function getAll(){
            $query = "
                SELECT 
                    id, fk_time, fk_day                   
                FROM
                    time_active
                WHERE
                    fk_employee  = :employee
                ORDER BY
                    fk_day, fk_time
                           
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get("fk_employee"));
            $stmt->execute();

            $result = [];
            $day = Container::getModel('day');
            $time = Container::getModel('time');

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $day->__set("id", $row['fk_day']);
                $time->__set("id", $row['fk_time']);

                $result[$row['id']] = [
                    "id" => $row['id'],
                    "time" => $time->getById(),
                    "day" =>$day->getById()
                ];

                // echo "<pre>";
                // print_r($row);
                // echo "</pre>";

            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }


        public function getAllByDay(){
            
            $sql = "
                SELECT
                    id, fk_time, status
                FROM
                    time_active
                WHERE
                    fk_day = :fk_day                           
                    AND
                    fk_employee  = :fk_employee                                                        
                ;
            ";

            // AND
            // ORDER BY
            // fk_time

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':fk_day', $this->__get("fk_day"));
            $stmt->bindValue(':fk_employee', $this->__get("fk_employee"));
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return is_array($result) ? $result : [];
        }


        public function getFirstTimeActiveAM(){
            $sql = "
                SELECT
                    id, fk_time
                FROM
                    time_active
                WHERE
                    status = :status
                    AND
                    fk_day = :fk_day                           
                    AND
                    fk_employee  = :fk_employee
                    AND 
                    fk_time >= :start_am
                    AND
                    fk_time <= :end_am
                ORDER BY
                    fk_time
                LIMIT 1;
                ;
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status', 1);
            $stmt->bindValue(':fk_day', $this->__get("fk_day"));
            $stmt->bindValue(':fk_employee', $this->__get("fk_employee"));
            $stmt->bindValue(':start_am', 13);
            $stmt->bindValue(':end_am', 25);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return is_array($result) ? $result : [];
        }

        public function getLastTimeActiveAM(){
            $sql = "
                SELECT
                    id, fk_time
                FROM
                    time_active
                WHERE
                    status = :status
                    AND
                    fk_day = :fk_day
                    AND
                    fk_employee  = :fk_employee
                    AND 
                    fk_time >= :start_am
                    AND
                    fk_time <= :end_am
                ORDER BY id DESC
                LIMIT 1
                ;
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status', 1);
            $stmt->bindValue(':fk_day', $this->__get("fk_day"));
            $stmt->bindValue(':fk_employee', $this->__get("fk_employee"));
            $stmt->bindValue(':start_am', 13);
            $stmt->bindValue(':end_am', 25);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return is_array($result) ? $result : [];
        }

        public function getFirstTimeActivePM(){
            $sql = "
                SELECT
                    id, fk_time
                FROM
                    time_active
                WHERE
                    status = :status
                    AND
                    fk_day = :fk_day                           
                    AND
                    fk_employee  = :fk_employee
                    AND 
                    fk_time >= :start_am
                    AND
                    fk_time <= :end_am
                ORDER BY
                    fk_time
                LIMIT 1;
                ;
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status', 1);
            $stmt->bindValue(':fk_day', $this->__get("fk_day"));
            $stmt->bindValue(':fk_employee', $this->__get("fk_employee"));
            $stmt->bindValue(':start_am', 26);
            $stmt->bindValue(':end_am', 45);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return is_array($result) ? $result : [];
        }

        public function getLastTimeActivePM(){
            $sql = "
                SELECT
                    id, fk_time
                FROM
                    time_active
                WHERE
                    status = :status
                    AND
                    fk_day = :fk_day
                    AND
                    fk_employee  = :fk_employee
                    AND 
                    fk_time >= :start_am
                    AND
                    fk_time <= :end_am
                ORDER BY id DESC
                LIMIT 1
                ;
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status', 1);
            $stmt->bindValue(':fk_day', $this->__get("fk_day"));
            $stmt->bindValue(':fk_employee', $this->__get("fk_employee"));
            $stmt->bindValue(':start_am', 25);
            $stmt->bindValue(':end_am', 55);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";

            return is_array($result) ? $result : [];
        }

        public function getAllTimesAM(){
            
            $result = [];
            $hours = $this->getAllByDay();



            return $result;
        }



        // sche

        public function getTimeByDay(){
            // echo "day: ". $this->__get("fk_day");
            
            $sql = "
                SELECT
                    id, fk_time
                FROM
                    time_active
                WHERE
                    status = :status
                    AND
                    fk_day = :fk_day
                ;
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':status', 1);
            // $stmt->bindValue(':fk_day', $this->__get("fk_day"));
            $stmt->bindValue(':fk_day', $this->__get("fk_day") );
            $stmt->execute();


            // $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $result = [];
            // $day = Container::getModel('day');
            $time = Container::getModel('time');

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                // $day->__set("id", $row['fk_day']);
                $time->__set("id", $row['fk_time']);

                array_push( $result,  $time->getById()['time'] );
            }
            

            // return $result;
            return is_array($result) ? $result : [];
        }

    }
?>
        