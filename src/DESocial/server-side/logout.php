<?php session_start();
if (isset($_SESSION["user"])) unset($_SESSION["user"]) ; unset($_SESSION["user_type"])
?><script type="text/javascript">window.top.location = "../index.php";</script>