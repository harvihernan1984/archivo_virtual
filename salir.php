<?php
session_start();
session_unset();
session_destroy();
echo "<script type=''>window.location='index.php';</script>";
?>
