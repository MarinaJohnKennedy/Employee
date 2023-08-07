<?php
use Core\Validator;
use Core\App;
use Core\Database;

$db= App::resolve(Database::class);
$errors= [];

   
    if(! Validator::string($_POST['body'],1, 200))
    {
        $errors['body'] ='A body of no more than 200 charcaters is required'; 
    }

    if(! empty($errors))
    {
        view("notes/create.view.php",[
            'heading' => 'Create Note',
            'errors' => $errors
            ]);
    }
    
      if(empty($errors))
    {
        $db->query('INSERT INTO notes (body,user_id) VALUES(:body, :user_id)',[
            'body' => $_POST['body'],
            'user_id' => 13
        ]);
        header('location: /notes');
        die();
    }

