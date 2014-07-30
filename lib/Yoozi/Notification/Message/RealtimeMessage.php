<?php namespace Yoozi\Notification\Message;

/**
 *  Defines a transported message in a realtime notification.
 *  
 *
 *  @author     Saturn <yangg.hu@yoozi.cn>
 *  @copyright  2013 Yoozi Information Technology Co., Ltd.
 */
class RealtimeMessage extends AbstractMessage {

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
            $content = array_map(function ($value) {
                if (is_object($value)) {
                    return method_exists($value, 'toArray') ? $value->toArray() : (array) $value;
                }

                return $value;

            }, $content);

            $content = json_encode($content);
        }

        $this->attributes['content'] = $content;

        return $this;
    }
}