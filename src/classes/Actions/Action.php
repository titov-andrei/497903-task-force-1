<?php

namespace Task\Actions;

abstract class Action
{
    public $executorId;
    public $customerId;
    public $currentId;

    public function __construct(int $executorId, int $customerId, int $currentId)
    {
        $this->executorId = $executorId;
        $this->customerId = $customerId;
        $this->currentId = $currentId;
    }

    abstract protected function getTitle();

    abstract protected function getName();

    abstract protected function getRights(): bool;
}
