<?php

/*
* Add Database file
* Database connection
* Tables structure

*/
require_once 'database.php';



// Tables structure

    if (!$conn->query("DESCRIBE emoree__users"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                       username varchar(255) NOT NULL,
                       type varchar(255) NOT NULL";
        if ($conn->createTable("emoree__users", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    }
    
    if (!$conn->query("DESCRIBE school__partners"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                           school varchar(255) NOT NULL";
        if ($connection->createTable("school__partners", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    }
    
    if (!$conn->query("DESCRIBE school__classes"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                           school_id int(11) NOT NULL,
                           level int(11) NOT NULL,
                           section char(1) NOT NULL,
                           foreign key(school_id) references school__partners(id) ";
        if ($connection->createTable("school__classes", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    }
    
    if (!$conn->query("DESCRIBE school__teachers"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            user_id int(11) NOT NULL,
                            class_id int(11) NOT NULL,
                           foreign key(user_id) references  emoree__users (id),
                           foreign key(class_id) references  school__classes (id) ";
        if ($connection->createTable("school__teachers", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    
    }
    
    if (!$conn->query("DESCRIBE school__pupils"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            user_id int(11) NOT NULL,
                            class_id int(11) NOT NULL,
                           foreign key(user_id) references  emoree__users (id),
                           foreign key(class_id) references  school__classes (id) ";
        if ($connection->createTable("school__pupils", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    }
    
   
    
    if (!$conn->query("DESCRIBE reading__tests"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            user_id int(11) NOT NULL,
                            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                            step int(11) NOT NULL,
                            steps_details text DEFAULT NULL,
                            reading_time int(11) NOT NULL,
                           foreign key(user_id) references  emoree__users (id) ";
        if ($connection->createTable("reading__tests", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    }
    
    if (!$conn->query("DESCRIBE reading__texts"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            content mediumtext NOT NULL,
                            titel tinytext	 NOT NULL,
                            words int(11) NOT NULL";
        if ($connection->createTable("reading__texts", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    }
    
    if (!$conn->query("DESCRIBE reading__tasks"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            text_id int(11) NOT NULL,
                            stufe int(11) NOT NULL,
                            content int(11) NOT NULL,
                            answers mediumtext NOT NULL,
                            interaction tinytext NOT NULL,
                           foreign key(text_id) references  reading__texts (id) ";
        if ($connection->createTable("reading__tasks", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    }
    
    if (!$conn->query("DESCRIBE reading__answers"  )) {
        $tableStructure = "id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            user_id int(11) NOT NULL,
                            task_number int(11) NOT NULL,
                            reading_test_id int(11) NOT NULL,
                            correct_answers int(11) NOT NULL,
                            timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                            attempts int(11) NOT NULL,
                            reading_time int(11) NOT NULL,
                            answering_time int(11) NOT NULL,
                           foreign key(user_id) references emoree__users (id),
                           foreign key(task_number) references reading__tasks (id),
                           foreign key(reading_test_id) references reading__tests (id) ";
        if ($connection->createTable("reading__answers", $tableStructure)) {
            echo "Table users created successfully";
        } else {
            echo "Error creating table: " . mysqli_error($connection->conn);
        }
    }

    mysqli_close($conn);