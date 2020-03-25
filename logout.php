<?php 
session_start();
session_destroy();
header('Location: apply');
die; //me
?>