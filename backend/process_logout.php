<?php

session_start();
require '../db/db_conn.php';
session_destroy();
header('Location: ../index.php');


