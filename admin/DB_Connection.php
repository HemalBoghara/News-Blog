<?php
    $HostName = "/News-Blog";

    $ServerName = "localhost";
    $UserName = "root";
    $PassWord = "";
    $DataBase = "news-blog";

    $Connect = mysqli_connect($ServerName,$UserName,$PassWord,$DataBase);

    if(!$Connect)
    {
        die("<b>Connection Failed</b>") . "<br>";
    }
?>