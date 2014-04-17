<?php

namespace Wj\Move\Templating\Model;

interface ViewModel
{
    public function setSource($source);
    public function addParameter($name, $value);
    public function addParameters(array $parameters);
    public function render();
}
