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


    // Blog Post Query
    $result = $category->read();

    // Get Row Count
    $num = $result->rowCount();

    // Check if any posts 
    if($num > 0) {

        // Post Array
        $cat_arr = array();
        $cat_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $cat_item = array(
                'id' => $id,
                'name' => $name,
            );

            // Push to "data"
            array_push($cat_arr['data'], $cat_item);

        }


        // Turn to JSON & show outpu
        echo json_encode($cat_arr);

    } else {

        // No Posts
        echo json_encode(
            array('message' => 'No Category Found')
        );

    }

