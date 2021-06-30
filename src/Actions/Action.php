<?php

namespace TaskForce\Actions;

abstract class Action
{
    abstract public function getTitle(): string;

    abstract public function getName(): string;

    abstract public function getRights(int $executorId, int $customerId, int $currentId): bool;
}
