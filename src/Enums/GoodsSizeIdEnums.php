<?php

namespace Ledc\ShanSong\Enums;

/**
 * 蛋糕尺寸枚举
 */
class GoodsSizeIdEnums
{
    /**
     * 4寸
     */
    const INT_1 = 1;
    /**
     * 6寸
     */
    const INT_2 = 2;
    /**
     * 8寸
     */
    const INT_3 = 3;
    /**
     * 10寸
     */
    const INT_4 = 4;
    /**
     * 12寸
     */
    const INT_5 = 5;
    /**
     * 14寸
     */
    const INT_6 = 6;
    /**
     * 16寸
     */
    const INT_7 = 7;
    /**
     * 20寸
     */
    const INT_8 = 8;
    /**
     * 多层
     */
    const INT_9 = 9;
    /**
     * 18寸
     */
    const INT_10 = 10;

    /**
     * 枚举说明列表
     */
    public static function cases(): array
    {
        return [
            self::INT_1 => '4寸',
            self::INT_2 => '6寸',
            self::INT_3 => '8寸',
            self::INT_4 => '10寸',
            self::INT_5 => '12寸',
            self::INT_6 => '14寸',
            self::INT_7 => '16寸',
            self::INT_8 => '20寸',
            self::INT_9 => '多层',
            self::INT_10 => '18寸',
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
