#!/bin/bash

# Create the replication user with mysql_native_password
sql_slave_user="CREATE USER 'mydb_slave_user'@'%' IDENTIFIED WITH 'mysql_native_password' BY 'mydb_slave_pwd'; GRANT REPLICATION SLAVE ON *.* TO 'mydb_slave_user'@'%'; FLUSH PRIVILEGES;"
docker exec mysql_master_database sh -c "mysql -u root -pS3cret -e \"$sql_slave_user\""

# Get master status
MS_STATUS=$(docker exec mysql_master_database sh -c 'mysql -u root -pS3cret -e "SHOW MASTER STATUS"')
CURRENT_LOG=$(echo $MS_STATUS | awk '{print $6}')
CURRENT_POS=$(echo $MS_STATUS | awk '{print $7}')

# Function to setup a slave
setup_slave() {
  local slave_container=$1

  # Stop slave if already running
  docker exec $slave_container sh -c "mysql -u root -pS3cret -e 'STOP SLAVE;'"

  # Configure the slave to connect to the master
  sql_set_master="CHANGE MASTER TO MASTER_HOST='mysql_master_database',MASTER_USER='mydb_slave_user',MASTER_PASSWORD='mydb_slave_pwd',MASTER_LOG_FILE='$CURRENT_LOG',MASTER_LOG_POS=$CURRENT_POS, MASTER_DELAY=15; START SLAVE;"
  start_slave_cmd="mysql -u root -pS3cret -e \"$sql_set_master\""
  docker exec $slave_container sh -c "$start_slave_cmd"

  # Show slave status
  docker exec $slave_container sh -c "mysql -u root -pS3cret -e 'SHOW SLAVE STATUS \G'"
}

# Setup Slave 1
setup_slave mysql_slave1_database

# Setup Slave 2
setup_slave mysql_slave2_database
