<?php

use Yoozi\LBS\Query\IP2Location;

class QueryTest extends PHPUnit_Framework_TestCase {

    public function testBasicMethods()
    {
        $query = new IP2Location;

        $this->assertEquals($query->get('method'), 'ip');
        $this->assertEquals($query->get('nonexist'), null);

        $query->set('method', 'test');
        $this->assertEquals($query->get('method'), 'test');

        $segments = [
            'endpoint' => 'http://api.map.baidu.com',
            'name'     => 'location',
            'version'  => null,
            'method'   => 'ip'
        ];

        $query->fill($segments, 'segments');
        $this->assertEquals($query->get('method'), $segments['method']);

        $query->set('method', null);
        $query->set('ip', '114.114.114.114');
        $query->set('ak', 'fakeCode');
        $this->assertEquals(
            $query->url(), 
            'http://api.map.baidu.com/location/?ip=114.114.114.114&ak=fakeCode'
        );
    }
}
