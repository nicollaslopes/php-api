<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once '../config/conexao.php';
    require_once '../models/post.php';

    $objCon = new Conexao();
    $con = $objCon->conectar();
    
    $post = new Post($con);
    
    $result = $post->read();

    $num = $result->rowCount();

    if($num > 0){
        $arrItems = [];

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);

            $post_item = [
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name,
            ];

            array_push($arrItems, $post_item);
        }

    echo json_encode($arrItems);

    } else {
        echo json_encode(['message' => 'Nenhum post encontrado']);
    }
