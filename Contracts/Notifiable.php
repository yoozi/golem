<?php namespace Yoozi\Notification\Contracts;

/**
 *  Defines a notifiable object.
 *  
 *
 *  @author     Saturn <yangg.hu@yoozi.cn>
 *  @copyright  2013 Yoozi Information Technology Co., Ltd.
 */
interface Notifiable {

    /**
     * Send the notification message.
     *
     * @param  \Yoozi\Notification\Message
     * @return mixed
     */
    function send($message);

    /**
     * Validate the type of the notification.
     *
     * @param  string   Type of the notification.
     * @return boolean
     */
    function isValid($type);
}