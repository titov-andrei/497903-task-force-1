<?php

require_once '../vendor/autoload.php';

use TaskForce\Task;

$task = new Task(1, 2);

var_dump($task->getActionMap());
