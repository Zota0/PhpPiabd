<!DOCTYPE html>
<?php
    $dbhost = 'localhost';
    $dbport = '4306';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'ecom2';
    
    $dbData = [
        $dbhost,
        $dbuser,
        $dbpass,
        $dbname,
        $dbport
    ];

    function ConnectToDB(array $DatabaseInfo)  {
        $conndb = new mysqli($DatabaseInfo[0],$DatabaseInfo[1],$DatabaseInfo[2],$DatabaseInfo[3],$DatabaseInfo[4], NULL);

        if($conndb->connect_error) {
            die("Connection Failed: ".$conndb->connect_error);
        }
        
        return $conndb;
    }

    function InsertDataInto($connection, $table, $values) {
        $InsertIntoSQL = "INSERT INTO $table (ID, FIRSTNAME, LASTNAME, PASSWORD, BIRTHDATE)
        VALUES
        (
            NULL,
            '$values[firstname]',
            '$values[lastname]',
            '$values[password]',
            '$values[birthdate]'
        )";
        $stmt = $connection->prepare($InsertIntoSQL);
        if ($stmt->execute()) {
            $connection->close();
            echo "<br>";
            echo "New Record has been made";
            echo "
            <div id='succes'>
                Udało się !
            </div>
            ";
        } else {
            echo "Error ".$stmt->error;
        }
        unset($InsertIntoSQL);
        $stmt->close();
    }
?>