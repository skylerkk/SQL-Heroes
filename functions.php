<?php
function start_server(){
  
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "sqlheroes";
    
    // Create connection
    return new mysqli($servername, $username, $password, $dbname);
    
  }
function stop_server($conn){
    $conn->close();
}


function get_all_heroes()
{
  $conn = start_server();
  $data = $conn->query("SELECT * FROM heroes");
  stop_server($conn);
  return $data;
}

function get_names(){
    $conn = start_server();
    $data = $conn->query("SELECT name, id FROM heroes");
    stop_server($conn);
    return $data;
}

function get_powers(){
    $conn = start_server();
    $data = $conn->query("SELECT id, ability FROM abilities");
    stop_server($conn);
    return $data;
}

?>