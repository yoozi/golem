<?php namespace Yoozi\Notification\Transport;

use Buzz\Browser as Browser;
use Buzz\Client\Curl as Curl;
use Yoozi\Notification\Message\RealtimeMessage;
use Yoozi\Notification\Contracts\Notifiable;

/**
 *  Transport and push a notification in real-time via Socket.io.
 *  
 *
 *  @author     Saturn <yangg.hu@yoozi.cn>
 *  @copyright  2013 Yoozi Information Technology Co., Ltd.
 */
class Realtime implements Notifiable {

    /**
     * Holds the HTTP request handle.
     *
     * @var \Buzz\Browser
     */
    protected $request;

    /**
     * Holds the HTTP endpoint.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Holds the types of the message.
     *
     * Value of each elements contains the required attributes.
     *
     * @var array
     */
    protected $types = array(
        'inbox.unread'      => array('from', 'to', 'content'),
        'request.pending'   => array('from', 'to'),
        'request.confirmed' => array('from', 'to', 'content'),
        'feed.update'       => array('from', 'to', 'content'),
    );

    /**
     * Initialize the HTTP request handle.
     *
     * @param string The transport endpoint. 
     */
    public function __construct($endpoint)
    {
        $this->request = new Browser(new Curl);
        $this->endpoint = $endpoint;
    }

    /**
     * Validate the type of the notification.
     *
     * @param  string   Type of the notification.
     * @return boolean
     */
    public function isValid($type)
    {
        return isset($this->types[$type]);
    }

    /**
     * Send the actual message to the recipient.
     *
     * @param  \Yoozi\Notification\Message\RealtimeMessage
     * @return \Buzz\Message\Response
     */
    public function send($message)
    {
        return $this->request->post($this->endpoint, array(), $message->toArray());
    }
}