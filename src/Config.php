<?php

namespace Ledc\ShanSong;

use JsonSerializable;

/**
 * 闪送配置类
 * @author david <367013672@qq.com>
 * @document https://open.ishansong.com
 */
class Config implements JsonSerializable
{
    /**
     * 配置项前缀
     */
    public const CONFIG_PREFIX = 'shansong_';
    /**
     * 必须的配置项
     */
    public const REQUIRE_KEYS = [
        'shopId',
        'clientId',
        'appSecret',
        'testShopId',
        'debug',
        'enabled',
    ];
    /**
     * 测试环境地址
     * @var string
     */
    public const TEST_BASE_URL = 'http://open.s.bingex.com';
    /**
     * 生产环境地址
     * @var string
     */
    public const PROD_BASE_URL = 'https://open.ishansong.com';
    /**
     * 商户ID
     * - 去账户中心->应用信息查看
     * @var string
     */
    protected string $shopId;
    /**
     * App-key
     * - 去账户中心->应用信息查看
     * @var string
     */
    protected string $clientId;
    /**
     * App-secret
     * - 去账户中心->应用信息查看
     * @var string
     */
    protected string $appSecret;
    /**
     * 测试环境商户ID
     * @var string
     */
    protected string $testShopId = '';
    /**
     * 是否调试模式
     * @var bool true:测试环境，false:生产环境
     */
    protected bool $debug = false;
    /**
     * 是否启用
     * @var bool
     */
    protected bool $enabled = false;

    /**
     * 构造函数
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * 获取商户ID
     * @return string
     */
    public function getShopId(): string
    {
        return $this->shopId;
    }

    /**
     * 获取App-key
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * 获取App-secret
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * 获取测试环境商户ID
     * @return string
     */
    public function getTestShopId(): string
    {
        return $this->testShopId;
    }

    /**
     * 是否调试模式
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * 获取接口地址
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->isDebug() ? self::TEST_BASE_URL : self::PROD_BASE_URL;
    }

    /**
     * 获取基础系统参数
     * @return array
     */
    public function getSystemParams(): array
    {
        return [
            'clientId' => $this->getClientId(),
            'shopId' => $this->autoShopId(),
            'timestamp' => self::generateTimestamp(),
        ];
    }

    /**
     * 自动获取商户ID
     * - 根据是否调试模式自动获取
     * @return string
     */
    public function autoShopId(): string
    {
        return $this->isDebug() ? $this->getTestShopId() : $this->getShopId();
    }

    /**
     * 是否启用
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    /**
     * 转数组
     * @return array
     */
    public function toArray(): array
    {
        return $this->jsonSerialize();
    }

    /**
     * 转字符串
     * @param int $options
     * @return string
     */
    public function toJson(int $options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * 转字符串
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * 获取毫秒时间戳（13位）
     * @return int
     */
    public static function generateTimestamp(): int
    {
        return microtime(true) * 1000;
    }

    /**
     * 获取签名字符串
     * @param array $params 所有 body 参数
     * @param string $appSecret App-secret
     * @return string
     */
    public static function generateSignature(array $params, string $appSecret): string
    {
        // 将集合 M 内非空参数以字典序升序（忽略大小写）排列拼接成键值格式的字符串
        $params = array_filter($params, function ($value) {
            return !is_null($value) && $value !== '';
        });
        ksort($params);
        $original = '';
        foreach ($params as $key => $value) {
            $original .= $key . $value;
        }

        //  将密钥拼接到前面
        $original = $appSecret . $original;

        // 计算MD5，得到签名（32位大写）
        return strtoupper(md5($original));
    }
}
