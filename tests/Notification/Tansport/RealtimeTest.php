<?php

use Buzz\Message\Response;

class RealtimeTransportTest extends PHPUnit_Framework_TestCase {

    public function testMethods()
    {
        // Create a stub for the AbstractMessage class.
        $mock = $this->getMock(
            'Yoozi\Notification\Transport\Realtime', 
            array('send'),
            array('http://localhost')
        );

       // Configure the stub.
        $mock->expects($this->once())
             ->method('send')
             ->will($this->returnValue(new Response));

        $this->assertEquals(new Response, $mock->send('foo'));
        $this->assertTrue($mock->isValid('inbox.unread'));
        $this->assertFalse($mock->isValid('inbox.read'));
    }
}
