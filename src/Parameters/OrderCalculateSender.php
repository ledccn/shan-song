<?php

namespace Ledc\ShanSong\Parameters;

use Ledc\SupportSdk\Parameters;

/**
 * 寄件人信息
 */
class OrderCalculateSender extends Parameters
{
    /**
     * 必填：寄件地址
     * @var string
     */
    public string $fromAddress;
    /**
     * 寄件详细地址
     * @var string
     */
    public string $fromAddressDetail = '';
    /**
     * 必填：寄件人姓名
     * @var string
     */
    public string $fromSenderName;
    /**
     * 必填：寄件联系人
     * @var string
     */
    public string $fromMobile;
    /**
     * 必填：寄件纬度
     * @var string
     */
    public string $fromLatitude;
    /**
     * 必填：寄件经度
     * @var string
     */
    public string $fromLongitude;

    /**
     * 必填项
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['fromAddress', 'fromSenderName', 'fromMobile', 'fromLatitude', 'fromLongitude'];
    }
}