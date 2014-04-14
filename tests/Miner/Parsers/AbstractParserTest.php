<?php

use Yoozi\Miner\Config;
use Yoozi\Miner\Parsers\Meta;

class AbstractParserTest extends PHPUnit_Framework_TestCase {

    private $config;

    public function setUp()
    {
        $this->config = new Config;
    }

    public function testParseEmptyDocument()
    {
        $parser = new Meta($this->config, new \DOMDocument);
        $this->assertEquals($parser->parse(), $parser->meta);
    }

    /**
     * @dataProvider provideDocumentsWithTitle
     */
    public function testExtractTitle($expected, $source)
    {
        $dom = new \DOMDocument("1.0", 'utf-8');
        $dom->loadHTML($source);

        $parser = new Meta($this->config, $dom);
        $metadata = $parser->parse();

        $this->assertEquals($metadata['title'], $expected);
    }

    public function provideDocumentsWithTitle()
    {
        return array(
            array('Foo Title', '<!DOCTYPE html><html><title>Foo Title - Bar</title><body><h1>This is heading.</h1></body></html>'),
            array('Foo Title Bar', '<!DOCTYPE html><html><title>Foo Title Bar</title><body><h1>This is heading.</h1></body></html>'),
            array('', '<!DOCTYPE html><html><title></title><body><h1>This is heading.</h1></body></html>'),
            array('This is heading.', '<!DOCTYPE html><html><body><h1>This is heading.</h1></body></html>'),
            array('This is heading alert("xss").', '<!DOCTYPE html><html><body><h1>This is heading <script>alert("xss")</script>.</h1></body></html>'),
            array('', '<!DOCTYPE html><html><body></body></html>'),
        );
    }
}
