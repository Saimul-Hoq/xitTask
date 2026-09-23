<?php

$_SESSION = [];
session_destroy();

header('Location: /projects/xitTask/');
exit;