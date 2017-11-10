<?php


function conecta()
{
    $conn = new PDO("mysql:host=localhost;dbname=db_crud_alunos", "root", "");

    return $conn;

}


