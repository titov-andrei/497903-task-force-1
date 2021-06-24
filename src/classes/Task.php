<?php

namespace Task;

use Task\Actions\ActionCancel;
use Task\Actions\ActionRespond;
use Task\Actions\ActionComplete;
use Task\Actions\ActionRefuse;
use Task\Actions\Action;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS= 'in_progress';
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

    public function __construct(int $executor, ?int $customer = null, int $current, string $status)
    {
        $this->status = $status;
        $this->executorId = $executor;
        $this->customerId = $customer;
        $this->currentId = $current;
    }

    public function getStatusMap()
    {
        return [
            self::STATUS_NEW => 'Новое',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_FAILED => 'Провалено',
        ];
    }

    public function getNextStatusByAction($action)
    {
        $statusArray = [
            self::ACTION_CANCEL => self::STATUS_CANCELED,
            self::ACTION_RESPOND => self::STATUS_IN_PROGRESS,
            self::ACTION_REFUSE => self::STATUS_FAILED,
            self::ACTION_COMPLETE => self::STATUS_DONE,
        ];

        return $statusArray[$action] ?? null;
    }

    public function getNextActionsByStatus($status): array
    {
        $actionsArray = [
            self::STATUS_NEW => [new ActionCancel(), new ActionRespond()],
            self::STATUS_IN_PROGRESS => [new ActionComplete(), new ActionRefuse()]
        ];

        if (!isset($actionsArray[$status])) {
            return [];
        }

        return array_filter($actionsArray[$status], function (Action $action) {
            return $action->getRights($this->executorId, $this->customerId, $this->currentId);
        });
    }
}
