<?php

/*
 * This file is part of the Yoozi Golem package.
 *
 * (c) Yoozi Inc. <hello@yoozi.cn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Yoozi\Email\Address;

use Illuminate\Support\Contracts\ArrayableInterface;
use Illuminate\Support\Contracts\JsonableInterface;

/**
 * Email address parser.
 *
 * @author Saturn HU <yangg.hu@yoozi.cn>
 */
class Parser implements ArrayableInterface, JsonableInterface {

    /**
     * A list of common used email providers.
     *
     * @var array
     */
    protected $providers = array(
        'gmail.com'           => 'http://mail.google.com',
        'me.com'              => 'https://www.icloud.com/#mail',
        'icloud.com'          => 'https://www.icloud.com/#mail',
        'hotmail.com'         => 'http://www.hotmail.com',
        'outlook.com'         => 'http://www.outlook.com',
        'yahoo.com'           => 'http://mail.yahoo.com',
        'aol.com'             => 'http://webmail.aol.com',
        'aim.com'             => 'http://webmail.aol.com/?offerId=aimmail-en-us',
        'msn.com'             => 'https://accountservices.msn.com/',
        'mail.com'            => 'http://www.mail.com/int/',
        '126.com'             => 'http://www.126.com',
        '163.com'             => 'http://www.163.com',
        'sina.com'            => 'http://mail.sina.com',
        'vip.163.com'         => 'http://vip.163.com',
        'yeah.net'            => 'http://www.yeah.net',
        'qq.com'              => 'http://mail.qq.com/cgi-bin/loginpage',
        'tom.com'             => 'http://mail.tom.com',
        'sohu.com'            => 'http://mail.sohu.com',
        '139.com'             => 'http://mail.139.com',
        'hexun.com'           => 'http://mail.hexun.com',
        'eyou.com'            => 'http://www.eyou.com',
        '21cn.com'            => 'http://mail.21cn.com'
    );

    /**
     * Holds the parsed segments.
     *
     * @var array
     */
    protected $parts = array();

    /**
     * Create a new email address parser.
     *
     * @param  array  $providers
     * @return void
     */
    public function __construct(array $providers = array())
    {
        if ($providers)
        {
            $this->providers = $providers;
        }
    }

    /**
     * Parse a email address, return the parsed parts.
     *
     * @param  string  $email
     * @return array
     */
    public function parse($email)
    {
        if ( ! filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new \InvalidArgumentException(
                "\$email($email) is not a valid email address."
            );
        }

        $email = strtolower($email);
        list($local, $domain) = explode('@', $email);

        $listed = isset($this->providers[$domain]);
        $url = $listed ? $this->providers[$domain] : 'http://mail.' . $domain;

        return $this->parts = compact('email', 'local', 'domain', 'url', 'listed');
    }

    /**
     * The parsed result in array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->parts;
    }

    /**
     * The parsed result in json.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->parts, $options);
    }
}
