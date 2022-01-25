<?php

namespace Loner\Event;

/**
 * 事件监听器
 *
 * @package Loner\Event
 */
class Listener implements ListenerInterface
{
    /**
     * 监听事件回调
     *
     * @var callable
     */
    private $callback;

    /**
     * 初始化事件监听信息
     *
     * @param string $event 监听事件类型
     * @param callable $callback
     */
    public function __construct(private string $event, callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @inheritDoc
     */
    public function contains(object $event): bool
    {
        return $event instanceof $this->event;
    }

    /**
     * @inheritDoc
     */
    public function __invoke(object $event): void
    {
        if ($this->contains($event)) {
            $callback = $this->callback;
            call_user_func($callback, $event);
        }
    }
}
