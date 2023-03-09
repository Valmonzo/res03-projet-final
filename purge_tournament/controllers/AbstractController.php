<?php

abstract class AbstractController
{

    public function render( string $view , array $values, $type="public") : void
    {
        $file = $type;
    	$template = $view;
    	$data = $values;
    	require 'templates/'.$file.'/'.$file.'_layout.phtml';
    }

}

?>