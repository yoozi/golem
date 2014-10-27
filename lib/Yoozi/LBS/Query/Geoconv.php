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
 * Geoconv Query.
 *
 * @see    http://developer.baidu.com/map/wiki/index.php?title=webapi/guide/changeposition
 * @author Saturn HU <yangg.hu@yoozi.cn>
 */
class Geoconv extends AbstractQuery {

    /**
     * Service URL segments.
     *
     * @var array
     */
    protected $segments = array(
        'endpoint' => 'http://api.map.baidu.com',
        'name'     => 'geoconv',
        'version'  => 'v1',
        'method'   => null,
    );
}
