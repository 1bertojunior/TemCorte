<?php

    namespace App\Models;
    use MF\Model\Model;
    use MF\Model\Container;

    class scheduling extends Model{

        private $id;
        private $name;
        private $surname;
        private $phone;
        private $email;
        private $start;
        private $end;
        private $created;
        private $modified;
        private $fk_service;
        private $fk_client;
        private $fk_employee;
        private $fk_city;

        //metodo mafico get
        public function __get($attr){
            return $this->$attr;
        }
        //metodos mafico set
        public function __set($attr, $value){
            $this->$attr = $value;
        }

        public function get(){
            $query = "
                SELECT
                    id, start, end, fk_service, fk_client, fk_employee, fk_city
                FROM
                    scheduling
                WHERE
                    id = :id
            ";

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $this->__get("id"));
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if( isset($result['id']) ){
                // echo "teste";
                $service = Container::getModel('service');
                $sdatetime = Container::getModel('dateTime');

                $service->__set("id", $result['fk_service']);
                $serv = $service->getServiceById();

                $sdatetime->__set("dateTime", $result['start']);
                $edatetime = Container::getModel('dateTime');
                $edatetime->__set("dateTime", $result['end']);
                
                
                $sche = [
                    "id" => $result['id'],
                    "date" => $sdatetime->getDate(),
                    "time_start" => $sdatetime->getTime(),
                    "time_end" => $edatetime->getTime(),
                    "start" => $result['start'],
                    "end" => $result['end'],
                    'service' =>  $serv
                ];

                $result = $sche;

            }

            return $result;

        }

        // All
        public function getAll(){
            echo "Teste All";
        }

        public function delete(){
            $query = "
                DELETE
                    FROM
                        scheduling
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

        // Agendamento hoje por cliente
        public function getSchedulingDayByClient(){
            $today = date('Y-m-d');
            // echo "today: " . $today;
            // $today = '2023-01-25';

            $query = "
                SELECT COUNT(*) AS result
                FROM scheduling
                WHERE
                    fk_client = :client AND
                    DATE(start) = :today

            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':client', $this->__get("fk_client"));
            $stmt->bindValue(':today', $today);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "teste: " . $this->__get("fk_client");

            // print_r($result);
            return $result['result'];

        }

        // Agendamento no mês por cliente

        // Agendamento hoje por cliente
        public function getSchedulingByMonthByClient(){
            $year = Date('Y');
            $month = Date('n');

            // echo "Year: " . $year . " - Month: " . $month;
            // echo "<br>";

            $query = "
                SELECT COUNT(*) AS result
                FROM scheduling
                WHERE
                    fk_client = :client AND 
                    MONTH(start) = :month AND
                    YEAR(start) = :year
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':client', $this->__get("fk_client"));
            $stmt->bindValue(':year', $year);
            $stmt->bindValue(':month', $month);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "teste: " . $this->__get("fk_client");

            // print_r($result);
            return $result['result'];

        }

        // Pegar procetagem de cada serviço por cliente
        public function getPercServiceByUser(){
            $query = "
                SELECT 
                    fk_service,
                    COUNT(*) * 100 / (SELECT COUNT(*) FROM scheduling WHERE fk_client = :client) AS percentual
                FROM scheduling
                WHERE fk_client = :client
                GROUP BY fk_service; 
            ";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':client', $this->__get("fk_client"));
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "result: " . $result['result'];

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            return $result;
        }
        
        public function getNextByUser(){ // getOneByUser
            $service = Container::getModel('service');
            
            $result = [];

            $query = "
                SELECT
                    s.id, s.start, s.end, s.fk_service, s.fk_employee, s.fk_city, NOW() AS now
                FROM 
                    scheduling AS s
                WHERE
                    s.fk_client = :client AND
                    s.start >= NOW()
            ";

            // echo date("m/d/Y H:i:s");

            // echo $this->__get('fk_client');

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':client', $this->__get('fk_client'));
            // $stmt->bindValue(':now', date("m/d/Y H:i:s"));
            $stmt->execute();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $service->__set("id", $row['fk_service']);
                $serv = $service->getServiceById();
                
                $sdatetime = Container::getModel('dateTime');
                $sdatetime->__set("dateTime", $row['start']);
                $edatetime = Container::getModel('dateTime');
                $edatetime->__set("dateTime", $row['end']);
                // echo "teste: " . $datetime->getDate();
                // echo "datetime: " . $datetime->__get("dateTime");
                // print_r($datetime);

                $result[$row['id']] = [
                    "date" => $sdatetime->getDate(),
                    "time_start" => $sdatetime->getTime(),
                    "time_end" => $edatetime->getTime(),

                    "start" => $row['start'],
                    "end" => $row['end'],
                    'service' =>  $serv
                    // "fk_service" => $row['fk_service'],
                    // "fk_employee" => $row['fk_employee'],
                    // "fk_city" => $row['fk_city'],
                ];

                // echo "<pre>";
                // print_r($result);
                // echo "</pre>";

            }
            
            return $result;
        }

        public function getLatestByUser(){ // getOneByUser
            $service = Container::getModel('service');
            
            $result = [];

            $query = "
                SELECT
                    s.id, s.start, s.end, s.fk_service, s.fk_employee, s.fk_city, NOW() AS now
                FROM 
                    scheduling AS s
                WHERE
                    s.fk_client = :client AND
                    s.start <= NOW()
            ";

            // echo date("m/d/Y H:i:s");

            // echo $this->__get('fk_client');

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':client', $this->__get('fk_client'));
            // $stmt->bindValue(':now', date("m/d/Y H:i:s"));
            $stmt->execute();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $service->__set("id", $row['fk_service']);
                $serv = $service->getServiceById();
                
                $sdatetime = Container::getModel('dateTime');
                $sdatetime->__set("dateTime", $row['start']);
                $edatetime = Container::getModel('dateTime');
                $edatetime->__set("dateTime", $row['end']);
                // echo "teste: " . $datetime->getDate();
                // echo "datetime: " . $datetime->__get("dateTime");
                // print_r($datetime);

                $result[$row['id']] = [
                    "date" => $sdatetime->getDate(),
                    "time_start" => $sdatetime->getTime(),
                    "time_end" => $edatetime->getTime(),

                    "start" => $row['start'],
                    "end" => $row['end'],
                    'service' =>  $serv
                    // "fk_service" => $row['fk_service'],
                    // "fk_employee" => $row['fk_employee'],
                    // "fk_city" => $row['fk_city'],
                ];

            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }


        // Funcionário

        // Agendamento hoje por cliente
        public function getSchedulingDayByEmployee(){
            $today = date('Y-m-d');
            // echo "today: " . $today;
            // $today = '2023-01-25';

            $query = "
                SELECT COUNT(*) AS result
                FROM scheduling
                WHERE
                    fk_employee = :employee AND
                    DATE(start) = :today

            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get("fk_employee"));
            $stmt->bindValue(':today', $today);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "teste: " . $this->__get("fk_client");

            // print_r($result);
            return $result['result'];

        }

        public function getSchedulingByMonthByEmployee(){
            $year = Date('Y');
            $month = Date('n');

            // echo "Year: " . $year . " - Month: " . $month;
            // echo "<br>";

            $query = "
                SELECT COUNT(*) AS result
                FROM scheduling
                WHERE
                    fk_employee = :employee AND 
                    MONTH(start) = :month AND
                    YEAR(start) = :year
            ";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get("fk_employee"));
            $stmt->bindValue(':year', $year);
            $stmt->bindValue(':month', $month);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            // echo "teste: " . $this->__get("fk_client");

            // print_r($result);
            return $result['result'];

        }

        public function getPercServiceByEmployee(){
            $query = "
                SELECT 
                    fk_service,
                    COUNT(*) * 100 / (SELECT COUNT(*) FROM scheduling WHERE fk_client = :client) AS percentual
                FROM scheduling
                WHERE fk_employee = :employee
                GROUP BY fk_service; 
            ";
        
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get("fk_employee"));
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // echo "result: " . $result['result'];

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            return $result;
        }

        public function getTodayEmployee(){ // getOneByUser
            $service = Container::getModel('service');
            
            $result = [];

            $query = "
                SELECT
                    s.id, s.start, s.end, s.fk_service, s.fk_employee, s.fk_city, NOW() AS now
                FROM 
                    scheduling AS s
                WHERE
                    s.fk_employee = :employee AND
                    DATE(s.start) = CURDATE();
        
            ";

            // echo $this->__get('fk_employee');

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get('fk_employee'));
            // $stmt->bindValue(':now', date("m/d/Y H:i:s"));
            $stmt->execute();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $service->__set("id", $row['fk_service']);
                $serv = $service->getServiceById();
                
                $sdatetime = Container::getModel('dateTime');
                $sdatetime->__set("dateTime", $row['start']);
                $edatetime = Container::getModel('dateTime');
                $edatetime->__set("dateTime", $row['end']);
                // echo "teste: " . $datetime->getDate();
                // echo "datetime: " . $datetime->__get("dateTime");
                // print_r($datetime);

                $result[$row['id']] = [
                    "date" => $sdatetime->getDate(),
                    "time_start" => $sdatetime->getTime(),
                    "time_end" => $edatetime->getTime(),

                    "start" => $row['start'],
                    "end" => $row['end'],
                    'service' =>  $serv
                    // "fk_service" => $row['fk_service'],
                    // "fk_employee" => $row['fk_employee'],
                    // "fk_city" => $row['fk_city'],
                ];                
            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }

        public function getNext7DaysByEmployee(){ // getOneByUser
            $service = Container::getModel('service');
            
            $result = [];

            $query = "
                SELECT
                    s.id, s.start, s.end, s.fk_service, s.fk_employee, s.fk_city, NOW() AS now
                FROM 
                    scheduling AS s
                WHERE
                    s.fk_employee = :employee
                    AND
                    s.start >= NOW() 
                    AND
                    s.start < DATE_ADD(NOW(), INTERVAL 7 DAY);
        
            ";

            // echo $this->__get('fk_employee');

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get('fk_employee'));
            // $stmt->bindValue(':now', date("m/d/Y H:i:s"));
            $stmt->execute();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $service->__set("id", $row['fk_service']);
                $serv = $service->getServiceById();
                
                $sdatetime = Container::getModel('dateTime');
                $sdatetime->__set("dateTime", $row['start']);
                $edatetime = Container::getModel('dateTime');
                $edatetime->__set("dateTime", $row['end']);
                // echo "teste: " . $datetime->getDate();
                // echo "datetime: " . $datetime->__get("dateTime");
                // print_r($datetime);

                $result[$row['id']] = [
                    "date" => $sdatetime->getDate(),
                    "time_start" => $sdatetime->getTime(),
                    "time_end" => $edatetime->getTime(),

                    "start" => $row['start'],
                    "end" => $row['end'],
                    'service' =>  $serv
                    // "fk_service" => $row['fk_service'],
                    // "fk_employee" => $row['fk_employee'],
                    // "fk_city" => $row['fk_city'],
                ];                
            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }

        public function getMonthByEmployee(){ // getOneByUser
            $service = Container::getModel('service');
            
            $result = [];

            $query = "
                SELECT
                    s.id, s.start, s.end, s.fk_service, s.fk_employee, s.fk_city, NOW() AS now
                FROM 
                    scheduling AS s
                WHERE
                    s.fk_employee = :employee
                    AND
                    s.start >= NOW() 
                    AND
                    MONTH(s.start) = MONTH(NOW())
            ";

            // s.start < DATE_ADD(NOW(), INTERVAL 40 DAY);

            // echo $this->__get('fk_employee');

            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':employee', $this->__get('fk_employee'));
            // $stmt->bindValue(':now', date("m/d/Y H:i:s"));
            $stmt->execute();

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $service->__set("id", $row['fk_service']);
                $serv = $service->getServiceById();
                
                $sdatetime = Container::getModel('dateTime');
                $sdatetime->__set("dateTime", $row['start']);
                $edatetime = Container::getModel('dateTime');
                $edatetime->__set("dateTime", $row['end']);
                // echo "teste: " . $datetime->getDate();
                // echo "datetime: " . $datetime->__get("dateTime");
                // print_r($datetime);

                $result[$row['id']] = [
                    "date" => $sdatetime->getDate(),
                    "time_start" => $sdatetime->getTime(),
                    "time_end" => $edatetime->getTime(),

                    "start" => $row['start'],
                    "end" => $row['end'],
                    'service' =>  $serv
                    // "fk_service" => $row['fk_service'],
                    // "fk_employee" => $row['fk_employee'],
                    // "fk_city" => $row['fk_city'],
                ];                
            }

            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            
            return $result;
        }









        // Cidades
        public function getCities(){
            $query = "SELECT c.id, c.name, c.initials AS city_initials, s.initials AS state_initials FROM city AS c INNER JOIN state AS s ON c.fk_state = s.id";
            //colocar ano dinâmico
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $result = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result[$row['id']] = [
                    "name" => $row['name'],
                    "city_initials" => $row['city_initials'],
                    "state_initials" => $row['state_initials'],

                ];
            }
            
            echo json_encode($result);
        }

        // Serviço 
        public function getService(){
            $query = "SELECT id, name, time FROM service";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $result = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result[$row['id']] = [
                    "name" => $row['name'],
                    "time" => $row['time']
                ];
            }
            
            echo json_encode($result);
        }

        // Serviço 
        public function getDayByBityAndEmployee($city = 0, $employee = 0){
            // echo 'City: ' .$city. ' - Employee: ' .$employee. '<br>';

            // $query = "SELECT d.id, d.name FROM day_active AS da INNER JOIN day AS d ON da.fk_day = d.id WHERE da.fk_city = 1 AND da.fk_employee = 1";
            // $stmt = $this->db->prepare($query);
            // $stmt->execute();

            $query = "SELECT d.id, d.name FROM day_active AS da INNER JOIN day AS d ON da.fk_day = d.id WHERE da.fk_city = :city AND da.fk_employee = :employee";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':city', $city);
            $stmt->bindValue(':employee', $employee);
            $stmt->execute();

            $result = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result[$row['id']] = [
                    "id" => $row['id'],
                    "name" => $row['name']
                ];
            }
            
            echo json_encode($result);
        }


        public function allTimes(){
            $query = "SELECT id, name, value FROM time";
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            $result = [];

            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $result[$row['id']] = [
                    "name" => $row['name'],
                    "value" => $row['value'],
                ];
            }
            
            echo json_encode($result);
        }


        
    }

?>
        