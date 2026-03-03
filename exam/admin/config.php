<?php

$conn= new mysqli("localhost","root","","de_lambo");
if(!$conn){
    die("connection failed".$conn->error);
}