<?php

namespace Ledc\ShanSong;

use RuntimeException;

/**
 * 闪送HttpClient
 * @author david <367013672@qq.com>
 */
trait HttpClient
{
    /**
     * 闪送配置
     * @var Config
     */
    private Config $config;

    /**
     * 获取闪送配置
     * @return Config
     */
    final public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * 设置闪送配置
     * @param Config $config
     */
    final protected function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    /**
     * 获取基础URL
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->getConfig()->getBaseUrl();
    }

    /**
     * 获取系统参数
     * @return array
     */
    public function getSystemParams(): array
    {
        return $this->getConfig()->getSystemParams();
    }

    /**
     * 签名参数
     * @param array $data
     * @return array
     */
    public function signatureParams(array $data): array
    {
        $params = $this->getSystemParams();
        if ($data) {
            $params['data'] = json_encode($data);
        }
        $params['sign'] = Config::generateSignature($params, $this->getConfig()->getAppSecret());

        return $params;
    }

    /**
     * 使用CURL发送GET请求
     * @param string $uri 请求的uri
     * @param array $data 业务参数
     * @return array
     */
    final public function get(string $uri, array $data = []): array
    {
        return $this->parseHttpResponse($this->request($uri, $data, 'GET', ['timeout' => 10]));
    }

    /**
     * 使用CURL发送GET请求
     * @param string $uri 请求的uri
     * @param array $data 业务参数
     * @return array
     */
    final public function post(string $uri, array $data = []): array
    {
        return $this->parseHttpResponse($this->request($uri, $data, 'POST', ['timeout' => 10]));
    }

    /**
     * 使用CURL发送请求
     * @param string $uri 请求的uri
     * @param array $data 业务参数
     * @param string $method 请求方法
     * @param array $options curl参数
     * @return HttpResponse
     */
    final public function request(string $uri, array $data = [], string $method = 'POST', array $options = []): HttpResponse
    {
        // 过滤非必传的空值
        $data = array_filter($data, function ($value) {
            return null !== $value && '' !== $value;
        });

        $url = $this->getBaseUrl() . $uri;
        $params = $this->signatureParams($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded; charset=utf-8']);
        if (parse_url($url, PHP_URL_SCHEME) === 'https') {
            //false 禁止 cURL 验证对等证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //0 时不检查名称（SSL 对等证书中的公用名称字段或主题备用名称（Subject Alternate Name，简称 SNA）字段是否与提供的主机名匹配）
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if ('GET' === $method) {
            $url .= '?' . http_build_query($params);
        } else {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $options['timeout'] ?? 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, $options['timeout'] ?? 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    // 自动跳转，跟随请求Location
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);         // 递归次数
        $response = curl_exec($ch);
        $result = new HttpResponse(
            $response,
            (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE),
            curl_errno($ch),
            curl_error($ch)
        );
        curl_close($ch);

        return $result;
    }

    /**
     * 解析HTTP响应
     * @param HttpResponse $httpResponse
     * @return array
     */
    final public function parseHttpResponse(HttpResponse $httpResponse): array
    {
        if ($httpResponse->isFailed()) {
            throw new RuntimeException('CURL请求闪送接口失败：' . $httpResponse->toJson(JSON_UNESCAPED_UNICODE));
        }

        $response = json_decode($httpResponse->getResponse(), true);
        $status = $response['status'] ?? 0;
        $msg = $response['msg'] ?? '';
        if (200 === $status) {
            return $response['data'] ?? [];
        }

        throw new RuntimeException('闪送接口返回错误：' . $msg);
    }
}
