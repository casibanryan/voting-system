<?php

 $connection = new mysqli('localhost', 'root', '', 'cpc_votingdb');
 session_start();

    function login($user, $pass) {
        global $connection;
        $query = $connection->prepare("SELECT * FROM student WHERE student_id = ? and surname = ? ");
        $query->bind_param("ss",$user, $pass);
        $query->execute();
        $result = $query->get_result();
        while($row = $result->fetch_array()){
            if($row["type"] == 1) {
                $_SESSION['student_id'] = $row["student_id"];
                $_SESSION['surname'] = $row["surname"];
                $_SESSION['type'] = $row["type"];
                echo 1;
            } else if($row["type"] == 0) {
                $_SESSION['student_id'] = $row["student_id"];
                $_SESSION['surname'] = $row["surname"];
                $_SESSION['type'] = $row["type"];
                echo 2;
            }
            else {
                echo 0;
            }
        }
        $query->close();
        $connection->close();
    }


    function register() {
        global $connection;
        $id = $_POST['id'];
        $surname = $_POST['surname'];
        $query = $connection->prepare("INSERT INTO student (student_id, surname) VALUES (?, ?)");
        $query->bind_param("is", $id, $surname);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }

        $query->close();
        $connection->close();
    }

    function delete_student() {
        global $connection;
        $delete_id = $_POST['delete_id'];
        $queryDelete = "DELETE FROM student WHERE student_id = $delete_id";
        $query = $connection->prepare($queryDelete);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0; 
        }
        $query->close();
        $connection->close();
    }

    function update_student() {
        global $connection;
        $update_id = $_POST['update_id'];
        $update_studentId = $_POST['update_studentId'];
        $update_surname = $_POST['update_surname'];
        $update_type = $_POST['update_type'];
        $queryUpdate = "UPDATE  student SET student_id = '$update_studentId', surname = '$update_surname', type = '$update_type' WHERE id = $update_id";
        $query = $connection->prepare($queryUpdate);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0; 
        }
        $query->close();
        $connection->close();
    }

    function add_category() {
        global $connection;
        $category = $_POST['category'];
        $queryCategory = "INSERT INTO category (title) VALUES (?)";
        $query = $connection->prepare($queryCategory);
        $query->bind_param('s', $category);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function delete_category() {
        global $connection;
        $category_id = $_POST['category_id'];
        $queryDelete = "DELETE FROM category WHERE id = '$category_id'";
        $query = $connection->prepare($queryDelete);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function update_category(){
        global $connection;
        $id = $_POST['category_id'];
        $update_category = $_POST['update_category'];
        $queryUpdate = "UPDATE category SET title = '$update_category' WHERE id = $id";
        $query = $connection->prepare($queryUpdate);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function add_votingList() {
        global $connection;
        $title = $_POST['title'];
        $description = $_POST['description'];
        $query_add = "INSERT INTO voting_list (title, description) VALUES (?, ?)";
        $query = $connection->prepare($query_add);
        $query->bind_param('ss', $title, $description);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function update_votingList() {
        global $connection;
        $voting_listId = $_POST['update_votingList_id'];
        $title = $_POST['update_votingList_title'];
        $description = $_POST['update_votingList_description'];
        $query_update = "UPDATE voting_list SET title = '$title', description = '$description' WHERE id = $voting_listId";
        $query = $connection->prepare($query_update);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function delete_votingList() {
        global $connection;
        $id = $_POST['delete_votingList_id'];
        $queryDelete = "DELETE FROM voting_list WHERE id = $id";
        $query = $connection->prepare($queryDelete);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function on_status() {
        global $connection;
        $id = $_POST['status_id'];
        $queryOff = $connection->prepare("UPDATE voting_list SET status = 0 WHERE status = 1");
        $queryOff->execute();
        $queryOff->close();

        $queryOn = "UPDATE voting_list SET status = 1 WHERE id = $id";
        $query = $connection->prepare($queryOn);
        if($query->execute()) {
            echo 1;
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function add_candidate() {
        global $connection;
        $category_id = $_POST['category'];
        $voting_list_id = $_POST['voting_list_id'];
        $name = $_POST['candidate_name'];
        $course = $_POST['course'];
        $number = $_POST['candidate_number'];
        $address = $_POST['candidate_address'];
        $path = "assets/images/candidate/";
        $filename = "candidate". "-". uniqid();
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $finalname = $filename . '.' . $ext;
        $tmp = $_FILES['image']['tmp_name'];
        $path .= $finalname;
        move_uploaded_file($tmp,$path);
        $image = $finalname;

        $query = $connection->prepare("INSERT INTO candidate(voting_list_id, category_id, image, name, address, course, number) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("iissssi", $voting_list_id, $category_id, $image, $name, $address, $course, $number);
        if($query->execute()){
            echo 1;
        }
        else{
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function delete_candidate() {
        global $connection;
        $id = $_POST['delete_candidate_id'];
        $query = $connection->prepare("DELETE FROM candidate WHERE id = $id");
        if($query->execute()) {
            echo 1;
        }
        else {
            echo $query->error;
        }
        $query->close();
        $connection->close();
    }

    function update_candidate() {
        global $connection;
        $candidate_id = $_POST['candidate_id'];
        $category_id = $_POST['candidateCategory'];
        $voting_list_id = $_POST['update_voting_list_id'];
        $name = $_POST['update_name'];
        $course = $_POST['update_course'];
        $number = $_POST['update_number'];
        $address = $_POST['update_address'];
        $path = "assets/images/candidate/";
        $filename = "candidate". "-". uniqid();
        $ext = pathinfo($_FILES['update_image']['name'], PATHINFO_EXTENSION);
        $finalname = $filename . '.' . $ext;
        $tmp = $_FILES['update_image']['tmp_name'];
        $path .= $finalname;
        move_uploaded_file($tmp,$path);
        $image = $finalname;

        $query = $connection->prepare("UPDATE candidate SET voting_list_id = ?, category_id = ?, image = ?, name = ?, address = ?, course = ?, number = ? WHERE id = ?");
        $query->bind_param("iissssii", $voting_list_id, $category_id, $image, $name, $address, $course, $number, $candidate_id);
        if($query->execute()){
            echo 1;
        }
        else{
            echo 0;
        }
        $query->close();
        $connection->close();
    }

    function vote() {
        global $connection;
        $student_id = $_POST['vote_student_id'];
        $candidate_id = $_POST['vote_candidate_id'];
        $category_id = $_POST['vote_category_id'];
        $queryVote = "INSERT INTO record_vote(student_id, candidate_id, category_id) VALUES (?, ?, ?)";
        $query = $connection->prepare($queryVote);
        $query->bind_param("iii", $student_id, $candidate_id, $category_id);
        if($query->execute()){
           echo 1;  
        }
        else {
            echo 0;
        }
        $query->close();
        $connection->close();
    }

  
?>