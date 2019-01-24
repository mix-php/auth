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
     * 获取
     * @return string|bool
     */
    public function get();

    /**
     * 创建
     * @return string
     */
    public function create();

}
