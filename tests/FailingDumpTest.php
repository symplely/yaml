<?php
namespace Async\Tests;

use Async\Yaml;
use PHPUnit\Framework\TestCase;

class FailingDumpTest extends TestCase 
{

    private $files_to_test = array();

    public function setUp(): void 
    {
      $this->markTestSkipped(
        'Not working under PHP 7.x.'
      );
      
      $this->files_to_test = array('spyc.yaml', 'failing1.yaml', 'indent_1.yaml', 'quotes.yaml');
    }

    public function testDump() 
    {
      foreach($this->files_to_test as $file) {
        $yaml = yaml_load(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.$file));
        $dump = Yaml::dumper($yaml);
        $yaml_after_dump = Yaml::loader($dump);
        $this->assertEquals($yaml, $yaml_after_dump);
      }
    }

    public function testDumpWithQuotes() 
    {
      $Spyc = new Spyc();
      $Spyc->setting_dump_force_quotes = true;
      foreach($this->files_to_test as $file) {
        $yaml = $Spyc->load(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.$file));
        $dump = $Spyc->dump($yaml);
        $yaml_after_dump = Yaml::loader($dump);
        $this->assertEquals($yaml, $yaml_after_dump);
      }
    }
}
