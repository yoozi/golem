<?php

/*
 * This file is part of the Yoozi Golem package.
 *
 * (c) Yoozi Inc. <hello@yoozi.cn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yoozi\LBS\Query;

/**
 * IP to Location Query.
 *
 * @see    http://developer.baidu.com/map/webservice-geocoding.htm
 * @author Saturn HU <yangg.hu@yoozi.cn>
 */
class IP2Location extends AbstractQuery {

    /**
     * Service URL segments.
     *
     * @var array
     */
    protected $segments = [
        'endpoint' => 'http://api.map.baidu.com',
        'name'     => 'location',
        'version'  => null,
        'method'   => 'ip',
    ];
}
