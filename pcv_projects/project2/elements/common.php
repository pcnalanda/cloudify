<?php
function showServerIP(){
    echo '<div>Backend SERVER IP:'.$_SERVER['SERVER_ADDR'].', Custom SERVER-ID: '.getenv('SERVER_ID').' </div>';
    echo '<br /><br /><br /><div align="center"><a href="insert-data.php">Add More Record</a> | <a href="member-list.php">Show Member List</a> | <a href="http://localhost:8080/project2/"  target="_blank">Project 2</a> | <a href="http://localhost:8080/nodejs/" target="_blank">Node JS App</a> | <a href="http://localhost:8084/springboot" target="_blank">Java Spring boot</a></div><br />';
    echo "\n".'<br /><div align="center"><img src="/nginx-proxy.png" /></div><br />';
    return;
}
?>