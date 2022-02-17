<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files'])) {
        $errors = [];
        $path = 'tempMedia/';
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];

        $file_name = $_FILES['files']['name'];
        $file_tmp = $_FILES['files']['tmp_name'];
        $file_type = $_FILES['files']['type'];
        $file_size = $_FILES['files']['size'];
        $file_ext = strtolower(end(explode('.', $_FILES['files']['name'])));

        $file = $path . $file_name;

        if (empty($errors)) {
            move_uploaded_file($file_tmp, $file);
        }
        

        if ($errors) print_r($errors);
    }
}