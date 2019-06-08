<?php
namespace Async\Tests;

use Async\Yaml;
use PHPUnit\Framework\TestCase;

class LoadTest extends TestCase 
{
    public function testQuotes() 
    {
        $test_values = array(
            "adjacent '''' \"\"\"\" quotes.",
            "adjacent '''' quotes.",
            "adjacent \"\"\"\" quotes.",
        );
        foreach($test_values as $value) {
            $yaml = array($value);
            $dump = Yaml::dumper($yaml);
            $yaml_loaded = Yaml::loader($dump);
            $this->assertEquals($yaml, $yaml_loaded);
        }
    }
}
