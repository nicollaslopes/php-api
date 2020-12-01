<?php

    class Post{

        private $con;
        private $table = 'posts';

        public $id;
        public $category_id;
        public $title;
        public $body;
        public $author;
        public $category_name;
        public $created_at;

        public function __construct($db)
        {
            $this->con = $db;
        }

        public function read(){

            $query = 'SELECT
                        c.name as category_name,
                        p.id,
                        p.category_id,
                        p.title,
                        p.body,
                        p.author,
                        p.created_at
                    FROM 
                        ' . $this->table . ' p
                    LEFT JOIN
                        categories c ON p.category_id = c.id
                    ORDER BY
                        p.created_at DESC
                    ';

            $stmt = $this->con->prepare($query);

            $stmt->execute();

            return $stmt;   
        }

        public function readSingle(){

            $query = 'SELECT
                        c.name as category_name,
                        p.id,
                        p.category_id,
                        p.title,
                        p.body,
                        p.author,
                        p.created_at
                    FROM 
                        ' . $this->table . ' p
                    LEFT JOIN
                        categories c ON p.category_id = c.id
                    WHERE
                        p.id = ?
                    LIMIT 0,1 
                    ';
            
            $stmt = $this->con->prepare($query);

            $stmt->bindParam(1, $this->id); // pegando o primeiro parâmetro passado na query > "?"

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
            
            

                
        }
    }