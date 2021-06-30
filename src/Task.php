<?php

declare(strict_types=1);

namespace TaskForce;

use Exceptions\TaskForceException;

use TaskForce\Actions\Action;
use TaskForce\Actions\ActionCancel;
use TaskForce\Actions\ActionRespond;
use TaskForce\Actions\ActionComplete;
use TaskForce\Actions\ActionRefuse;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DONE = 'done';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FAILED = 'failed';

    const ACTION_CANCEL = 'cancel';
    const ACTION_RESPOND = 'respond';
    const ACTION_REFUSE = 'refuse';
    const ACTION_COMPLETE = 'complete';

    private $status;
    private $executorId;
    private $customerId;
    private $currentId;

    public function __construct(string $status, int $current, int $customer, ?int $executor = null )
    {
        $statusArray = [
            self::STATUS_NEW => 'Новое',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_FAILED => 'Провалено',
        ];

        if (!isset($statusArray[$status])) {
            throw new TaskForceException("Status не может иметь такое значение");
        }

        $this->status = $status;
        $this->currentId = $current;
        $this->customerId = $customer;
        $this->executorId = $executor;
    }
    
    public function getNextStatusByAction(string $action): ?array
    {
        $statusArrayByAction = [
            self::ACTION_CANCEL => self::STATUS_CANCELED,
            self::ACTION_RESPOND => self::STATUS_IN_PROGRESS,
            self::ACTION_REFUSE => self::STATUS_FAILED,
            self::ACTION_COMPLETE => self::STATUS_DONE,
        ];

        return $statusArrayByAction[$action] ?? null;
    }

    public function getNextActionsByStatus($status): array
    {
        $status = $this->status;
        $actionsArrayByStatus = [
            self::STATUS_NEW => [new ActionCancel(), new ActionRespond()],
            self::STATUS_IN_PROGRESS => [new ActionComplete(), new ActionRefuse()]
        ];

        return array_filter($actionsArrayByStatus[$status], function (Action $action) {
            return $action->getRights($this->executorId, $this->customerId, $this->currentId);
        });
    }
}
