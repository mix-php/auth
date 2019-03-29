<?php

namespace Mix\Auth;

/**
 * Class BearerTokenExtractor
 * @package Mix\Auth
 * @author liu,jian <coder.keda@gmail.com>
 */
class BearerTokenExtractor implements TokenExtractorInterface
{

    /**
     * 提取token
     * @return bool|string
     */
    public function extractToken()
    {
        $authorization = app()->request->header('authorization');
        if (strpos($authorization, 'Bearer ') !== 0) {
            return false;
        }
        return substr($authorization, 7);
    }

}
