<?php

namespace Ledc\ShanSong\Parameters;

use Closure;
use InvalidArgumentException;
use SplObjectStorage;
use SplObserver;
use SplSubject;

/**
 * 处理订单状态回调的数据报文
 */
abstract class OrderSubject implements SplSubject
{
    /**
     * 已注册添加的观察者对象
     * @var SplObjectStorage
     */
    private SplObjectStorage $observers;
    /**
     * 订单状态回调的数据报文
     * @var Notify
     */
    private Notify $status;
    /**
     * 待注册添加的观察者类
     * @var array|class-string[]|SplObserver[]
     */
    protected array $register = [];

    /**
     * 构造函数
     * @param Notify $status 订单状态回调的数据报文
     */
    final public function __construct(Notify $status)
    {
        $this->observers = new SplObjectStorage();
        $this->status = $status;
        $this->initialize();
        $this->registerObserver();
    }

    /**
     * 子类初始化
     * @return void
     */
    abstract protected function initialize(): void;

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

    /**
     * 添加观察者
     * @return void
     */
    final private function registerObserver(): void
    {
        foreach ($this->register as $class) {
            if ($class instanceof SplObserver) {
                $this->attach($class);
            } elseif (is_string($class) && class_exists($class)) {
                $this->attach(new $class);
            } elseif ($class instanceof Closure) {
                $this->attach(new class($class) implements SplObserver {
                    private Closure $closure;

                    public function __construct(Closure $closure)
                    {
                        $this->closure = $closure;
                    }

                    public function update(SplSubject $subject): void
                    {
                        ($this->closure)($subject);
                    }
                });
            } else {
                throw new InvalidArgumentException('观察者类必须是 SplObserver 或字符串');
            }
        }
    }
}
