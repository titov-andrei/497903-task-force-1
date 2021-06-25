<?php

namespace Task\Actions;

use Exceptions\Exception;

class ActionRespond extends Action
{
    public function getTitle(): string
    {
        return 'Откликнуться';
    }

    public function getName(): string
    {
        return 'respond';
    }

    public function getRights(int $executorId, int $customerId, int $currentId): bool
    {
        if (!is_int($executorId) || !is_int($customerId) || !is_int($currentId)) {
            throw new Exception("Id должен быть числом");
        }

        return true;
    }
}
