<?php

use Yoozi\Notification\Message\RealtimeMessage;
use Buzz\Message\Response;

class NotificationTest extends PHPUnit_Framework_TestCase {

    protected $transport;
    protected $mock;

    protected function setUp()
    {
        $this->transport = $this->getMock(
            'Yoozi\Notification\Transport\Realtime', 
            array('send'),
            array('http://localhost')
        );

        // Configure the stub.
        $this->transport->expects($this->any())
            ->method('send')
            ->will($this->returnValue(new Response));

        $this->mock = $this->getMock(
            'Yoozi\Notification\Notification', 
            NULL,
            array($this->transport, new RealtimeMessage)
        );
    }

    /**
     * @expectedException     RuntimeException
     * @expectedExceptionMessage Invalid notification type invalid.message. Miss type definition?
     */
    public function testSendingInvalidMessage()
    {
        $this->assertFalse($this->mock->isValid('invalid.message'));
        $this->mock->send('invalid.message');
    }

    public function testSendingMessage()
    {
        $this->assertEquals(new Response, $this->mock->send('inbox.unread'));
    }
}
