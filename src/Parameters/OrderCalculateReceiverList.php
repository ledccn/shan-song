<?php

namespace Ledc\ShanSong\Parameters;

use Ledc\SupportSdk\Collection;

/**
 * 收件人信息集合
 */
class OrderCalculateReceiverList extends Collection
{
    /**
     * 添加收件人信息
     * @param OrderCalculateReceiver $receiver 收件人信息
     * @return self
     */
    public function add(OrderCalculateReceiver $receiver): self
    {
        $this->items[] = $receiver;
        return $this;
    }
}
