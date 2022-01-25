<?php

declare(strict_types=1);

namespace Loner\Event;

/**
 * 事件订阅者
 *
 * @package Loner\Event
 */
interface SubscriberInterface
{
    /**
     * 事件监听列表
     *
     * @return ListenerInterface[]
     */
    public function listeners(): array;
}
