<?php

namespace Ledc\ShanSong\Parameters;

/**
 * 提交订单响应参数
 * @package Ledc\ShanSong\Parameters
 */
class OrderPlaceResponse extends OrderCalculateResponse
{
    /**
     * 预计接单时长，单位秒,-1表示无预计时长
     * @var int
     */
    public int $estimateGrabSecond;
    /**
     * 预计完单时长，单位秒,-1表示无预计时长
     * @var int
     */
    public int $estimateReceiveSecond;
    /**
     * 订单信息
     * @var array
     */
    public array $orderInfoList;

    /**
     * 获取必填参数
     * @return array
     */
    protected function getRequiredKeys(): array
    {
        return array_merge(parent::getRequiredKeys(), ['estimateGrabSecond', 'estimateReceiveSecond', 'orderInfoList']);
    }
}
