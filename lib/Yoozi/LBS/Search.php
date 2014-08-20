<?php

/*
 * This file is part of the Yoozi Golem package.
 *
 * (c) Yoozi Inc. <hello@yoozi.cn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yoozi\LBS;

use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Client\ClientInterface as HttpClientInterface;
use Illuminate\Support\Contracts\JsonableInterface;
use Illuminate\Support\Contracts\ArrayableInterface;

/**
 * Yoozi LBS API toolkit using Baidu Map LBS WEB API.
 *
 * @author Saturn HU <yangg.hu@yoozi.cn>
 */
class Search implements ArrayableInterface, JsonableInterface
{
    /**
     * Search Query Object.
     *
     * @var \Yoozi\LBS\Query\QueryInterface
     */
    protected $query;

    /**
     * Result array.
     *
     * @var array
     */
    protected $items;

    /**
     * Setup ak code and inject the service object.
     *
     * @param  string $ak
     * @param  \Yoozi\LBS\Query
     */
    public function __construct($ak, $query)
    {
        $this->query = $query;

        $this->query->set('ak', $ak);
    }

    /**
     * Run the query via HTTP $client and fetch the result in $output format.
     *
     *
     * @param  \Buzz\Client\ClientInterface $client
     * @return \Yoozi\LBS\Search
     */
    public function run(HttpClientInterface $client = null)
    {
        $this->query->set('output', 'json');

        $browser  = new Browser($client ?: new Curl);
        $response = $browser->get($this->query->url());

        if ($response->isSuccessful()) {
            $this->items = json_decode($response->getContent(), true);

            if ($status = $this->items['status']) {
                throw new \Exception("Service API return error: [Status $status].", 1);
            }
        }

        return $this;
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
     * @return \Yoozi\LBS\Search
     */
    public function set($key, $val)
    {
        $this->query->set($key, $val);

        return $this;
    }

    /**
     * Get the search query.
     *
     * @return \Yoozi\LBS\Query\QueryInterface
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * The search result array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * The search result in json.
     *
     * @param  int    $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->items, $options);
    }
}
