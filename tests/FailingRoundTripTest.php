<?php
namespace Async\Tests;

use Async\Yaml;
use PHPUnit\Framework\TestCase;

class FailingRoundTripTest extends TestCase 
{
    protected function setUp(): void
    {
      $this->markTestSkipped(
        'Not working under PHP 7.x.'
      );
    }

    public function testNewLines() 
    {
      $this->assertEquals(array('x' => "\n"), roundTrip("\n"));
    }   
}
