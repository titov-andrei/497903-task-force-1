<?php

namespace Task\Actions;

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

    public function getRights(): bool
    {
        return $this->currentId === $this->executorId;
    }
}
