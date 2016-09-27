<?php
/**
 * Author: Michaël VEROUX
 * Date: 25/07/15
 * Time: 16:38
 */

namespace Mv\FreeSmsApi\Sms;

/**
 * Interface SenderInterface
 * @package Mv\FreeSmsApi\Sms
 * @author Michaël VEROUX
 */
interface SenderInterface
{
    /**
     * @param string $freeUser
     * @param string $freePass
     */
    public function __construct($freeUser, $freePass);

    /**
     * @param string $message
     * @return $this
     * @author Michaël VEROUX
     */
    public function setMessage($message);

    /**
     * @param string $message
     * @return $this
     * @author Michaël VEROUX
     */
    public function addMessage($message);

    /**
     * @return string
     * @author Michaël VEROUX
     */
    public function getMessage();

    /**
     * @return void
     * @author Michaël VEROUX
     */
    public function reset();

    /**
     * @return bool
     * @author Michaël VEROUX
     */
    public function send();
}
