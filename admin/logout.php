<?php

    include("DB_Connection.php");

    session_start();
    session_unset();
    session_destroy();

    header("Location: $HostName/admin/");

?>