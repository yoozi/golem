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
 * Build a Baidu MAP LBS API query.
 *
 * @see    http://developer.baidu.com/map/webservice.htm
 * @author Saturn HU <yangg.hu@yoozi.cn>
 */
abstract class AbstractQuery implements QueryInterface {

    /**
     * Service URL segments.
     *
     * @var array
     */
    protected $segments = array(
        'endpoint' => 'http://api.map.baidu.com',
        'name'     => null,
        'version'  => 'v2',
        'method'   => null,
    );

    /**
     * Array to be constructed as a querystring.
     *
     * @var array
     */
    protected $query = array();

    /**
     * Fill the query string array or segments.
     *
     * @param  array $query
     * @return array
     */
    public function fill($array, $set = 'query')
    {
        $this->$set = $array;
    }

    /**
     * Get a URL segment OR query string using "dot" notation.
     *
     * <code>
     * // Get the name of the service
     * $parser = $this->get('name');
     * </code>
     *
     * @param  array $options
     * @return mixed
     */
    public function get($key)
    {
        if (isset($this->segments[$key])) {
            return array_get($this->segments, $key, null);            
        }

        return array_get($this->query, $key, null);
    }

    /**
     * Set a URL segment OR query string using "dot" notation.
     *
     * <code>
     * // Set the name of service.
     * $this->set('name', 'place');
     * </code>
     *
     * @param  string $key
     * @param  string $val
     * @return array
     */
    public function set($key, $val)
    {
        if (isset($this->segments[$key])) {
            return $this->segments = array_set($this->segments, $key, $val);            
        }

        return $this->query = array_set($this->query, $key, $val);
    }

    /**
     * Make the final query URL.
     *
     * @return string
     */
    public function url()
    {
        $url = implode('/', array_filter($this->segments));

        if (empty($this->segments['method'])) {
            $url .= '/';
        }

        return $url . '?' . http_build_query($this->query);
    }

}
