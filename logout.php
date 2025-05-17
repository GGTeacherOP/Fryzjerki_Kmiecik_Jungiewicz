<?php
session_start();
session_unset(); // usuwa wszystkie dane sesji
session_destroy(); // kończy sesję
header("Location: login.php"); // przekierowanie do logowania
exit();
?>