<?php

namespace TaskForce\Actions;

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
        return $this->currentId === $this->executorId;
    }
}
