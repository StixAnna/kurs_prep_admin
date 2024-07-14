<?php

require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/envdefine.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();
}

redirect('../../home.php');