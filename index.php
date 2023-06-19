<?php

require 'kernel.php';

$request = $_SERVER['REQUEST_URI'];
$response = Kernel::handle($request);
echo $response;