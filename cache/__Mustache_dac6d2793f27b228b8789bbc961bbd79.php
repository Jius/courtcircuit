<?php

class __Mustache_dac6d2793f27b228b8789bbc961bbd79 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $blocksContext = array();

        $value = $this->resolveValue($context->find('content'), $context);
        $buffer .= $indent . $value;

        return $buffer;
    }
}
