<?php

use Yoozi\Notification\Message\Message;
use Yoozi\Notification\Message\RealtimeMessage;

class RealtimeMessageTest extends PHPUnit_Framework_TestCase {

    public function testObjectEncodeInRealtimeMessageContent()
    {
        $object          = new Message;
        $object->from    = 'alice';
        $object->to      = 'bob';
        $object->content = 'love';

        $testRealtimeMessage = array(
            'string'    => 'hello',
            'numeric'   => 123,
            'object'    => $object
        );

        $message = new RealtimeMessage;

        $message->content($testRealtimeMessage);

        $testRealtimeMessage['object'] = $object->toArray();

        $this->assertEquals($message->content, json_encode($testRealtimeMessage));

        // For magic methods.
        $message->from('test@fakethree.com');
        $this->assertEquals('test@fakethree.com', $message->from);
    }
}
