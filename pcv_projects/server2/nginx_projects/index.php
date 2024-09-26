<h1>Hello, Welcome to Docker Env with Replica of Cloud Environment</h1>
<h2> This is Secondary Server nginx_Projects Folder </h2>
<?php 
echo '<div>Backend SERVER IP:'.$_SERVER['SERVER_ADDR'].', Custom Server-Id: '.getenv('SERVER_ID').' </div>';
phpinfo();
?>
