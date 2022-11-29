<?php 
include_once("settings/core.php");
session_destroy();

header("Location: index.php");
?>