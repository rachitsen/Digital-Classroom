<?php

SESSION_START();
SESSION_UNSET();
SESSION_DESTROY();

header("location: login.php");
?>