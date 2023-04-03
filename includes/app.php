<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;

require __DIR__ . '/../vendor/autoload.php';


// dotenv
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

require 'functions.php';
require 'database.php';


// connect to db
ActiveRecord::setDB($db);
