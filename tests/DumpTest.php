<?php
namespace Async\Tests;

use Async\Yaml;
use PHPUnit\Framework\TestCase;

class DumpTest extends TestCase 
{

    private $files_to_test = array();

    public function setUp(): void 
    {
      $this->files_to_test = array('spyc.yaml', 'failing1.yaml', 'indent_1.yaml', 'quotes.yaml');
    }

    public function testParseAndDumper()
    {
        $data = ['lorem' => 'ipsum', 'dolor' => 'sit'];
        $yml = Yaml::dumper($data);
        $parsed = Yaml::parse($yml);
        $this->assertEquals($data, $parsed);
    }

    public function testShortSyntax() 
    {
      $dump = yaml_dump(array('item1', 'item2', 'item3'));
      $awaiting = "- item1\n- item2\n- item3\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testDumpArrays() 
    {
      $dump = Yaml::dumper(array('item1', 'item2', 'item3'));
      $awaiting = "- item1\n- item2\n- item3\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testNull() 
    {
        $dump = Yaml::dumper(array('a' => 1, 'b' => null, 'c' => 3));
        $awaiting = "a: 1\nb: null\nc: 3\n";
        $this->assertEquals($awaiting, $dump);
    }

    public function testNext() 
    {
        $array = array("aaa", "bbb", "ccc");
        #set arrays internal pointer to next element
        next($array);
        $dump = Yaml::dumper($array);
        $awaiting = "- aaa\n- bbb\n- ccc\n";
        $this->assertEquals($awaiting, $dump);
    }

    public function testDumpingMixedArrays() 
    {
        $array = array();
        $array[] = 'Sequence item';
        $array['The Key'] = 'Mapped value';
        $array[] = array('A sequence','of a sequence');
        $array[] = array('first' => 'A sequence','second' => 'of mapped values');
        $array['Mapped'] = array('A sequence','which is mapped');
        $array['A Note'] = 'What if your text is too long?';
        $array['Another Note'] = 'If that is the case, the dumper will probably fold your text by using a block.  Kinda like this.';
        $array['The trick?'] = 'The trick is that we overrode the default indent, 2, to 4 and the default wordwrap, 40, to 60.';
        $array['Old Dog'] = "And if you want\n to preserve line breaks, \ngo ahead!";
        $array['key:withcolon'] = "Should support this to";

        $yaml = Yaml::dumper($array,4,60);
    }

    public function testMixed() 
    {
        $dump = Yaml::dumper(array(0 => 1, 'b' => 2, 1 => 3));
        $awaiting = "0: 1\nb: 2\n1: 3\n";
        $this->assertEquals($awaiting, $dump);
    }

    public function testDumpNumerics() 
    {
      $dump = Yaml::dumper(array('404', '405', '500'));
      $awaiting = "- \"404\"\n- \"405\"\n- \"500\"\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testDumpAsterisks() 
    {
      $dump = Yaml::dumper(array('*'));
      $awaiting = "- '*'\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testDumpAmpersands() 
    {
      $dump = Yaml::dumper(array('some' => '&foo'));
      $awaiting = "some: '&foo'\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testDumpExclamations() 
    {
      $dump = Yaml::dumper(array('some' => '!foo'));
      $awaiting = "some: '!foo'\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testDumpExclamations2() 
    {
      $dump = Yaml::dumper(array('some' => 'foo!'));
      $awaiting = "some: foo!\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testDumpApostrophes() 
    {
      $dump = Yaml::dumper(array('some' => "'Biz' pimpt bedrijventerreinen"));
      $awaiting = "some: \"'Biz' pimpt bedrijventerreinen\"\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testDumpNumericHashes() 
    {
      $dump = Yaml::dumper(array("titel"=> array("0" => "", 1 => "Dr.", 5 => "Prof.", 6 => "Prof. Dr.")));
      $awaiting = "titel:\n  0: \"\"\n  1: Dr.\n  5: Prof.\n  6: Prof. Dr.\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testEmpty() 
    {
      $dump = Yaml::dumper(array("foo" => array()),false, false, true);
      $awaiting = "foo: [ ]\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testHashesInKeys() 
    {
      $dump = Yaml::dumper(array('#color' => '#ffffff'));
      $awaiting = "\"#color\": '#ffffff'\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testParagraph() 
    {
      $dump = Yaml::dumper(array('key' => "|\n  value"));
      $awaiting = "key: |\n  value\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testParagraphTwo() 
    {
      $dump = Yaml::dumper(array('key' => 'Congrats, pimpt bedrijventerreinen pimpt bedrijventerreinen pimpt bedrijventerreinen!'));
      $awaiting = "key: >\n  Congrats, pimpt bedrijventerreinen pimpt\n  bedrijventerreinen pimpt\n  bedrijventerreinen!\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testString() 
    {
      $dump = Yaml::dumper(array('key' => array('key_one' => 'Congrats, pimpt bedrijventerreinen!')));
      $awaiting = "key:\n  key_one: Congrats, pimpt bedrijventerreinen!\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testStringLong() 
    {
      $dump = Yaml::dumper(array('key' => array('key_one' => 'Congrats, pimpt bedrijventerreinen pimpt bedrijventerreinen pimpt bedrijventerreinen!')));
      $awaiting = "key:\n  key_one: >\n    Congrats, pimpt bedrijventerreinen pimpt\n    bedrijventerreinen pimpt\n    bedrijventerreinen!\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testStringDoubleQuote() 
    {
      $dump = Yaml::dumper(array('key' => array('key_one' =>  array('key_two' => '"Système d\'e-réservation"'))));
      $awaiting = "key:\n  key_one:\n    key_two: |\n      Système d'e-réservation\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testLongStringDoubleQuote() 
    {
      $dump = Yaml::dumper(array('key' => array('key_one' =>  array('key_two' => '"Système d\'e-réservation bedrijventerreinen pimpt" bedrijventerreinen!'))));
      $awaiting = "key:\n  key_one:\n    key_two: |\n      \"Système d'e-réservation bedrijventerreinen pimpt\" bedrijventerreinen!\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testStringStartingWithSpace() 
    {
      $dump = Yaml::dumper(array('key' => array('key_one' => "    Congrats, pimpt bedrijventerreinen \n    pimpt bedrijventerreinen pimpt bedrijventerreinen!")));
      $awaiting = "key:\n  key_one: |\n    Congrats, pimpt bedrijventerreinen\n    pimpt bedrijventerreinen pimpt bedrijventerreinen!\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testPerCentOne() 
    {
      $dump = Yaml::dumper(array('key' => "%name%, pimpts bedrijventerreinen!"));
      $awaiting = "key: '%name%, pimpts bedrijventerreinen!'\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testPerCentAndSimpleQuote() 
    {
      $dump = Yaml::dumper(array('key' => "%name%, pimpt's bedrijventerreinen!"));
      $awaiting = "key: \"%name%, pimpt's bedrijventerreinen!\"\n";
      $this->assertEquals($awaiting, $dump);
    }

    public function testPerCentAndDoubleQuote() 
    {
      $dump = Yaml::dumper(array('key' => '%name%, pimpt\'s "bed"rijventerreinen!'));
      $awaiting = "key: |\n  %name%, pimpt's \"bed\"rijventerreinen!\n";
      $this->assertEquals($awaiting, $dump);
    }
}
