<?php

namespace Mix\Auth;

use Mix\Core\Component\AbstractComponent;

/**
 * Class Authorization
 * @author LIUJIAN <coder.keda@gmail.com>
 * @package Mix\Auth
 */
class Authorization extends AbstractComponent
{

    /**
     * BearerToken
     * @var \Mix\Auth\BearerTokenInterface
     */
    public $bearerToken;

    /**
     * jwt
     * @var \Mix\Auth\JWT
     */
    public $jwt;

    /**
     * 获取有效荷载
     * @return array
     */
    public function getPayload()
    {
        $token = $this->bearerToken->handle();
        if (!$token) {
            throw new \InvalidArgumentException('Failed to get bearer token.');
        }
        return $this->jwt->parser($token);
    }

    /**
     * 创建token
     * @param $payload
     * @return string
     */
    public function createToken($payload)
    {
        return $this->jwt->create($payload);
    }

}
