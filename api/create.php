<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require_once '../config/conexao.php';
    require_once '../models/post.php';

    $objCon = new Conexao();
    $con = $objCon->conectar();

    $post = new Post($con);

    $data = json_decode(file_get_contents("php://input"));

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;


    if($post->create()){
        echo json_encode([
            'message' => 'Post criado'
        ]);
    } else {
        echo json_encode([
            'message' => 'Post não foi criado'
        ]);
    }
