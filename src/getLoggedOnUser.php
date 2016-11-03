<?php

session_start();
echo json_encode($_SESSION['logged_on_user']);
