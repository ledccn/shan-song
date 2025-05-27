<?php

namespace Ledc\ShanSong\Enums;

/**
 * 物品类型标签枚举
 */
class GoodTypeEnums
{
    /**
     * 文件
     */
    const INT_1 = 1;
    /**
     * 数码
     */
    const INT_3 = 3;
    /**
     * 蛋糕
     */
    const INT_5 = 5;
    /**
     * 餐饮
     */
    const INT_6 = 6;
    /**
     * 鲜花
     */
    const INT_7 = 7;
    /**
     * 汽配
     */
    const INT_9 = 9;
    /**
     * 其他
     */
    const INT_10 = 10;
    /**
     * 母婴
     */
    const INT_12 = 12;
    /**
     * 医药健康
     */
    const INT_13 = 13;
    /**
     * 商超
     */
    const INT_15 = 15;
    /**
     * 水果
     */
    const INT_16 = 16;

    /**
     * 枚举列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::INT_1 => '文件',
            self::INT_3 => '数码',
            self::INT_5 => '蛋糕 ',
            self::INT_6 => '餐饮',
            self::INT_7 => '鲜花',
            self::INT_9 => '汽配',
            self::INT_10 => '其他',
            self::INT_12 => '母婴',
            self::INT_13 => '医药健康',
            self::INT_15 => '商超',
            self::INT_16 => '水果',
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
