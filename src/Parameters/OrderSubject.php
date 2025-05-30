<?php

namespace Ledc\ShanSong\Parameters;

use SplObjectStorage;
use SplObserver;
use SplSubject;

/**
 * 处理订单状态回调的数据报文
 */
abstract class OrderSubject implements SplSubject
{
    /**
     * 已注册的观察者对象
     * @var SplObjectStorage
     */
    private SplObjectStorage $observers;
    /**
     * 订单状态回调的数据报文
     * @var Notify
     */
    private Notify $status;

    /**
     * 构造函数
     * @param Notify $status 订单状态回调的数据报文
     */
    final public function __construct(Notify $status)
    {
        $this->observers = new SplObjectStorage();
        $this->status = $status;
        $this->init();
    }

    /**
     * 子类初始化
     * @return void
     */
    abstract protected function init(): void;

    /**
     * 添加观察者
     * @param SplObserver $observer 观察者对象
     * @return self
     */
    final public function register(SplObserver $observer): self
    {
        $this->observers->attach($observer);
        return $this;
    }

    /**
     * 添加观察者
     * @param SplObserver $observer 观察者对象
     * @return void
     */
    final public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    /**
     * 删除观察者
     * @param SplObserver $observer 观察者对象
     * @return void
     */
    final public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    /**
     * 通知观察者
     * @return void
     */
    final public function notify(): void
    {
        /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * 设置状态
     * @param Notify $status 订单状态回调的数据报文
     * @return void
     */
    final public function changeStatus(Notify $status): void
    {
        $this->status = $status;
        $this->notify();
    }

    /**
     * 获取状态
     * @return Notify 订单状态回调的数据报文
     */
    final public function getStatus(): Notify
    {
        return $this->status;
    }
}
