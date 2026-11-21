<?php
session_start(); // start the session 

unset($_SESSION['admin_name']);

unset($_SESSION['role']);

unset($_SESSION['admin_id']);

unset($_SESSION['userCart']);

header("location: index.php ");

exit();
