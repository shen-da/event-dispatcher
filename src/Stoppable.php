<?php

declare(strict_types=1);

namespace Loner\Event;

/**
 * 事件的传播的可控性
 *
 * @package Loner\Event
 */
trait Stoppable
{
    /**
     * 事件是否停止传播
     *
     * @var bool
     */
    protected bool $isPropagationStopped = false;

    /**
     * @inheritDoc
     */
    public function isPropagationStopped(): bool
    {
        return $this->isPropagationStopped;
    }

    /**
     * @inheritDoc
     */
    public function stopPropagation(): void
    {
        $this->isPropagationStopped = true;
    }
}
