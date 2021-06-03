<?php

class Task
{
    // статусы
    const STATUS_NEW = 'Новое';
    const STATUS_CANCELED = 'Отменено';
    const STATUS_INWORK = 'В работе';
    const STATUS_DONE = 'Выполнено';
    const STATUS_FAILED = 'Провалено';

    // действия
    const ACTION_CANCEL = 'Отменить';
    const ACTION_RESPOND = 'Откликнуться';
    const ACTION_EXECUTE = 'Выполнить';
    const ACTION_REFUSE = 'Отказаться';

    // роли
    const EXECUTOR = 'Исполнитель';
    const CUSTOMER = 'Заказчик';

    public $status;
    public $nextAction;

    // создание новой схемы
    public function __construct(int $executor, ?int $customer = null)
    {
        $this->status = self::STATUS_NEW;
        $this->executorId = $executor;
        $this->customerId = $customer;
    }

    // следующий статус
    public function getNextStatus($action)
    {
        $statusArray = [
            self::ACTION_CANCEL => self::STATUS_CANCELED,
            self::ACTION_RESPOND => self::STATUS_INWORK,
            self::ACTION_EXECUTE => self::STATUS_DONE,
            self::ACTION_REFUSE => self::STATUS_FAILED
        ];

        return $statusArray[$action];
    }

    // следующие действия
    public function getNextActions($status, $role, $action)
    {
        $statusActionsArray = [
            self::STATUS_NEW => [
                self::CUSTOMER => [
                    self::ACTION_CANCEL
                ],
                self::EXECUTOR => [
                    self::ACTION_RESPOND
                ]
            ],
            self::STATUS_INWORK => [
                self::CUSTOMER => [
                    self::ACTION_EXECUTE
                ],
                self::EXECUTOR => [
                    self::ACTION_REFUSE
                ]
            ]
        ];

        $allActions = $this->$statusActionsArray[$status];
        $availableActions = $this->$allActions[$role];

        return $availableActions[$action];
    }

    // смена статуса
    public function changeStatus($currentStatus, $currentRole, $currentAction)
    {
        $action = $this->getNextActions($currentStatus, $currentRole, $currentAction);
        $newStatus = $this->getNextStatus($action);
        $this->status = $newStatus;
    }
};

assert($strategy->changeStatus('Отменить') == Task::STATUS_CANCELED, 'Отменить');
