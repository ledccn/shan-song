<?php

namespace Ledc\ShanSong;

use Ledc\ShanSong\Parameters\OrderCalculate;

/**
 * 闪送自营商户
 * @author david <367013672@qq.com>
 * @document  https://open.ishansong.com/joinGuide
 */
class Merchant
{
    use HttpClient;

    /**
     * 构造函数
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->setConfig($config);
    }

    /**
     * 查询开通城市
     * - 商户可以用来判断城市是否开通闪送服务，供订单计费使用。开通城市基本不变，建议商户存储到本地并且定时查询进行更新。
     * @link https://open.ishansong.com/joinGuide/277
     * @return array
     */
    public function openCitiesLists(): array
    {
        return $this->post('/openapi/merchants/v5/openCitiesLists');
    }

    /**
     * 分页查询商户店铺
     * - 分页查询商户创建店铺，供订单计费使用；仅状态为审核通过的店铺可计费使用
     * @link https://open.ishansong.com/joinGuide/278
     * @param int $pageNo 页码，最小值为1
     * @param int $pageSize 每页数量，最小值为1最大值为100
     * @param string $storeName 根据店铺名称模糊搜索
     * @return array
     */
    public function queryAllStores(int $pageNo = 1, int $pageSize = 20, string $storeName = ''): array
    {
        return $this->post('/openapi/merchants/v5/queryAllStores', [
            'pageNo' => $pageNo,
            'pageSize' => $pageSize,
            'storeName' => $storeName
        ]);
    }

    /**
     * 查询城市可指定的交通工具
     * - 接口说明：查询城市可指定的交通工具，订单计费的时候选择使用，指定交通工具会产生交通费。
     * - 指定交通工具包括“优先”和“只要”：
     * - 选择“优先”某交通工具，会优先调度使用该交通工具的闪送员，若附近无使用该工具的闪送员接单，则会按其他交通工具配送，订单完成后会将交通费原路退回；
     * - 选择“只要”某交通工具，会仅调度使用该交通工具的闪送员，若附近无使用该工具的闪送员，30分钟后订单自动取消。
     * @link https://open.ishansong.com/joinGuide/280
     * @param int $cityId 查询开通城市接口获取，对应id字段
     * @return array
     */
    public function optionalTravelWay(int $cityId): array
    {
        return $this->post('/openapi/merchants/v5/optionalTravelWay', [
            'cityId' => $cityId
        ]);
    }

    /**
     * 订单计费
     * - 用来进行计费使用，可以理解为下单询价。需要注意的是计费和真正支付的金额可能存在不一样。
     * - 测试环境的计费规则是随意配置的，一切订单计价的费用以线上为准，理论上测试环境只要能够计费成功就可以。
     * @link https://open.ishansong.com/joinGuide/281
     * @param OrderCalculate $data
     * @return array
     */
    public function orderCalculate(OrderCalculate $data): array
    {
        return $this->post('/openapi/merchants/v5/orderCalculate', $data->jsonSerialize());
    }

    /**
     * 提交订单
     * - 测试环境的计费规则是随意配置的，一切提交订单的费用以线上为准，理论上测试环境只要能够提交订单成功就可以。
     * @link https://open.ishansong.com/joinGuide/282
     * @param string $issOrderNo 闪送订单号
     * @return array
     */
    public function orderPlace(string $issOrderNo): array
    {
        return $this->post('/openapi/merchants/v5/orderPlace', [
            'issOrderNo' => $issOrderNo
        ]);
    }

    /**
     * 订单加价
     * - 下单后，如果没有骑手接单，可以调用此接口进行加价，使用该接口会增加骑手接单概率。
     * @link https://open.ishansong.com/joinGuide/283
     * @param string $issOrderNo 闪送订单号
     * @param int $additionAmount 加价金额（单位：分，只传递增加金额的部分，只能传递被100整除的数字，200即2元，最大值为10000）
     * @return array
     */
    public function addition(string $issOrderNo, int $additionAmount): array
    {
        return $this->post('/openapi/merchants/v5/addition', [
            'issOrderNo' => $issOrderNo,
            'additionAmount' => $additionAmount
        ]);
    }

