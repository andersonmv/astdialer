<?php

include_once 'config.php';

unset($_SESSION['username']);
unset($_SESSION['logged']);
header("Location: index.php");
