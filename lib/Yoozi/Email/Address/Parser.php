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

/**
 * Email address parser.
 *
 * @author Saturn HU <yangg.hu@yoozi.cn>
 */
class Parser
{
    /**
     * A list of common used email providers.
     *
     * @var array
     */
    public static $providers = array(
        '126.com'        => 'http://www.126.com',
        '139.com'        => 'http://mail.139.com',
        '163.com'        => 'http://www.163.com',
        '188.com'        => 'http://www.188.com/',
        '189.cn'         => 'http://mail.189.cn/',
        '21cn.com'       => 'http://mail.21cn.com',
        '2980.com'       => 'http://www.2980.com/',
        'aim.com'        => 'http://webmail.aol.com/?offerId=aimmail-en-us',
        'aliyun.com'     => 'http://mail.aliyun.com/alimail/',
        'aol.com'        => 'http://webmail.aol.com',
        'china.com'      => 'http://mail.china.com/index.html',
        'citiz.net'      => 'http://www.citiz.net/cloudmail/',
        'cntv.cn'        => 'http://mail.china.com/index.html',
        'eyou.com'       => 'http://www.eyou.com',
        'foxmail.com'    => 'http://mail.qq.com/cgi-bin/loginpage',
        'gmail.com'      => 'http://mail.google.com',
        'hexun.com'      => 'http://mail.hexun.com',
        'hotmail.com'    => 'http://www.hotmail.com',
        'icloud.com'     => 'https://www.icloud.com/#mail',
        'mail.com'       => 'http://www.mail.com/int/',
        'me.com'         => 'https://www.icloud.com/#mail',
        'msn.com'        => 'https://accountservices.msn.com/',
        'outlook.com'    => 'http://www.outlook.com',
        'qq.com'         => 'http://mail.qq.com/cgi-bin/loginpage',
        'renren.com'     => 'http://mail.renren.com/',
        'sina.cn'        => 'http://mail.sina.cn',
        'sina.com'       => 'http://mail.sina.com',
        'sogou.com'      => 'http://mail.sogou.com/',
        'sohu.com'       => 'http://mail.sohu.com',
        'tom.com'        => 'http://mail.tom.com',
        'vip.126.com'    => 'http://vip.126.com',
        'vip.163.com'    => 'http://vip.163.com',
        'vip.21cn.com'   => 'http://vip.21cn.com',
        'vip.citiz.net'  => 'http://www.citiz.net/cloudmail/',
        'vip.cntv.cn'    => 'http://mail.china.com/index.html',
        'vip.qq.com'     => 'http://mail.qq.com/cgi-bin/loginpage',
        'vip.sina.com'   => 'http://vip.sina.com',
        'vnet.citiz.net' => 'http://www.citiz.net/cloudmail/',
        'wo.com.cn'      => 'http://mail.wo.com.cn/mail/login.action',
        'yahoo.com'      => 'http://mail.yahoo.com',
        'yeah.net'       => 'http://www.yeah.net'
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
     * @param  array $providers
     * @return void
     */
    public function __construct(array $providers = array())
    {
        if ($providers) {
            static::$providers = $providers;
        }
    }

    /**
     * Parse a email address, return the parsed parts.
     *
     * @param  string $email
     * @return array
     */
    public function parse($email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(
                "\$email($email) is not a valid email address."
            );
        }

        $email = strtolower($email);
        list($local, $domain) = explode('@', $email);

        $listed = isset(static::$providers[$domain]);
        $url = $listed ? static::$providers[$domain] : 'http://mail.' . $domain;

        return $this->parts = compact('email', 'local', 'domain', 'url', 'listed');
    }

    /**
     * Get the list of providers.
     *
     * @return array
     */
    public function getProviders()
    {
        return static::$providers;
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
     * @param  int    $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->parts, $options);
    }
}
