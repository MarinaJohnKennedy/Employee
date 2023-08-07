<?php

use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors=[];
if(! Validator::email($email))
{
    $errors['email']= "Please a provide a valid email address";
}

if(! Validator::string($password,7,255))
{
    $errors['password']= "Please a provide a password of at least 7 characters";
}

if(! empty($errors))
{
    return view('registration/create.view.php',[
        'errors' => $errors
    ]);
}



$user= $db->query('select * from users where email= :email',[
    'email' => $email,
])->find();

if($user)
{
    header('location: /');
}
else 
{
    
    $db->query('INSERT INTO users (email,password) VALUES(:email, :password)',[
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    login([
        'email' => $email
    ]);

    header('location: /');
    exit();
}

