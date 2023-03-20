<?php

    namespace App\Controllers;

    //os recursos do miniframework
    use MF\Controller\Action;
    use MF\Model\Container;

    class AuthController extends Action {

        public function authenticate(){
            $user = Container::getModel('User');
            
            $user->__set('email', $_POST['email']);
            $user->__set('password', md5($_POST['password']));

            $user->auth();  
            
            if(@$user->__get("id") && $user->__get('name') && $user->__get('surname')){
                session_start();
                $user_session = [
                    "id" => $user->__get("id"),
                    "name" => $user->__get("name"),
                    "surname" => $user->__get("surname"),
                    "email" => $user->__get("email"),
                    "cpf" => $user->__get("cpf"),
                    "password" => $user->__get("password"),
                    "level" => $user->__get("level"),
                    "address" => $user->__get("address"),
                    "social" => $user->__get("social"),
                ];

                $_SESSION['user'] = $user_session;

                // print_r($_GET);;
        
                header('Location: /admin');
                // echo "autenticou com sucesso!";
                
            }else{
                header('Location: /login?login=erro');
            }

        }

        public function checkRegister(){
            $result = "null";
            // $result = "null";

            $user = Container::getModel('User');
            
            $user->__set('name', $_POST['name']);
            $user->__set('surname', $_POST['surname']);
            $user->__set('cpf', $_POST['cpf']);
            $user->__set('email', $_POST['email']);
            // $user->__set('email', "");
            $user->__set('password', md5($_POST['password']));

            if(!$user->getUserByEmail()){
                if( $user->checkRegister()){
                    if($user->registre()){
                        #echo "Sucesso ao registrar";
                        // header('Location: /login');
                        $result = "/login";
                    }else $result = "/register?register=erro"; 
                    // echo "Erro ao registrar!";
                }else $result = "/register?register=erro1";
                // echo "Erro com dados";
            }else $result = "/register?register=erro2";
            // echo "E-mail já cadastrdo";

            header('Location:'. $result);
        }

    }


?>