<?php

namespace Ledc\ShanSong;

/**
 * 坐标转换
 */
class Conversion
{
    /**
     * 腾讯、谷歌、高德 转换为 百度经纬度
     * @param string $lng 经度
     * @param string $lat 维度
     * @return float[]
     */
    public static function GCJ02ToBD09(string $lng, string $lat): array
    {
        $x_PI = 3.14159265358979324 * 3000.0 / 180.0;
        $z = sqrt($lng * $lng + $lat * $lat) + 0.00002 * sin($lat * $x_PI);
        $theta = atan2($lat, $lng) + 0.000003 * cos($lng * $x_PI);
        $bd_lng = $z * cos($theta) + 0.0065;
        $bd_lat = $z * sin($theta) + 0.006;
        return ['latitude' => $bd_lat, 'longitude' => $bd_lng];
    }

    /**
     * 百度经纬度 转换为 腾讯、谷歌、高德
     * @param string $bd_lng 经度
     * @param string $bd_lat 维度
     * @return float[]
     */
    public static function BD09ToGCJ02(string $bd_lng, string $bd_lat): array
    {
        $x_pi = 3.14159265358979324 * 3000.0 / 180.0;
        $x = $bd_lng - 0.0065;
        $y = $bd_lat - 0.006;
        $z = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);
        $gg_lng = $z * cos($theta);
        $gg_lat = $z * sin($theta);
        return ['latitude' => $gg_lat, 'longitude' => $gg_lng];
    }
}
