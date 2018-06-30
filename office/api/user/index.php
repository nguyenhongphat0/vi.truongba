<?php
    include "../model/User.php";
    die(json_encode(User::all()))
?>