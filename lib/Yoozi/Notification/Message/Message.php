<?php namespace Yoozi\Notification\Message;

use Illuminate\Support\Contracts\JsonableInterface;
use Illuminate\Support\Contracts\ArrayableInterface;

/**
 *  Defines a transported message in a notification.
 *  
 *
 *  @author     Saturn <yangg.hu@yoozi.cn>
 *  @copyright  2013 Yoozi Information Technology Co., Ltd.
 */
class Message implements ArrayableInterface, JsonableInterface {

    /**
     * Holds the attributes of this message.
     *
     * @var mixed
     */
    protected $attributes = array();

    /**
     * Set the sender who triggers this transport.
     *
     * @param  mixed $from
     * @return \Yoozi\Notification\Message
     */
    public function from($from)
    {
        $this->attributes['from'] = $from;

        return $this;
    }

    /**
     * Set the recipient who we transport the message to.
     *
     * @param  mixed $to
     * @return \Yoozi\Notification\Message
     */
    public function to($to)
    {
        $this->attributes['to'] = $to;

        return $this;
    }

    /**
     * Set the subject contained in the transport.
     *
     * @param  mixed $subject
     * @return \Yoozi\Notification\Message
     */
    public function subject($subject)
    {
        $this->attributes['subject'] = $subject;

        return $this;
    }

    /**
     * Set the main content contained in the transport.
     *
     * @param  mixed $content
     * @return \Yoozi\Notification\Message
     */
    public function content($content)
    {
        $this->attributes['content'] = $content;

        return $this;
    }

    /**
     * Dynamically set attributes on the instance.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Dynamically get attributes on the instance.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : null;
    }

    /**
     * Convert the story instance to an array.
     *
     * @return ArrayObject Array representation of the object
     */
    public function toArray()
    {
        return array_map(function($value)
        {
            return $value instanceof ArrayableInterface ? $value->toArray() : $value;
            
        }, $this->attributes);
    }

    /**
     * Convert the story instance to an JSON.
     *
     * @param  int    JSON constants
     * @return string String representation of the object
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}