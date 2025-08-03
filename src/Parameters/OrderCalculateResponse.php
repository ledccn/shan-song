<?php

namespace Ledc\ShanSong\Parameters;

use Ledc\SupportSdk\Parameters;

/**
 * 订单计费接口返回参数
 */
class OrderCalculateResponse extends Parameters
{
    /**
     * 总距离，单位：米
     * @var int
     */
    public int $totalDistance;
    /**
     * 总重量，单位：kg
     * @var int
     */
    public int $totalWeight;
    /**
     * 闪送订单号（有效期30分钟）
     * @var string
     */
    public string $orderNumber;
    /**
     * 费用明细
     * @var array
     */
    public array $feeInfoList;
    /**
     * 订单总金额，未优惠需要支付的费用，单位：分
     * @var int
     */
    public int $totalAmount;
    /**
     * 优惠的总额度，单位：分
     * @var int
     */
    public int $couponSaveFee;
    /**
     * 实际支付的费用，单位：分
     * @var int
     */
    public int $totalFeeAfterSave;
    /**
     * 增值服务列表
     * @var array
     */
    public array $interestDtoList;

    /**
     * 必填项
     * @return array
     */
    protected function getRequiredKeys(): array
    {
        return ['totalDistance', 'totalWeight', 'orderNumber', 'feeInfoList', 'totalAmount', 'couponSaveFee', 'totalFeeAfterSave', 'interestDtoList'];
    }
}