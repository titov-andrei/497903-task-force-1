<?php

namespace Task\Actions;

class ActionExecute extends Action
{
    public function getTitle(): string
    {
        return 'Выполнить';
    }

    public function getName(): string
    {
        return 'execute';
    }

    public function getRights(): bool
    {
        return $this->currentId === $this->customerId;
    }
}
