<?php

namespace Mix\Auth;

/**
 * Interface BearerTokenInterface
 * @author LIUJIAN <coder.keda@gmail.com>
 * @package Mix\Auth
 */
interface BearerTokenInterface
{

    /**
     * 处理
     * @return bool|string
     */
    public function handle();

}
