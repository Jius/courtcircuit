<?php

class __Mustache_d6eb397586b83fbeab8524f69375d7bf extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '
';
        $buffer .= $indent . '    <a href="/carte">Voir les producteurs</a>
';
        $buffer .= $indent . '    <a href="/producteur">Inscrire un producteurs</a>
';
        $buffer .= $indent . '  ';

        return $buffer;
    }
}
