<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "todolist";
$conn       = new mysqli($servername, $username, $password, $dbname);


if ($_GET) {
    if ($_GET['function'] == 'getData')
        getData();
    if ($_GET['function'] == 'addTask')
        addTask();
    if ($_GET['function'] == 'deleteTask')
        deleteTask($_GET['id']);
}

function getData()
{
    $sql    = "SELECT * FROM `todolist`";
    $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
        $resp = '[';
        while ($row = $result->fetch_assoc()) {
            $resp .= '{"id" : ' . '"' . $row['id'] . '",';
            $resp .= '"is_done" : ' . '"' . $row['is_done'] . '",';
            $resp .= '"task" : ' . '"' . $row['task'] . '"},';
        }
        $resp .= ']';
        $resp = str_replace(',]', ']', $resp);
        echo $resp;
    }
}

function addTask()
{
    $is_done = $_POST['is_done'];
    $task    = $_POST['task'];
    
    
    $sql    = "INSERT INTO `todolist` (`id`, `is_done`, `task`) VALUES (NULL, '" . false . "', '" . $task . "');";
    $result = $GLOBALS['conn']->query($sql);
}
function deleteTask($id)
{
    $sql   = "DELETE FROM `todolist` WHERE `id` = " . $id . "";
    $resul = $GLOBALS['conn']->query($sql);
}