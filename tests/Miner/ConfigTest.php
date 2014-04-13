<?php

use Yoozi\Miner\Config;

class ConfigTest extends PHPUnit_Framework_TestCase {

    public function testBasicMethods()
    {
        $items = array(
            'parser'     => 'hybrid',
            'headers'    => array(
                'User-Agent' => 'Mozilla/5.0'
            ),
            'strip_tags' => true
        );

        $config = new Config($items);

        $this->assertEquals($config->toArray(), $items);
        $this->assertEquals($config->toJson(), json_encode($items));
        $this->assertEquals($config->get('parser'), $items['parser']);

        $config->set('parser', 'Readability');
        $this->assertEquals($config->get('parser'), 'Readability');
    }
}
