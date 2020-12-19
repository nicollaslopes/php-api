<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require_once '../config/conexao.php';
    require_once '../models/post.php';

    $objCon = new Conexao();
    $con = $objCon->conectar();

    $post = new Post($con);

    $data = json_decode(file_get_contents("php://input"));

    $post->id = $data->id;

    if($post->delete()){
        echo json_encode([
            'message' => 'Post deletado'
        ]);
    } else {
        echo json_encode([
            'message' => 'Post não foi deletado'
        ]);
    }
