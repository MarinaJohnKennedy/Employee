<?php 

use Core\App;
use Core\Database;

$db= App::resolve(Database::class);


$currentUserId= $_SESSION['user']['id'];

$notes=$db->query("select * from notes where user_id = :userid", ['userid' => $currentUserId ] )->get();


view("notes/index.view.php",[
    'heading' => 'My Notes',
    'notes' => $notes
    ]);

 
?>





