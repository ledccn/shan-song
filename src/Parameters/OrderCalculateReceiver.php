<?php

namespace Ledc\ShanSong\Parameters;

/**
 * 收件人信息
 */
class OrderCalculateReceiver extends Parameters
{
    /**
     * 必填：第三方平台流水号
     * @var string
     */
    public string $orderNo;
    /**
     * 必填：收件地址
     * @var string
     */
    public string $toAddress;
    /**
     * 收件详细地址
     * @var string
     */
    public string $toAddressDetail = '';
    /**
     * 必填：收件纬度
     * @var string
     */
    public string $toLatitude;
    /**
     * 必填：收件经度
     * @var string
     */
    public string $toLongitude;
    /**
     * 必填：收件人姓名
     * @var string
     */
    public string $toReceiverName;
    /**
     * 必填：收件联系人
     * - 支持11位手机号；支持座机号格式：010-12345678 或者010-12345678-123）；支持隐私号（格式：18701012345#001）
     * @var string
     */
    public string $toMobile;
    /**
     * 必填：物品类型
     * - 1-文件,3-数码,5-蛋糕,6-餐饮,7-鲜花,9-汽配,10-其他,12-母婴,13-医药健康,15-商超,16-水果
     * @var int
     */
    public int $goodType;
    /**
     * 物品重量
     * - 传向上取整整数，单位为kg，例如：6.7kg传7；最大重量不超过999kg
     * @var int
     */
    public int $weight;
    /**
     * 备注
     * @var string
     */
    public string $remarks = '';
    /**
     * 快速通道费
     * - 单位为分，能被100整除，最大值为10000，用于促进闪送员接单
     * @var string
     */
    public string $additionFee = '';
    /**
     * 物品来源
     * - 1-闪送,2-百度外卖,3-饿了么外卖,4-美团外卖,5-其他平台,6-京东到家,7-达达,8-饿百
     * - 详见下方订单来源枚举，对应商家版取号来源,支持美团,饿了么；不传时默认为“闪送”，传参数时必须和orderingSourceNo成对出现
     * @var int|null
     */
    public ?int $orderingSourceType = null;
    /**
     * 物品来源流水号
     * - 对应orderingSourceType流水号，传参数时必须和orderingSourceType成对出现
     * @var string
     */
    public string $orderingSourceNo = '';
    /**
     * 蛋糕尺寸
     * - 当qualityDelivery为1，并且goodType为5时，必传。详见下方蛋糕尺寸枚举
     * @var int|null
     */
    public ?int $goodsSizeIde = null;
    /**
     * 投保金额，单位：分
     * - insuranceFlag为1时，必传。闪送会根据投保金额计算保险费用，如果你的物品破损或丢失，将可根据投保金额进行索赔
     * @var int|null
     */
    public ?int $goodsPrice = null;
    /**
     * 尊享送服务
     * - 1：使用尊享送服务
     * @var int|null
     */
    public ?int $qualityDelivery = null;
    /**
     * 是否投保
     * - 0:不投保;1:投保，默认值为0。投保金额以goodsPrice为准。
     * @var int
     */
    public int $insuranceFlag = 0;
    /**
     * 期望送达时间起始时间
     * - 毫秒级时间戳。期望送达时间为时间点时，无需传本参数；期望送达时间为时间段时，期望送达时间为expectStartTime至expectEndTime
     * @var int|null
     */
    public ?int $expectStartTime = null;
    /**
     * 期望送达时间终止时间
     * - 毫秒级时间戳。期望送达时间为时间点时，只需传本参数；期望送达时间为时间段时，期望送达时间为expectStartTime至expectEndTime
     * @var int|null
     */
    public ?int $expectEndTime = null;

    /**
     * 必填项
     * @return array
     */
    protected function getRequiredKeys(): array
    {
        return ['orderNo', 'toAddress', 'toLatitude', 'toLongitude', 'toReceiverName', 'toMobile', 'goodType', 'weight', 'remarks'];
    }
}