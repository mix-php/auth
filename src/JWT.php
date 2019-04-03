<?php

namespace Mix\Auth;

use Mix\Core\Component\AbstractComponent;

/**
 * Class JWT
 * @package Mix\Auth
 * @author liu,jian <coder.keda@gmail.com>
 */
class JWT extends AbstractComponent
{

    /**
     * 签名算法常量
     */
    const ALGORITHM_HS256 = 'HS256';
    const ALGORITHM_RS256 = 'RS256';

    /**
     * 钥匙
     * @var string
     */
    public $key = '';

    /**
     * 私钥
     * @var string
     */
    public $privateKey = '';

    /**
     * 公钥
     * @var string
     */
    public $publicKey = '';

    /**
     * 签名算法
     * @var string
     */
    public $algorithm = self::ALGORITHM_HS256;

    /**
     * 获取有效载荷
     * @param $token
     * @return object
     */
    public function parser($token)
    {
        switch ($this->algorithm) {
            case self::ALGORITHM_HS256:
                return \Firebase\JWT\JWT::decode($token, $this->key, ['HS256']);
                break;
            case self::ALGORITHM_RS256:
                return \Firebase\JWT\JWT::decode($token, $this->publicKey, ['RS256']);
                break;
            default:
                throw new \InvalidArgumentException('Invalid signature algorithm.');
        }
    }

    /**
     * 创建Token
     * @param $payload
     * @return string
     */
    public function create($payload)
    {
        switch ($this->algorithm) {
            case self::ALGORITHM_HS256:
                return \Firebase\JWT\JWT::encode($payload, $this->key, 'HS256');
                break;
            case self::ALGORITHM_RS256:
                return \Firebase\JWT\JWT::encode($payload, $this->privateKey, 'RS256');
                break;
            default:
                throw new \InvalidArgumentException('Invalid signature algorithm.');
        }
    }

}
