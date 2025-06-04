<?php

namespace Ledc\ShanSong\Parameters;

use Ledc\ShanSong\Enums\OrderStatusEnums;

/**
 * 订单状态回调的数据报文
 */
class Notify extends Parameters
{
    /**
     * App-key
     *  - 去账户中心->应用信息查看
     * @var string
     */
    protected string $clientId = '';
    /**
     * 商户ID
     *  - 去账户中心->应用信息查看
     * @var string
     */
    protected string $shopId = '';
    /**
     * 闪送订单号
     * @var string
     */
    public string $issOrderNo;
    /**
     * 第三方平台流水号
     * @var string
     */
    public string $orderNo;
    /**
     * 订单状态
     * @var int
     */
    public int $status;
    /**
     * 订单状态描述
     * @var string
     */
    public string $statusDesc;
    /**
     * 订单子状态
     * @var int
     */
    public int $subStatus = 0;
    /**
     * 订单子状态描述
     * @var string
     */
    public string $subStatusDesc = '';
    /**
     * 取件密码
     * - 计费接口中pickupPwd传1时，下单后，订单会生成取件码
     * @var String
     */
    public string $pickupPassword = '';
    /**
     * 收件密码
     * - 收件密码，骑手取件后生成
     * @var string
     */
    public string $deliveryPassword = '';
    /**
     * 扣款金额，单位：分
     * @var int
     */
    public int $deductAmount = 0;
    /**
     * 取消发起人
     * @var int
     */
    public int $abortType = 0;
    /**
     * 取消责任人
     * @var int
     */
    public int $punishType = 0;
    /**
     * 取消原因
     * @var string
     */
    public string $abortReason = '';
    /**
     * 闪送员信息
     * @var Courier|null
     */
    public ?Courier $courier = null;
    /**
     * 送回费
     * @var int
     */
    public int $sendBackFee;
    /**
     * 退款金额
     * @var int
     */
    public int $drawback;

    /**
     * 构造函数
     * @param array $properties
     */
    public function __construct(array $properties = [])
    {
        if (isset($properties['courier'])) {
            $this->courier = new Courier($properties['courier']);
            unset($properties['courier']);
        }
        parent::__construct($properties);
    }

    /**
     * 获取App-key
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * 获取商户ID
     * - 测试环境与正式环境的商户ID不同，请注意区分
     * @return string
     */
    public function getShopId(): string
    {
        return $this->shopId;
    }

    /**
     * 判断是否派单中
     * @return bool
     */
    public function isPendingAssignment(): bool
    {
        return OrderStatusEnums::INT_20 === $this->status;
    }

    /**
     * 判断是否骑手已接单，待取货……
     * @return bool
     */
    public function isRiderAcceptedAndAwaitingPickup(): bool
    {
        return OrderStatusEnums::INT_30 === $this->status;
    }

    /**
     * 判断是否骑手已取件，订单正在配送中……
     * @return bool
     */
    public function isDelivering(): bool
    {
        return OrderStatusEnums::INT_40 === $this->status && OrderStatusEnums::INT_40_SUB_1 === $this->subStatus;
    }

    /**
     * 判断是否骑手已送达，订单已完成
     * @return bool
     */
    public function isCompleted(): bool
    {
        return OrderStatusEnums::INT_50 === $this->status && OrderStatusEnums::INT_50_SUB_1 === $this->subStatus;
    }

    /**
     * 订单完成，已退款
     * @return bool
     */
    public function isCompletedRefund(): bool
    {
        return OrderStatusEnums::INT_50 === $this->status && OrderStatusEnums::INT_50_SUB_2 === $this->subStatus;
    }

    /**
     * 判断是否订单已取消
     * @return bool
     */
    public function isCancelled(): bool
    {
        return OrderStatusEnums::INT_60 === $this->status;
    }

    /**
     * 获取必填参数
     * @return array
     */
    protected function getRequiredKeys(): array
    {
        return ['issOrderNo', 'orderNo', 'status', 'statusDesc', 'sendBackFee', 'drawback'];
    }
}
