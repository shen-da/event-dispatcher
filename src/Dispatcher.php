<?php

declare(strict_types=1);

namespace Loner\Event;

use Psr\EventDispatcher\StoppableEventInterface;
use SplPriorityQueue;

/**
 * 事件调度器
 *
 * @package Loner\Event
 */
class Dispatcher implements DispatcherInterface
{
    /**
     * 监听器列表
     *
     * @var array[] [...[监听器, 优先级]]
     */
    protected array $listeners = [];

    /**
     * @inheritDoc
     */
    public function dispatch(object $event): object
    {
        $listeners = $this->getListenersForEvent($event);
        if ($event instanceof StoppableEventInterface) {
            foreach ($listeners as $listener) {
                $listener($event);
                if ($event->isPropagationStopped()) {
                    break;
                }
            }
        } else {
            foreach ($listeners as $listener) {
                $listener($event);
            }
        }
        return $event;
    }

    /**
     * @inheritDoc
     *
     * @return SplPriorityQueue<callable>
     */
    public function getListenersForEvent(object $event): SplPriorityQueue
    {
        $queue = new SplPriorityQueue();
        foreach ($this->listeners as [$listener, $priority]) {
            /** @var ListenerInterface $listener */
            if ($listener->contains($event)) {
                $queue->insert($listener, $priority);
            }
        }
        return $queue;
    }

    /**
     * 添加事件监听
     *
     * @param string $event
     * @param callable $callback
     * @param int $priority
     */
    public function on(string $event, callable $callback, int $priority = 1): void
    {
        $this->addListener(new Listener($event, $callback), $priority);
    }

    /**
     * @inheritDoc
     */
    public function addListener(ListenerInterface $listener, int $priority = 1): void
    {
        $this->listeners[] = [$listener, $priority];
    }

    /**
     * @inheritDoc
     */
    public function addSubscriber(SubscriberInterface $subscriber, int $priority = 1): void
    {
        foreach ($subscriber->Listeners() as $listener) {
            $this->addListener($listener, $priority);
        }
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        $this->listeners = [];
    }
}
