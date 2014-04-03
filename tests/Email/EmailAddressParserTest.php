<?php

use Yoozi\Email\Address\Parser;

class EmailAddressParserTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \Yoozi\Email\Address\Parser
     */
    protected $parser;

    public function setUp()
    {
        $this->parser = new Parser;
    }

    public function testWithValidEmailInList()
    {
        $email = 'yangg.hu@gmail.com';
        $parts = $this->parser->parse($email);
        $this->assertEquals($parts, array(
            'email'  => 'yangg.hu@gmail.com',
            'local'  => 'yangg.hu',
            'domain' => 'gmail.com',
            'url'    => 'http://mail.google.com',
            'listed' => true
        ));
    }

    public function testWithValidEmailNotInList()
    {
        $email = 'yangg.hu@yoozi.cn';
        $parts = $this->parser->parse($email);
        $this->assertEquals($parts, array(
            'email'  => 'yangg.hu@yoozi.cn',
            'local'  => 'yangg.hu',
            'domain' => 'yoozi.cn',
            'url'    => 'http://mail.yoozi.cn',
            'listed' => false
        ));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $email(example.com) is not a valid email address.
     */
    public function testThrowExceptionWhenEmailIsInvlid()
    {
        $this->parser->parse('example.com');
    }
}
