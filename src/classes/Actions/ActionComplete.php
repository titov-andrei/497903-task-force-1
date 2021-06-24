<?php

namespace Task\Actions;

class ActionComplete extends Action
{
    public function getTitle(): string
    {
        return 'Выполнить';
    }

    public function getName(): string
    {
        return 'complete';
    }

    public function getRights(int $executorId, int $customerId, int $currentId): bool
    {
        return $this->currentId === $this->customerId;
    }
}
