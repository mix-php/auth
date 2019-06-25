<?php

namespace Mix\Auth;

use Mix\Http\Message\Request\HttpRequestInterface;

/**
 * Class BearerTokenExtractor
 * @package Mix\Auth
 * @author liu,jian <coder.keda@gmail.com>
 */
class BearerTokenExtractor implements TokenExtractorInterface
{

    /**
     * @var HttpRequestInterface
     */
    public $request;

    /**
     * 提取token
     * @return bool|string
     */
    public function extractToken()
    {
        $authorization = $this->request->header('authorization');
        if (strpos($authorization, 'Bearer ') !== 0) {
            return false;
        }
        return substr($authorization, 7);
    }

}
