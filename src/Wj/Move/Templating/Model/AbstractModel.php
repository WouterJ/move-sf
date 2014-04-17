<?php

namespace Wj\Move\Templating\Model;

abstract class AbstractModel implements ViewModel
{
    private $source;
    private $parameters = array();

    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    public function addParameter($name, $value)
    {
        $this->parameters[$name] = $value;

        return $this;
    }

    public function addParameters(array $parameters)
    {
        foreach ($parameters as $name => $value) {
            $this->addParameter($name, $value);
        }

        return $this;
    }

    protected function getParameters()
    {
        return $this->parameters;
    }
}
