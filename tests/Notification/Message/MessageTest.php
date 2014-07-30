<?php

use Yoozi\Notification\Message\Message;

class MessageTest extends PHPUnit_Framework_TestCase {

    public function testBasicMethods()
    {
        $seed = array(
            'from'    => 'hello@fakeone.cn',
            'to'      => 'fake@faketwo.com',
            'subject' => 'Howdy yoozi.',
            'content' => 'hi there.'
        );

        $message = new Message;

        foreach ($seed as $key => $val) {
            $message->$key($val);
        }

        $this->assertEquals($seed, $message->toArray());
        $this->assertEquals(json_encode($seed), $message->toJson());

        // For magic methods.
        $message->from = 'test@fakethree.com';
        $this->assertEquals('test@fakethree.com', $message->from);
    }
}
