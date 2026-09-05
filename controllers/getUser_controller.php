<?php

require_once(__DIR__."/../config/database.php");
require_once(__DIR__."/../models/getUser_model.php");


function getCurrentUser($pdo, $email){
    return getUser($pdo, $email);
}