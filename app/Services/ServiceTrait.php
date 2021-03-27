<?php


namespace App\Services;


trait ServiceTrait
{
    private $model;

    // Possibly delegate property access to the underlying model
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else if (property_exists($this->model, $name)) {
            return $this->model->$name;
        }
        return null;
    }

    // Possibly delegate method calls to the underlying model
    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array(array($this, $name), $arguments);
        } else if (method_exists($this->model, $name)) {
            return call_user_func_array(array($this->model, $name), $arguments);
        }
        throw new \BadMethodCallException();
    }
}
