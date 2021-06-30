<?php

namespace TaskForce\Actions;

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

    public function getRights(int $executorId, int $customerId, int $currentId): bool
    {
        return $this->currentId === $this->customerId;
    }
}
