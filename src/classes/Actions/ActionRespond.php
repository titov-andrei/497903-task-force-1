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

    public function getRights(): bool
    {
        return $this->currentId === $this->executorId;
    }
}
