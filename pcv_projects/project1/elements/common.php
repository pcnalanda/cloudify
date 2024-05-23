<?php
function executeQuery($sql, $operation = 'SELECT') {
    // Database configuration
    $config = array(
        'master' => array(
            'host' => 'mysql_master_database',
            'port' =>'3306',
            'username' => 'pcv',
            'password' => 'password',
            'database' => 'pcv_test_db'
        ),
        'slave1' => array(
            'host' => 'mysql_slave1_database',
            'port' =>'3306',
            'username' => 'pcv',
            'password' => 'password',
            'database' => 'pcv_test_db'
        ),
        'slave2' => array(
            'host' => 'mysql_slave2_database',
            'port' =>'3306',
            'username' => 'pcv',
            'password' => 'password',
            'database' => 'pcv_test_db'
        )

    );

    // Check if the operation is an insert or update
    $isWriteOperation = (strpos(strtoupper($sql), 'INSERT') !== false || strpos(strtoupper($sql), 'UPDATE') !== false || strpos(strtoupper($sql), 'DELETE') !== false);

    // If it's a write operation or a custom operation, use the master database
    if ($isWriteOperation || strtoupper($operation) === 'WRITE') {
        echo '<div align="center">DATABASE: <b>'.$config['master']['host'] . '</b>.</div><br />';
        $conn = mysqli_connect($config['master']['host'], $config['master']['username'], $config['master']['password'], $config['master']['database'], $config['master']['port']);
    } else {
        // Randomly choose a slave database for read operations
        $slave = array('slave1', 'slave2')[array_rand(array('slave1', 'slave2'))];
        echo '<div align="center">DATABASE: <b>'.$config[$slave]['host'] . '</b>.</div><br />';
        $conn = mysqli_connect($config[$slave]['host'], $config[$slave]['username'], $config[$slave]['password'], $config[$slave]['database'], $config[$slave]['port']);
    }

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Execute SQL query
    $result = mysqli_query($conn, $sql);

    // Check for errors
    if (!$result) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);

    // Return result
    return $result;
}


function showServerIP(){
    echo '<table align="center"><tr><td>Backend SERVER IP:'.$_SERVER['SERVER_ADDR'].'</td><td>Custom SERVER-ID: '.getenv('SERVER_ID').' </td><td><img src="/nginx-proxy.png" width="100"/></td></tr></t/able>';
    echo '<br /><br /><br /><div align="center"><a href="insert-data.php">Add More Record</a> | <a href="member-list.php">Show Member List</a></div><br />';
    return;
}
?>