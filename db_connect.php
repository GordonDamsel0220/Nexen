<?php

    $host="localhost";
    $dbname="<DB_NAME>";
    $dbUser="postgres";
    $dbPass="<PASSWORD>";
    $port="<PORT>";

    $connection = new PDO("pgsql:dbname='$dbname';port='$port';host='$host'", $dbUser, $dbPass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>