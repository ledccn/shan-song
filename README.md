# 说明

闪送开放平台，自营商户SDK

## 安装

`composer require ledc/shan-song`

## 使用说明

开箱即用，只需要传入一个配置，初始化一个实例即可：

```php
use Ledc\ShanSong\Config;
use Ledc\ShanSong\Merchant;

//更多配置项，可以查看 配置管理类的属性 Ledc\ShanSong\Config
$config = [
    'shopId' => '',
    'clientId' => '',
    'appSecret' => '',
    'testShopId' => '',
    'debug' => true,
    'enabled' => true,
];

$merchant = new Merchant(new Config($config));
```

在创建实例后，所有的方法都可以由IDE自动补全；例如：

```php
/** @var \Ledc\ShanSong\Merchant $merchant */
// 查询开通城市
$merchant->openCitiesLists();

// 分页查询商户店铺
$merchant->queryAllStores();

// 查询城市可指定的交通工具
$merchant->optionalTravelWay();

// 订单计费
$merchant->orderCalculate();

// 提交订单
$merchant->orderPlace();

// 订单加价
$merchant->addition();

// 查询订单详情
$merchant->orderInfo();

// 查询闪送员位置信息
$merchant->courierInfo();

// 查询订单续重加价金额
$merchant->calculateOrderAddWeightFee();

// 支付订单续重费用
$merchant->payAddWeightFee();

// 订单预取消
$merchant->preAbortOrder();

// 订单取消
$merchant->abortOrder();

// 确认物品送回
$merchant->confirmGoodsReturn();

// 店铺操作（新增店铺、修改店铺）
$merchant->storeOperation();

// 查询账号额度
$merchant->getUserAccount();

// 修改收件人手机号
$merchant->updateToMobile();

// 批量新增店铺
$merchant->addStores();

// 更多...
```

## 二次开发

配置管理类：`Ledc\ShanSong\Config`

闪送自营商户：`Ledc\ShanSong\Merchant`

闪送HttpClient：`Ledc\ShanSong\HttpClient`，您可以引入该特性自定义HttpClient。

## 官方文档

https://open.ishansong.com/joinGuide

## 捐赠

![reward](reward.png)