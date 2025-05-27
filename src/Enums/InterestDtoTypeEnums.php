<?php

namespace Ledc\ShanSong\Enums;

/**
 * 增值服务明细类型枚举
 */
class InterestDtoTypeEnums
{
    /**
     * 保价
     */
    public const INT_15 = 15;
    /**
     * 蛋糕专送
     */
    public const INT_103 = 103;
    /**
     * 餐饮专送
     */
    public const INT_107 = 107;
    /**
     * 品质专送、尊享送
     */
    public const INT_108 = 108;

    /**
     * 枚举列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::INT_15 => '保价',
            self::INT_103 => '蛋糕专送',
            self::INT_107 => '餐饮专送',
            self::INT_108 => '品质专送、尊享送',
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