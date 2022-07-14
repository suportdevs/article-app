<?php

function pr($object)
{
    echo "<pre>";
    var_dump($object);
    echo "</pre>";
    exit();
}