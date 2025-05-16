<?php

require_once __DIR__ . '/ApiClient.php';

$api = new ApiClient('https://jsonplaceholder.typicode.com');

// PUT
$updated = $api->put('/posts/1', [
    'id' => 1,
    'title' => 'Updated Title',
    'body' => 'Updated Body',
    'userId' => 1
]);
echo "PUT /posts/1:\n";
print_r($updated);

// DELETE
$deleted = $api->delete('/posts/1');
echo "DELETE /posts/1:\n";
print_r($deleted);
