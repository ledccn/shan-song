<?php

namespace Ledc\ShanSong\Enums;

/**
 * 预约类型枚举类
 */
class AppointTypeEnums
{
    /**
     * 立即单
     */
    public const IMMEDIATELY = 0;
    /**
     * 预约单
     */
    public const APPOINTMENT = 1;

    /**
     * 枚举说明列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::IMMEDIATELY => '立即单',
            self::APPOINTMENT => '预约单',
        ];
    }

    /**
     * 验证枚举值是否有效
     * @param int $value
     * @return bool
     */
    public static function isValid(int $value): bool
    {
        return array_key_exists($value, self::cases());
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
