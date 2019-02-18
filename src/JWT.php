<?php

namespace Mix\Auth;

use Mix\Core\Component\Component;

/**
 * Class JWT
 * @author LIUJIAN <coder.keda@gmail.com>
 * @package Mix\Auth
 */
class JWT extends Component
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
     * @return array
     */
    public function parser($token)
    {
        switch ($this->algorithm) {
            case self::ALGORITHM_HS256:
                return (array)\Firebase\JWT\JWT::decode($token, $this->key, ['HS256']);
                break;
            case self::ALGORITHM_RS256:
                return (array)\Firebase\JWT\JWT::decode($token, $this->publicKey, ['RS256']);
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
