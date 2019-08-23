<?php

namespace Mix\Auth;

use Mix\Bean\BeanInjector;

/**
 * Class Authorization
 * @package Mix\Auth
 * @author liu,jian <coder.keda@gmail.com>
 */
class Authorization
{

    /**
     * token提取器
     * @var \Mix\Auth\TokenExtractorInterface
     */
    public $tokenExtractor;

    /**
     * jwt
     * @var \Mix\Auth\JWT
     */
    public $jwt;

    /**
     * Authorization constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        BeanInjector::inject($this, $config);
    }

    /**
     * 获取有效荷载
     * @return array
     */
    public function getPayload()
    {
        $token = $this->tokenExtractor->extractToken();
        if (!$token) {
            throw new \InvalidArgumentException('Failed to extract token.');
        }
        return $this->jwt->parser($token);
    }

    /**
     * 创建token
     * @param array $payload
     * @return string
     */
    public function createToken(array $payload)
    {
        return $this->jwt->create($payload);
    }

}
