<?php

namespace Xcms\Nav\Support;

class NavSupport
{
    /**
     * @var array
     */
    protected $objectInfoByType = [];

    /**
     * @param $type
     * @param \Closure $callback
     * @return $this
     */
    public function registerLinkType($type, \Closure $callback)
    {
        $this->objectInfoByType[$type] = $callback;
        return $this;
    }

    /**
     * @param $type
     * @param array ...$params
     * @return array|null
     */
    public function getObjectInfoByType($type, ...$params)
    {
        if (!array_get($this->objectInfoByType, $type)) {
            return null;
        }
        $result = call_user_func_array($this->objectInfoByType[$type], $params);

        return (array)$result;
    }
}
