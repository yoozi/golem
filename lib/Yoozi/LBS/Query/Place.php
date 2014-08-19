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

use Yoozi\LBS\Query;

/**
 * Place API Query.
 *
 * @see    http://developer.baidu.com/map/wiki/index.php?title=webapi/place-suggestion-api
 * @see    http://developer.baidu.com/map/webservice-placeapi.htm
 * @author Saturn HU <yangg.hu@yoozi.cn>
 */
class Place extends AbstractQuery {

    /**
     * Service URL segments.
     *
     * @var array
     */
    protected $segments = array(
        'endpoint' => 'http://api.map.baidu.com',
        'name'     => 'place',
        'version'  => 'v2',
        // 可能存在 suggestion/search/detail/eventsearch/eventdetail 五个选项
        // @see http://developer.baidu.com/map/webservice-placeapi.htm
        // @see http://developer.baidu.com/map/wiki/index.php?title=webapi/place-suggestion-api
        'method'   => 'search'
    );

}
