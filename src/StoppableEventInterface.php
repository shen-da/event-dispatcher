<?php

declare(strict_types=1);

namespace Loner\Event;

use Psr\EventDispatcher\StoppableEventInterface as PsrStoppableEventInterface;

/**
 * 传播可控性事件
 *
 * @package Loner\Event
 */
interface StoppableEventInterface extends PsrStoppableEventInterface
{
    /**
     * 事件停止传播
     */
    public function stopPropagation(): void;
}
