<?php

namespace Task\Actions;

use Exceptions\Exception;

class ActionRefuse extends Action
{
    public function getTitle(): string
    {
        return 'Отказаться';
    }

    public function getName(): string
    {
        return 'refuse';
    }

    public function getRights(int $executorId, int $customerId, int $currentId): bool
    {
        if (!is_int($executorId) || !is_int($customerId) || !is_int($currentId)) {
            throw new Exception("Id должен быть числом");
        }

        return $this->currentId === $this->executorId;
    }
}
