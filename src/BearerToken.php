<?php

namespace Mix\Auth;

use Mix\Helpers\RandomStringHelper;

/**
 * Class BearerToken
 * @author LIUJIAN <coder.keda@gmail.com>
 * @package Mix\Auth
 */
class BearerToken implements BearerTokenInterface
{

    /**
     * 获取
     * @return string|bool
     */
    public function get()
    {
        // TODO: Implement get() method.
        $authorization = app()->request->header('authorization');
        if (strpos($authorization, 'Bearer ') !== 0) {
            return false;
        }
        return substr($authorization, 7);
    }

    /**
     * 创建
     * @return string
     */
    public function create()
    {
        // TODO: Implement create() method.
        return RandomStringHelper::randomAlphanumeric(32);
    }

}
