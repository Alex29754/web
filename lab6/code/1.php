<?php

require_once __DIR__ . '/ApiClient.php';

$api = new ApiClient('https://jsonplaceholder.typicode.com');

// GET
$response = $api->get('/posts');
echo "GET /posts:\n";
print_r(array_slice($response, 0, 1));

// POST
$newPost = $api->post('/posts', [
    'title' => 'Test Title',
    'body' => 'Test Body',
    'userId' => 1
]);
echo "POST /posts:\n";
print_r($newPost);
