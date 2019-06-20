<?php

namespace Mix\Auth;

use Mix\Component\AbstractComponent;

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
    const ALGORITHM_HS384 = 'HS384';
    const ALGORITHM_HS512 = 'HS512';
    const ALGORITHM_RS256 = 'RS256';
    const ALGORITHM_RS384 = 'RS384';
    const ALGORITHM_RS512 = 'RS512';

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
     * @return array
     */
    public function parser($token)
    {
        switch ($this->algorithm) {
            case self::ALGORITHM_HS256:
            case self::ALGORITHM_HS384:
            case self::ALGORITHM_HS512:
                return (array)\Firebase\JWT\JWT::decode($token, $this->key, [$this->algorithm]);
                break;
            case self::ALGORITHM_RS256:
            case self::ALGORITHM_RS384:
            case self::ALGORITHM_RS512:
                return (array)\Firebase\JWT\JWT::decode($token, $this->publicKey, [$this->algorithm]);
                break;
            default:
                throw new \InvalidArgumentException('Invalid signature algorithm.');
        }
    }

    /**
     * 创建Token
     * @param array $payload
     * @return string
     */
    public function create(array $payload)
    {
        switch ($this->algorithm) {
            case self::ALGORITHM_HS256:
            case self::ALGORITHM_HS384:
            case self::ALGORITHM_HS512:
                return \Firebase\JWT\JWT::encode($payload, $this->key, $this->algorithm);
                break;
            case self::ALGORITHM_RS256:
            case self::ALGORITHM_RS384:
            case self::ALGORITHM_RS512:
                return \Firebase\JWT\JWT::encode($payload, $this->privateKey, $this->algorithm);
                break;
            default:
                throw new \InvalidArgumentException('Invalid signature algorithm.');
        }
    }

}
