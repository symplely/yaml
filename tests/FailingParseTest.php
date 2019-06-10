<?php
namespace Async\Tests;

use Async\Yaml;
use PHPUnit\Framework\TestCase;

class FailingParseTest extends TestCase {

    protected $yaml;

    protected function setUp(): void
    {
      $this->markTestSkipped(
        'Not working under PHP 7.x.'
      );

      $this->yaml = yaml_load_file(__DIR__.DIRECTORY_SEPARATOR.'spyc.yaml');
    }

    public function testManyNewlines() 
    {
      $this->assertSame('A quick
fox


jumped
over





a lazy



dog', $this->yaml['many_lines']);
    }
}
