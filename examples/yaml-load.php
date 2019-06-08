<?php

require 'vendor/autoload.php';

use Async\Yaml;

$array = Yaml::loader('../tests/spyc.yaml');

echo '<pre><a href="spyc.yaml">spyc.yaml</a> loaded into PHP:<br/>';
print_r($array);
echo '</pre>';


echo '<pre>YAML Data dumped back:<br/>';
echo Yaml::dumper($array);
echo '</pre>';
