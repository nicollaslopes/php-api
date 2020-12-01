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

        public function create(){

            $query = '
                    INSERT INTO ' . $this->table . '
                    SET 
                        title = :title,    
                        body = :body,    
                        author = :author,    
                        category_id = :category_id,        
                    ';

            $stmt = $this->con->prepare($query);

            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':category_id', $this->category_id);
            
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }

        
        }
    }