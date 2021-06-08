<?php

require_once '../vendor/autoload.php';

use Task;

$task = new Task(1, 2);

var_dump($task->getActionMap());
