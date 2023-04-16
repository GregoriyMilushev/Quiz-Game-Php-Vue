<?php

class Request
{
    protected $input;

    public function __construct()
    {
        $this->input = array_merge($_GET, $_POST, $_SERVER);
    }

    public function all()
    {
        return $this->input;
    }

    public function get($key, $default = null)
    {
        return isset($this->input[$key]) ? $this->input[$key] : $default;
    }

    public function has($key)
    {
        return isset($this->input[$key]);
    }

    public function only($keys)
    {
        $values = array_intersect_key($this->input, array_flip((array) $keys));
        return array_merge(array_fill_keys((array) $keys, null), $values);
    }

    public function except($keys)
    {
        return array_diff_key($this->input, array_flip((array) $keys));
    }
}