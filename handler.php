<?php

    require_once('functions.php');

    $method = isset($_POST['method']) ? $_POST['method'] : '';

    switch($method) {
        
        case 'student_login':
            $student_id = $_POST['student_id'];
            $surname = $_POST['surname'];
            login($student_id, $surname);
            break;

        case 'register':
            register();
            break;

        case 'delete_student':
            delete_student();
            break;

        case 'update_student':
            update_student();
            break;

        case 'add_category':
            add_category();
            break;
        
        case 'delete_category':
            delete_category();
            break;

        case 'update_category':
            update_category();
            break;

        case 'add_votingList':
            add_votingList();
            break;

        case 'update_votingList':
            update_votingList();
            break;

        case 'delete_votingList':
            delete_votingList();
            break;

        case 'on_status':
            on_status();
            break;
        
        case 'add_candidate':
            add_candidate();
            break;
        
        case 'delete_candidate':
            delete_candidate();
            break;
        
        case 'update_candidate':
            update_candidate();
            break;
        
        case 'vote':
            vote();
            break;
    }


?>