<?php

namespace Async\Tests;

use Async\Yaml;
use PHPUnit\Framework\TestCase;

function roundTrip($a)
{
  return Yaml::loader(Yaml::dumper(array('x' => $a)));
}


class RoundTripTest extends TestCase
{
  protected function setUp(): void
  {
  }

  public function testNull()
  {
    $this->assertEquals(array('x' => null), roundTrip(null));
  }

  public function testY()
  {
    $this->assertEquals(array('x' => 'y'), roundTrip('y'));
  }

  public function testExclam()
  {
    $this->assertEquals(array('x' => '!yeah'), roundTrip('!yeah'));
  }

  public function test5()
  {
    $this->assertEquals(array('x' => '5'), roundTrip('5'));
  }

  public function testSpaces()
  {
    $this->assertEquals(array('x' => 'x '), roundTrip('x '));
  }

  public function testApostrophes()
  {
    $this->assertEquals(array('x' => "'biz'"), roundTrip("'biz'"));
  }

  public function testHashes()
  {
    $this->assertEquals(array('x' => array("#color" => '#fff')), roundTrip(array("#color" => '#fff')));
  }

  public function testPreserveString()
  {
    $result1 = roundTrip('0');
    $result2 = roundTrip('true');
    $this->assertTrue(is_string($result1['x']));
    $this->assertTrue(is_string($result2['x']));
  }

  public function testPreserveBool()
  {
    $result = roundTrip(true);
    $this->assertTrue(is_bool($result['x']));
  }

  public function testPreserveInteger()
  {
    $result = roundTrip(0);
    $this->assertTrue(is_int($result['x']));
  }

  public function testWordWrap()
  {
    $this->assertEquals(array('x' => "aaaaaaaaaaaaaaaaaaaaaaaaaaaa  bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb"), roundTrip("aaaaaaaaaaaaaaaaaaaaaaaaaaaa  bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb"));
  }

  public function testABCD()
  {
    $this->assertEquals(array('a', 'b', 'c', 'd'), Yaml::loader(Yaml::dumper(array('a', 'b', 'c', 'd'))));
  }

  public function testABCD2()
  {
    $a = array('a', 'b', 'c', 'd'); // Create a simple list
    $b = Yaml::dumper($a);        // Dump the list as YAML
    $c = Yaml::loader($b);        // Load the dumped YAML
    $d = Yaml::dumper($c);        // Re-dump the data
    $this->assertSame($b, $d);
  }
}
