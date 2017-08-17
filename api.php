<?php

include "functions/sanitizeInputs.php";
include "functions/sql.php";

function newPost($db) {
    $userId = newUser($db);
    if (!$userId) return "User error " + $userId;
    $query = "insert into Posts (userId, Title, Content, DateCreated) values ('$userId', '$_POST[title]', '$_POST[content]', now())";
    $result = mysqli_query($db, $query);

    
    return $result ? $db->insert_id : mysqli_error($db);
}
function newComment($db) {
    $userId = newUser($db);
    if (!$userId) return "User error " + $userId;
    $query = "insert into Comments (userId, postId, Content, DateCreated) values ('$userId', '$_POST[postId]', '$_POST[content]', now())";
    $result = mysqli_query($db, $query);
    
    return $result ? $db->insert_id : mysqli_error($db);
}
function newUser($db) {
    $query = "insert into Users (userWho, userWhere, DateCreated) values ('$_POST[userWho]', '$_POST[userWhere]', now())";
    $result = mysqli_query($db, $query);
    
    return $result ? $db->insert_id : mysqli_error($db);
}
function getUser($db) {
    //"SELECT * FROM users WHERE user='{$_POST[postId]}' AND password='{$_POST[userId]}'";
}
$result = null;

switch ($_POST["query"]) {
    case "newPost":
        $result = newPost($db);
        if ($result)  header("Location: /?id=$result");
        break;
    case "newComment":
        $result = newComment($db);
        if ($result) header("Location: ".$_SERVER['HTTP_REFERER']);
        break;
    case "getPosts":
        
        break;
    case "getComments":
        
        break;
    default:
        break;
}
echo $result;
if ($result) {
    header("HTTP 1.1 / 200 OK");
}
else {
    echo "error";
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
}
mysqli_close($db);

?>