    /**
     * 查询订单详情
     * - 用来获取订单的状态，接单后可以获取闪送员的信息以及轨迹等。
     * - 请注意，订单状态可能存在回退的情况。
     * @link https://open.ishansong.com/joinGuide/284
     * @param string $issOrderNo 闪送订单号
     * @param string $thirdOrderNo 第三方平台流水号（计费接口中orderNo字段保持一致）
     * @return array
     */
    public function orderInfo(string $issOrderNo, string $thirdOrderNo): array
    {
        return $this->post('/openapi/merchants/v5/orderInfo', [
            'issOrderNo' => $issOrderNo,
            'thirdOrderNo' => $thirdOrderNo
        ]);
    }

    /**
     * 查询闪送员位置信息
     * - 订单接单后获取相关闪送员的信息。
     * @link https://open.ishansong.com/joinGuide/285
     * @param string $issOrderNo 闪送订单号
     * @return array
     */
    public function courierInfo(string $issOrderNo): array
    {
        return $this->post('/openapi/merchants/v5/courierInfo', [
            'issOrderNo' => $issOrderNo
        ]);
    }

    /**
     * 查询订单续重加价金额
     * - 下单计费后对订单进行续重使用。
     * @link https://open.ishansong.com/joinGuide/286
     * @param string $issOrderNo 闪送订单号
     * @param string $weight 续重重量（单位：kg，传向上取整整数，最大重量不超过50kg，例如：6.7kg传7；）
     * @return array
     */
    public function calculateOrderAddWeightFee(string $issOrderNo, string $weight): array
    {
        return $this->post('/openapi/merchants/v5/calculateOrderAddWeightFee', [
            'issOrderNo' => $issOrderNo,
            'weight' => $weight
        ]);
    }

    /**
     * 支付订单续重费用
     * @link https://open.ishansong.com/joinGuide/287
     * @param string $issOrderNo 闪送订单号
     * @param string $payAmount 支付金额（单位：分）
     * @param string $weight 重量（单位：kg）
     * @return array
     */
    public function payAddWeightFee(string $issOrderNo, string $payAmount, string $weight): array
    {
        return $this->post('/openapi/merchants/v5/payAddWeightFee', [
            'issOrderNo' => $issOrderNo,
            'payAmount' => $payAmount,
            'weight' => $weight
        ]);
    }

    /**
     * 订单预取消
     * - 想要取消订单的时候，获取需要扣除的费用。需要注意的是，可能和取消时真正扣除的费用不一致，比如达到扣费临界值的情况。
     * @link https://open.ishansong.com/joinGuide/288
     * @param string $issOrderNo 闪送订单号
     * @return array
     */
    public function preAbortOrder(string $issOrderNo): array
    {
        return $this->post('/openapi/merchants/v5/preAbortOrder', [
            'issOrderNo' => $issOrderNo
        ]);
    }

    /**
     * 订单取消
     * - 取件后取消订单，会按照骑手将物品送回的往返里程计算取消费，当取消费大于订单实付金额时，会产生送回费，需用户额外支付；
     * - 此时若deductFlag是否同意扣除余额选择false，即不同意时，会导致取消失败。
     * @link https://open.ishansong.com/joinGuide/289
     * @param string $issOrderNo 闪送订单号
     * @param bool $deductFlag 是否同意扣除余额  true:同意，false:不同意，默认false
     * @return array
     */
    public function abortOrder(string $issOrderNo, bool $deductFlag = false): array
    {
        return $this->post('/openapi/merchants/v5/abortOrder', [
            'issOrderNo' => $issOrderNo,
            'deductFlag' => $deductFlag
        ]);
    }

    /**
     * 确认物品送回
     * - 订单在闪送员取件后用户申请取消，调用了订单取消接口后，订单的状态是40（闪送中），在闪送员把物品送回后，调用该接口，订单状态流转到60（已取消）。
     * @link https://open.ishansong.com/joinGuide/290
     * @param string $issOrderNo 闪送订单号
     * @return array
     */
    public function confirmGoodsReturn(string $issOrderNo): array
    {
        return $this->post('/openapi/merchants/v5/confirmGoodsReturn', [
            'issOrderNo' => $issOrderNo
        ]);
    }

