<?php

require 'config.inc.php';

$comment_id = $_POST['comment_id'];
$response = mysqli_query($connect, "DELETE FROM comment_system WHERE comment_id = $comment_id");

echo true;
?>