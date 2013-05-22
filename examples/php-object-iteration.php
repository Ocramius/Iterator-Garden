<?php
/**
 * Basic Example of PHP Object Iteration with foreach
 *
 * @link http://php.net/iteration
 */

$obj      = new stdClass;
$obj->foo = "bar";

foreach ($obj as $key => $value) {
    echo $key, ' => ', $value, "\n";
}


class MyClass
{
    public $foo = 'bar';
    protected $answer = 42;
}

$obj = new MyClass;

foreach ($obj as $key => $value) {
    echo $key, ' => ', $value, "\n";
}


class MyEach extends MyClass
{
    public function iterate()
    {
        foreach ($this as $key => $value) {
            echo $key, ' => ', $value, "\n";
        }
    }
}

$obj = new MyEach;
$obj->iterate();
