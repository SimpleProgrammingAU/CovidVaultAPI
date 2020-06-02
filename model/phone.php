<?php

require_once 'Config.php';
$pn = "+61417227152";
$len = strlen($pn);
$result = Config::ValidatePhoneNumber($pn);

echo $result;