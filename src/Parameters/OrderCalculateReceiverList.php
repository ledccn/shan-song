<?php

namespace Ledc\ShanSong\Parameters;

/**
 * 收件人信息集合
 */
class OrderCalculateReceiverList extends Collection
{
    /**
     * 添加收件人信息
     * @param OrderCalculateReceiver $receiver 收件人信息
     */
    public function add(OrderCalculateReceiver $receiver)
    {
        $this->items[] = $receiver;
    }
}
