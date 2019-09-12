<?php

namespace Mix\Auth;

use Mix\Auth\Jwt;

/**
 * Class Authorization
 * @package Mix\Auth
 * @author liu,jian <coder.keda@gmail.com>
 */
class Authorization
{

    /**
     * jwt
     * @var Jwt
     */
    public $jwt;

    /**
     * Authorization constructor.
     * @param Jwt $jwt
     */
    public function __construct(Jwt $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * 获取有效荷载
     * @param TokenExtractorInterface $tokenExtractor
     * @return array
     */
    public function getPayload(TokenExtractorInterface $tokenExtractor)
    {
        $token = $tokenExtractor->extractToken();
        if (!$token) {
            throw new \InvalidArgumentException('Failed to extract token.');
        }
        return $this->jwt->parse($token);
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
