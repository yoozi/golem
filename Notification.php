<?php namespace Yoozi\Notification;

use Closure;
use Yoozi\Notification\Contracts\Notifiable;

/**
 *  Define how we deal with a notificiation message.
 *  
 *
 *  @author     Saturn <yangg.hu@yoozi.cn>
 *  @copyright  2013 Yoozi Information Technology Co., Ltd.
 */
class Notification {

    /**
     * Holds the transport handle.
     *
     * @var array
     */
    protected $transport;

    /**
     * Holds the transport message handle.
     *
     * @var array
     */
    protected $message;

    /**
     * Set the transport to drive the notification.
     *
     * @param mixed The concrete transport instance.
     */
    public function __construct(Notifiable $transport, $message)
    {
        $this->transport = $transport;
        $this->message   = $message;
    }

    /**
     * Send the actual message to the recipient.
     *
     * @param  string   Type of the notification.
     * @param  \Closure Closure to set the messages.
     * @return mixed
     */
    public function send($type, Closure $callback)
    {
        if ( ! $this->transport->isValid($type))
        {
            throw new \RuntimeException("Invalid notification type $type. Miss type definition?", 1);
        }

        // It's handy to set a default subject for the message when using realtime
        // notification API.
        $this->message->subject($type);

        return $this->transport->send(call_user_func($callback, $this->message));
    }

    /**
     * Dynamically pass missing methods to the transport instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $callable = array($this->transport, $method);

        return call_user_func_array($callable, $parameters);
    }

    /**
     * Dynamically set attributes on the trasnport instance.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function __set($key, $value)
    {
        $method = 'set' . ucfirst($key);

        if (method_exists($this->transport, $method))
        {
            return $this->transport->$method($value);
        }
    
        $this->transport->$key = $value;
    }
}