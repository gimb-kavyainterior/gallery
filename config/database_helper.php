<?php

####################### MODULE: DATABASE HELPER MODULE #######################
# 1. DATABASE CONNECTIVITY METHOD
# 2. DATABASE CONNECTION CLOSE METHOD
# 3. INSERT INTO TABLE METHOD
# 4. GET DATA FROM TABLE METHOD
# 5. UPDATE DATA FROM TABLE METHOD
# 6. DELETE DATA FROM TABLE METHOD
##############################################################################


############### 1. DATABASE CONNECTIVITY METHOD ###############
# DESCRIPTION: 
#       Method to establish the MySQL database connectivity
# 
# PARAMETERS: None
#
# RETURN VALUES:
#       mysqli connection object
function establish_connection(): mysqli
{

    $connection_object = mysqli_connect(
        DATABASE_HOST,
        DATABASE_USER,
        DATABASE_PASSWORD,
        DATABASE_NAME
    );

    if ($connection_object == False) {
        exit();
    }

    return $connection_object;
}

############### 2. DATABASE CONNECTION CLOSE METHOD ###############
# DESCRIPTION: 
#       Method to close the MySQL Connectivity
# 
# PARAMETERS:
#       connection_object: mysql database connection object
#
# RETURN VALUES: None
#     
function close_database_connect($connection_object)
{
    mysqli_close($connection_object);
}


############### 3. INSERT INTO TABLE METHOD ###############
# DESCRIPTION: 
#       Method to insert records into table
# 
# PARAMETERS:
#       connection_object: mysql database connection object
#       insert_query: string
#
# RETURN VALUES:
#       last_id : int

function insert_data($connection_object, $insert_query): int
{

    $last_id = 0;

    $query_response = $connection_object->query($insert_query);

    if ($query_response == true) {
        $last_id = $connection_object->insert_id;
    }

    return $last_id;
}


############### 4. GET DATA FROM TABLE METHOD ###############
# DESCRIPTION: 
#       Method to get the data from Table
# 
# PARAMETERS:
#       connection_object: mysql database connection object
#       insert_query: string
#
# RETURN VALUES:
#       result_set : array of records

function get_table_data($connection_object, $select_query): array
{

    $query_response = $connection_object->query($select_query);

    if ($query_response == true) {
        $result_set = $query_response->fetch_all(MYSQLI_BOTH);
    }

    return $result_set;
}

############### 5. UPDATE DATA FROM TABLE METHOD ###############
# DESCRIPTION: 
#       Method to update the data in Table
# 
# PARAMETERS:
#       connection_object: mysql database connection object
#       update_query: string
#
# RETURN VALUES: Bool
#

function update_table_data($connection_object, $update_query): bool
{

    $query_response = $connection_object->query($update_query);
    if ($query_response == true) {
        return true;
    }
    return false;
}

############### 6. DELETE DATA FROM TABLE METHOD ###############
# DESCRIPTION: 
#       Method to DELETE the data in Table
# 
# PARAMETERS:
#       connection_object: mysql database connection object
#       delete_query: string
#
# RETURN VALUES: None
#

function delete_table_data($connection_object, $delete_query): bool
{
    $query_response = $connection_object->query($delete_query);
    echo $query_response;
    if ($query_response == true) {
        return true;
    }
    return false;
}