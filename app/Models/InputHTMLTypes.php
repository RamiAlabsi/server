<?php

define('INPUTS', [
    'Text' => 'the input of text',
    'Number' => 'the input of Number',
]);

function getInputHTMLType($type, $name)
{
    $html = "<div class='form-group'>
                <label>$name :</label>
                " . INPUTS["$type"] . "
            </div>";
}


