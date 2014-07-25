<?php namespace Yoozi\Notification\Message;

/**
 *  Defines a transported message in a realtime notification.
 *  
 *
 *  @author     Saturn <yangg.hu@yoozi.cn>
 *  @copyright  2013 Yoozi Information Technology Co., Ltd.
 */
class RealtimeMessage extends Message {

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
        if (is_array($content))
        {
            // Since we deliver this message by POSTing it to the Real-time API, 
            // we have to make sure the message body comply the rules specified by
            // the HTTP protocol.
            $content = array_map('object_to_array', $content);

            $content = json_encode($content);
        }

        $this->attributes['content'] = $content;

        return $this;
    }
}