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

    $post->id = $data->id;
    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;


    if($post->update()){
        echo json_encode([
            'message' => 'Post atualizado'
        ]);
    } else {
        echo json_encode([
            'message' => 'Post não foi atualizado'
        ]);
    }
