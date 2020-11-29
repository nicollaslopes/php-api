<?php

    class Conexao{

        private $con;
        private $host = 'localhost';
        private $dbname = 'myblog';
        private $user = 'root';
        private $pass = '';


        public function conectar(){

            try {
                $this->con = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->pass);
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }

            return $this->con;
        }
    }