    /**
     * 店铺操作（新增店铺、修改店铺）
     * - 新增店铺接口不支持并发调用，一个请求返回结果后才能进行下一次请求。
     * @link https://open.ishansong.com/joinGuide/291
     * @link https://open.ishansong.com/joinGuide/292
     * @param array $data 业务参数
     * @return array
     */
    public function storeOperation(array $data): array
    {
        return $this->post('/openapi/merchants/v5/storeOperation', $data);
    }

    /**
     * 查询账号额度
     * @link https://open.ishansong.com/joinGuide/293
     * @return array
     */
    public function getUserAccount(): array
    {
        return $this->post('/openapi/merchants/v5/getUserAccount');
    }

    /**
     * 修改收件人手机号
     * - 订单下单时收件人手机号错误，可修改收件人手机号。
     * @link https://open.ishansong.com/joinGuide/295
     * @param string $issOrderNo 闪送订单号
     * @param string $thirdOrderNo 第三方平台流水号
     * @param string $newToMobile 新收件人手机号
     * @return array
     */
    public function updateToMobile(string $issOrderNo, string $thirdOrderNo, string $newToMobile): array
    {
        return $this->post('/openapi/merchants/v5/updateToMobile', [
            'issOrderNo' => $issOrderNo,
            'thirdOrderNo' => $thirdOrderNo,
            'newToMobile' => $newToMobile
        ]);
    }

    /**
     * 批量新增店铺
     * - 每次最多批量新增10个店铺。
     * @link https://open.ishansong.com/joinGuide/349
     * @param array $data 业务参数
     * @return array
     */
    public function addStores(array $data): array
    {
        return $this->post('/openapi/merchants/v5/addStores', $data);
    }

    /**
     * 查询订单ETA
     * - 下单前获取订单ETA，比如：预计接单耗时、预计取件耗时、预计完单耗时、取件附近闪送员数量。
     * @link https://open.ishansong.com/joinGuide/354
     * @param array $data 业务参数
     * @return array
     */
    public function orderEta(array $data): array
    {
        return $this->post('/openapi/merchants/v5/orderEta', $data);
    }

    /**
     * 订单追单
     * - 支持将待接单的订单追加到同一个店铺下另一个订单状态为：已就位的订单上；
     * - 一个闪送员最多可接3单。
     * @link https://open.ishansong.com/joinGuide/476
     * @param string $orderNumber 待接单闪送订单号
     * @param string $appendOrderNumber 已接单闪送订单号
     * @return array
     */
    public function appendOrder(string $orderNumber, string $appendOrderNumber): array
    {
        return $this->post('/openapi/merchants/v5/appendOrder', [
            'orderNumber' => $orderNumber,
            'appendOrderNumber' => $appendOrderNumber
        ]);
    }

    /**
     * 查询是否支持尊享送
     * @link https://open.ishansong.com/joinGuide/460
     * @param string $cityName 城市名字
     * @return array
     */
    public function qualityDeliverySwitch(string $cityName): array
    {
        return $this->post('/openapi/merchants/v5/qualityDeliverySwitch', [
            'cityName' => $cityName
        ]);
    }

    /**
     * 查询尊享送达成状态
     * @link https://open.ishansong.com/joinGuide/461
     * @param string $issOrderNo 闪送订单号
     * @return array
     */
    public function qualityDeliveryStatus(string $issOrderNo): array
    {
        return $this->post('/openapi/merchants/v5/qualityDeliveryStatus', [
            'issOrderNo' => $issOrderNo
        ]);
    }

    /**
     * 魔法方法
     * @param string $method
     * @param array $arguments
     * @return array
     */
    public function __call(string $method, array $arguments): array
    {
        return $this->post('/openapi/merchants/v5/' . $method, $arguments[0] ?? []);
    }
}
