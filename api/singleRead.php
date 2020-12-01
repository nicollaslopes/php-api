<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require_once '../config/conexao.php';
    require_once '../models/post.php';

    $objCon = new Conexao();
    $con = $objCon->conectar();

    $post = new Post($con);

    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    $post->readSingle();

    $postArr = [
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    ];

    print_r(json_encode($postArr));