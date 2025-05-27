<?php

namespace Ledc\ShanSong\Enums;

/**
 * 订单来源枚举
 */
class OrderingSourceTypeEnums
{
    /**
     * 闪送
     */
    const INT_1 = 1;
    /**
     * 百度外卖
     */
    const INT_2 = 2;
    /**
     * 饿了么外卖
     */
    const INT_3 = 3;
    /**
     * 美团外卖
     */
    const INT_4 = 4;
    /**
     * 其他平台
     */
    const INT_5 = 5;
    /**
     * 京东到家
     */
    const INT_6 = 6;
    /**
     * 达达
     */
    const INT_7 = 7;
    /**
     * 饿百
     */
    const INT_8 = 8;

    /**
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::INT_1 => '闪送',
            self::INT_2 => '百度外卖',
            self::INT_3 => '饿了么外卖',
            self::INT_4 => '美团外卖',
            self::INT_5 => '其他平台',
            self::INT_6 => '京东到家',
            self::INT_7 => '达达',
            self::INT_8 => '饿百',
        ];
    }

    /**
     * 枚举列表
     * @return array
     */
    public static function list(): array
    {
        $rs = [];
        foreach (self::cases() as $value => $name) {
            $rs[] = compact('name', 'value');
        }
        return $rs;
    }
}
