<?php

namespace Ledc\ShanSong\Parameters;

/**
 * 订单计费的data参数
 */
class OrderCalculate extends Parameters
{
    /**
     * 城市名称
     * - 查询开通城市接口获取，如果确定自己对接的城市开通闪送服务，并且知道城市名称就不需要查询开通城市接口
     * @var string
     */
    public string $cityName = '海口市';
    /**
     * 预约类型
     * - 0立即单，1预约单
     * @var int
     */
    public int $appointType = 0;
    /**
     * 预约时间
     * - yyyy-MM-dd HH:mm格式(例如：2020-02-02 22:00）,指的是预约取件时间,只支持一个小时以后两天以内
     * @var string
     */
    public string $appointmentDate = '';
    /**
     * 店铺ID
     * - 查询商户店铺获取的storeId字段，不传递店铺ID订单就认为默认店铺下单
     * @var int|null
     */
    public ?int $storeId = null;
    /**
     * 三方店铺名
     * - 传storeName时，将以该值作为店铺名称（包括：闪送员端、商家端、商家端账单）；
     * - 不传storeName时，将取storeId对应的店铺名称（订单归属仍以storeId为准，不传则为默认店铺）
     * @var string
     */
    public string $storeName = '';
    /**
     * 指定交通工具
     * - 通过查询城市可指定交通方式接口获取对应travelWay字段，指定交通工具会产生交通费，默认为0：不限交通方式；
     * @var int
     */
    public int $travelWay = 0;
    /**
     * 帮我取 帮我送
     * - 1.帮我送 2.帮我取 ；默认为1
     * @var int
     */
    public int $deliveryType = 1;
    /**
     * 取件码开关
     * - 非必填项，0:关闭取件码，1:开启取件码，默认值为0。
     * - 注意:开启取件码时寄件人手机号需为11位标准手机号，若选择生成取件码，需在显著位置注明取件码，方便寄件人查看。闪送员将会在上门取件时索要取件码。
     * @var int
     */
    public int $pickupPwd = 0;
    /**
     * 收件码开关
     * - 非必填项，0:关闭收件码，1:开启收件码码，默认值为0。
     * - 注意:开启收件码时收件人手机号需为11位标准手机号
     * @var int
     */
    public int $deliveryPwd = 0;
    /**
     * 坐标类型
     * - 0：百度坐标系，1：国测局标准坐标系，非必填；默认为0
     * @var int
     */
    public int $lbsType = 0;
    /**
     * 发件人信息
     * @var OrderCalculateSender
     */
    public OrderCalculateSender $sender;
    /**
     * 收件人信息
     * @var OrderCalculateReceiverList|OrderCalculateReceiver[]|array
     */
    public OrderCalculateReceiverList $receiverList;

    /**
     * 必填项
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['cityName', 'appointType', 'sender', 'receiverList'];
    }
}
