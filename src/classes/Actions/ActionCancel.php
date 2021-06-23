<?php

namespace Task\Actions;

class ActionCancel extends Action
{
    public function getTitle(): string
    {
        return 'Отменить';
    }

    public function getName(): string
    {
        return 'cancel';
    }

    public function getRights(): bool
    {
        return $this->currentId === $this->customerId;
    }
}
