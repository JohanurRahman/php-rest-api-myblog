<?php 

        // Headers
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
    
        include_once '../../config/Database.php';
        include_once '../../models/Category.php';

        // Instantiate Database & Connect
        $database = new Database();
        $db = $database->connect();


        // Instantiate Blog Post Object
        $category = new Category($db);


        // Get ID
        $category->id = isset($_GET['id']) ? $_GET['id'] : die();

        // Get Post
        $category->read_single();

        // Create Array
        $cat_arr = array(
            'id' => $category->id,
            'name' => $category->name
        );
            
        // Make JSON
        print_r(json_encode($cat_arr));