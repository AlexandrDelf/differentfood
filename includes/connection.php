<?php

$connect = mysqli_connect('localhost', 'admin', '123', 'differentfood');

if (!$connect){
    die('error connect database');
}

?> 