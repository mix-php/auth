<?php

namespace Mix\Auth;

/**
 * Class BearerToken
 * @package Mix\Auth
 */
class BearerToken implements BearerTokenInterface
{

    /**
     * 处理
     * @return bool|string
     */
    public function handle()
    {
        $authorization = app()->request->header('authorization');
        if (strpos($authorization, 'Bearer ') !== 0) {
            return false;
        }
        return substr($authorization, 7);
    }

}
