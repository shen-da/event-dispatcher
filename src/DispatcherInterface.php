<?php

declare(strict_types=1);

namespace Loner\Event;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * 事件调度器
 *
 * @package Loner\Event
 */
interface DispatcherInterface extends EventDispatcherInterface, ListenerProviderInterface
{
    /**
     * 添加事件监听
     *
     * @param string $event
     * @param callable $callback
     * @param int $priority
     */
    public function on(string $event, callable $callback, int $priority = 1): void;

    /**
     * 添加事件监听
     *
     * @param ListenerInterface $listener
     * @param int $priority
     */
    public function addListener(ListenerInterface $listener, int $priority = 1): void;

    /**
     * 添加订阅者
     *
     * @param SubscriberInterface $subscriber
     * @param int $priority
     */
    public function addSubscriber(SubscriberInterface $subscriber, int $priority = 1): void;

    /**
     * 清空监听
     */
    public function clear(): void;
}
