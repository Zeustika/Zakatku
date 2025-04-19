<?php

$path = "http://localhost/zakatfitrah";
session_start();
session_unset();
session_destroy();
header("Location: $path/index.php");