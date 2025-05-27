<?php

namespace Ledc\ShanSong\Enums;

/**
 * 费用明细类型枚举
 */
class FeeInfoTypeEnums
{
    /**
     * 里程费
     */
    const INT_1 = 1;
    /**
     * 续重费
     */
    const INT_2 = 2;
    /**
     * 交通费
     */
    const INT_3 = 3;
    /**
     * 夜间费
     */
    const INT_7 = 7;
    /**
     * 上门费
     */
    const INT_8 = 8;
    /**
     * 加价费
     */
    const INT_9 = 9;
    /**
     * 溢价费
     */
    const INT_10 = 10;
    /**
     * 跨江费
     */
    const INT_12 = 12;
    /**
     * 保价费
     */
    const INT_15 = 15;
    /**
     * 平台服务费
     */
    const INT_16 = 16;
    /**
     * 预约费
     */
    const INT_18 = 18;
    /**
     * 偏远地区费
     */
    const INT_21 = 21;
    /**
     * 增值服务费
     */
    const INT_24 = 24;
    /**
     * 服务费
     */
    const INT_25 = 25;
    /**
     * 加价调度费
     */
    const INT_26 = 26;
    /**
     * 尊享送服务费
     */
    const INT_108 = 108;

    /**
     * 枚举列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::INT_1 => '里程费',
            self::INT_2 => '续重费',
            self::INT_3 => '交通费',
            self::INT_7 => '夜间费',
            self::INT_8 => '上门费',
            self::INT_9 => '加价费',
            self::INT_10 => '溢价费',
            self::INT_12 => '跨江费',
            self::INT_15 => '保价费',
            self::INT_16 => '平台服务费',
            self::INT_18 => '预约费',
            self::INT_21 => '偏远地区费',
            self::INT_24 => '增值服务费',
            self::INT_25 => '服务费',
            self::INT_26 => '加价调度费',
            self::INT_108 => '尊享送服务费',
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
