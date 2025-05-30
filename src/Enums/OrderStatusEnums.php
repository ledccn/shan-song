<?php

namespace Ledc\ShanSong\Enums;

/**
 * 订单状态枚举、订单状态子状态枚举
 */
class OrderStatusEnums
{
    /**
     * 派单中（转单改派中）
     */
    const INT_20 = 20;
    /**
     * 待取货（已就位）
     */
    const INT_30 = 30;
    /**
     * 闪送中（申请取消中、物品送回中、取消单客服介入中）
     */
    const INT_40 = 40;
    /**
     * 已完成（已退款）
     */
    const INT_50 = 50;
    /**
     * 已经取消订单
     */
    const INT_60 = 60;
    /**
     * 派单中
     */
    const INT_20_SUB_1 = 1;
    /**
     * 转单改派中
     */
    const INT_20_SUB_2 = 2;
    /**
     * 待取货
     */
    const INT_30_SUB_1 = 1;
    /**
     * 已就位
     */
    const INT_30_SUB_2 = 2;
    /**
     * 闪送中
     */
    const INT_40_SUB_1 = 1;
    /**
     * 取消中
     */
    const INT_40_SUB_2 = 2;
    /**
     * 物品送回中
     */
    const INT_40_SUB_3 = 3;
    /**
     * 取消单客服介入中
     */
    const INT_40_SUB_4 = 4;
    /**
     * 已完成
     */
    const INT_50_SUB_1 = 1;
    /**
     * 已退款
     */
    const INT_50_SUB_2 = 2;

    /**
     * 获取订单状态枚举值
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::INT_20 => '派单中',
            self::INT_30 => '待取货',
            self::INT_40 => '闪送中',
            self::INT_50 => '已完成',
            self::INT_60 => '已取消',
        ];
    }

    /**
     * 获取订单状态子状态枚举值
     * @return string[][]
     */
    public static function subStatus(): array
    {
        return [
            self::INT_20 => self::getInt20SubStatus(),
            self::INT_30 => self::getInt30SubStatus(),
            self::INT_40 => self::getInt40SubStatus(),
            self::INT_50 => self::getInt50SubStatus(),
        ];
    }

    /**
     * 派单中（转单改派中）
     * @return string[]
     */
    public static function getInt20SubStatus(): array
    {
        return [
            self::INT_20_SUB_1 => '派单中',
            self::INT_20_SUB_2 => '转单改派中',
        ];
    }

    /**
     * 待取货（已就位）
     * @return string[]
     */
    public static function getInt30SubStatus(): array
    {
        return [
            self::INT_30_SUB_1 => '待取货',
            self::INT_30_SUB_2 => '已就位',
        ];
    }

    /**
     * 闪送中（申请取消中、物品送回中、取消单客服介入中）
     * @return string[]
     */
    public static function getInt40SubStatus(): array
    {
        return [
            self::INT_40_SUB_1 => '闪送中',
            self::INT_40_SUB_2 => '申请取消中',
            self::INT_40_SUB_3 => '物品送回中',
            self::INT_40_SUB_4 => '取消单客服介入中',
        ];
    }

    /**
     * 已完成（已退款）
     * @return string[]
     */
    public static function getInt50SubStatus(): array
    {
        return [
            self::INT_50_SUB_1 => '已完成',
            self::INT_50_SUB_2 => '已退款',
        ];
    }
}
