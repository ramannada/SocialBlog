<?php

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');

$app->get('/post/add', 'App\Controllers\PostController:getAdd')->setName('post.add');
$app->post('/post/add', 'App\Controllers\PostController:postAdd');

$app->get('/post/list', 'App\Controllers\PostController:getListAdmin')->setName('post.list');

$app->get('/post/{id}/delete', 'App\Controllers\PostController:setSoftdDelete');