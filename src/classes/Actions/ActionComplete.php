<?php

namespace Task\Actions;

use Exceptions\Exception;

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
        if (!is_int($executorId) || !is_int($customerId) || !is_int($currentId)) {
            throw new Exception("Id должен быть числом");
        }

        return $this->currentId === $this->customerId;
    }
}
