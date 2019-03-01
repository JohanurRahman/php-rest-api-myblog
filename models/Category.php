<?php

    class Category {

        // Database Stuff
        private $conn;
        private $table = 'categories';


        // Post Properties
        public $id;
        public $name;
        public $created_at;

        // Constructor with Database
        public function __construct($db) {
            $this->conn = $db;
        }


        // Get Posts
        public function read() {
            // Create query
            $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute
            $stmt->execute();

            return $stmt;
            
        }

        // Get Single Post
        public function read_single() {

             // Create query
            $query = 'SELECT * FROM ' . $this->table . ' 
            WHERE id = ?
            LIMIT 0,1';


            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->id = $row['id'];
            $this->name = $row['name'];

        }

        // Create Post
        public function create() {

            // Create Query
            $query = 'INSERT INTO ' . $this->table . ' SET name = :name';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));

            // Bind Data
            $stmt->bindParam(':name', $this->name);

            // Execute Query
            if($stmt->execute()) {
                return true;

            } 

            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);

            return false;

        }


        // Update Post
        public function update() {

            // Create Query
            $query = 'UPDATE ' . $this->table . '
                SET
                    name = :name
                WHERE 
                    id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));


            // Bind Data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);

            // Execute Query
            if($stmt->execute()) {
                return true;

            } 

            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);

            return false;

        }


        // Delete Post
        public function delete() {

            // Create Query
            $query = 'DELETE FROM ' . $this->table . '
                WHERE id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Data
            $stmt->bindParam(':id', $this->id);

            // Execute Query
            if($stmt->execute()) {
                return true;

            } 

            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);

            return false;

        }


    }