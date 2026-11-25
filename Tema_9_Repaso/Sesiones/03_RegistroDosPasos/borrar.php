<?php
session_start();
unset($_SESSION["nombre"], $_SESSION["ciudad"]);
header("Location: index.php"); exit;
