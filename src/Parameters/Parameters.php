<?php

namespace Ledc\ShanSong\Parameters;

use InvalidArgumentException;
use JsonSerializable;

/**
 * 参数抽象类
 */
abstract class Parameters implements JsonSerializable
{
    /**
     * 构造函数
     * @param array $properties
     * @return void
     */
    public function __construct(array $properties = [])
    {
        foreach ($properties as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * 转数组
     * @return array
     */
    public function jsonSerialize(): array
    {
        $properties = [];
        $excludesKeys = $this->getExcludesKeys();
        $items = $this->filterEmptyValues(get_object_vars($this));
        foreach ($items as $key => $value) {
            // 排除的keys
            if (in_array($key, $excludesKeys, true)) {
                continue;
            }

            if ($value instanceof JsonSerializable) {
                $properties[$key] = $value->jsonSerialize();
            } else {
                $properties[$key] = $value;
            }
        }

        return $this->checkMissingKeys($properties);
    }

    /**
     * 过滤空值
     * @param array $properties
     * @return array
     */
    protected function filterEmptyValues(array $properties): array
    {
        return array_filter($properties, fn($value) => !is_null($value) && '' !== $value && [] !== $value);
    }

    /**
     * 验证必填参数
     * @param array $properties
     * @return array
     */
    private function checkMissingKeys(array $properties): array
    {
        $requiredKeys = $this->getRequiredKeys();
        if (!empty($requiredKeys)) {
            $missingKeys = [];
            foreach ($requiredKeys as $key) {
                if (!isset($properties[$key])) {
                    $missingKeys[] = $key;
                }
            }

            if (!empty($missingKeys)) {
                throw new InvalidArgumentException("缺少必填参数：" . implode(',', $missingKeys));
            }
        }

        return $properties;
    }

    /**
     * 获取必填的key
     * @return array
     */
    abstract protected function getRequiredKeys(): array;

    /**
     * 获取排除的key
     * @return array
     */
    protected function getExcludesKeys(): array
    {
        return [];
    }
}
