<?php
/**
 * When does the NoRewindIterator rewind the inner Iterator?
 */

require(__DIR__ . '/../src/autoload.php');

/**
 * Class OneTimeRewindIterator
 */
class OneTimeRewindIterator extends NoRewindIterator
{
    private $didRewind = FALSE;

    public function rewind()
    {
        if ($this->didRewind) return;

        $this->didRewind = TRUE;
        $this->getInnerIterator()->rewind();
        if ($this->getInnerIterator()->valid()) {
            $this->getInnerIterator()->current();
            $this->getInnerIterator()->key();
        }
    }
}

$iterator = new RangeIterator(1, 2);
$debug    = new DebugIteratorDecorator($iterator);
$stacked  = new OneTimeRewindIterator($debug);
$debug    = new DebugIteratorDecorator($stacked);
foreach ($debug as $value) {
    echo $value, "\n";
}
return;


$iterator = new RangeIterator(1, 1);
$debug    = new DebugIteratorDecorator($iterator);
$noRewind = new OneTimeRewindIterator($debug);

echo "first foreach:\n";

foreach ($noRewind as $value) {
    echo "iteration value: $value\n";
}

echo "\n\$calling noRewind->getInnerIterator()->rewind():\n";

$noRewind->getInnerIterator()->rewind();

echo "\nsecond foreach:\n";

foreach ($noRewind as $value) {
    echo "iteration value: $value\n";
}
