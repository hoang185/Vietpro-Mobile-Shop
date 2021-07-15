<?php
session_start();

// unset($_SESSION["mail"]);
session_destroy();

echo $_SESSION["mail"]."<br/>".$_SESSION["pass"];
?>