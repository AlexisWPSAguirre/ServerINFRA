<?php
    
    class UserSession{
        public function __construct(){
            session_start();
        }

        public function setCurrentUser($user,$pass){
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
        }

        public function getCurrentUser(){
            return $_SESSION['user'];
        }

        public function closeSession(){
            session_unset();
            session_destroy();
        }
    }

?>