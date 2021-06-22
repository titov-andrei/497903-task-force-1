<?php

namespace TaskForce;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS= 'in_progress';
    const STATUS_DONE = 'done';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FAILED = 'failed';

    const ACTION_CANCEL = 'cancel';
    const ACTION_REFUSE = 'refuse';
    const ACTION_RESPOND = 'respond';
    const ACTION_EXECUTE = 'execute';

    private $status;
    private $executorId;
    private $customerId;

    public function __construct(int $executor, ?int $customer = null)
    {
        $this->status = self::STATUS_NEW;
        $this->executorId = $executor;
        $this->customerId = $customer;
    }

    public function getStatusMap()
    {
        return [
            self::STATUS_NEW => 'Новое',
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_IN_PROGRESS => 'В работе',
            self::STATUS_FAILED => 'Провалено',
        ];
    }

    public function getActionMap()
    {
        return [
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_REFUSE => 'Отказаться',
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_EXECUTE => 'Выполнить',
        ];
    }

    public function getNextStatusByAction($action)
    {
        $statusArray = [
            self::ACTION_CANCEL => self::STATUS_CANCELED,
            self::ACTION_RESPOND => self::STATUS_IN_PROGRESS,
            self::ACTION_EXECUTE => self::STATUS_DONE,
            self::ACTION_REFUSE => self::STATUS_FAILED
        ];

        return $statusArray[$action] ?? null;
    }

    public function getNextActionsByStatus($status)
    {
        $actionsArray = [
            self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_RESPOND],
            self::STATUS_IN_PROGRESS => [self::ACTION_EXECUTE, self::ACTION_REFUSE]
        ];

        return $actionsArray[$status] ?? null;
    }
}
