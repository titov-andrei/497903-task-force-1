<?php

namespace Task;

use Task\Actions\ActionCancel;
use Task\Actions\ActionRespond;
use Task\Actions\ActionExecute;
use Task\Actions\ActionRefuse;

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
    const ACTION_EXECUTE = 'execute';

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

    public function getActionMap()
    {
        return [
            self::ACTION_CANCEL => 'Отменить',
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_REFUSE => 'Отказаться',
            self::ACTION_EXECUTE => 'Выполнить',
        ];
    }

    public function getNextStatusByAction($action)
    {
        $statusArray = [
            self::ACTION_CANCEL => self::STATUS_CANCELED,
            self::ACTION_RESPOND => self::STATUS_IN_PROGRESS,
            self::ACTION_REFUSE => self::STATUS_FAILED,
            self::ACTION_EXECUTE => self::STATUS_DONE,
        ];

        return $statusArray[$action] ?? null;
    }

    public function getNextActionsByStatus($status)
    {
        switch ($status) {
            case self::STATUS_NEW:
                $actionCancel = new ActionCancel($this->executorId, $this->customerId, $this->currentId);
                if ($actionCancel->getRights()) {
                    return ($actionCancel);
                } else {
                    unset($actionCancel);
                }

                $actionRespond = new ActionRespond($this->executorId, $this->customerId, $this->currentId);
                if ($actionRespond->getRights()) {
                    return ($actionRespond);
                } else {
                    unset($actionRespond);
                }

            case self::STATUS_IN_PROGRESS:
                $actionRefuse = new ActionRefuse($this->executorId, $this->customerId, $this->currentId);
                if ($actionRefuse->getRights()) {
                    return ($actionRefuse);
                } else {
                    unset($actionRefuse);
                }

                $actionExecute = new ActionExecute($this->executorId, $this->customerId, $this->currentId);
                if ($actionExecute->getRights()) {
                    return ($actionExecute);
                } else {
                    unset($actionExecute);
                }
        }
        return NULL;
    }
}
