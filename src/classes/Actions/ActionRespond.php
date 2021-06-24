<?php

namespace Task\Actions;

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
        return true;
    }
}
