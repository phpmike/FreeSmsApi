<?php
/**
 * Author: Michaël VEROUX
 * Date: 25/07/15
 * Time: 16:14
 */

namespace Mv\FreeSmsApi\Sms;

use Curl\Curl;
use Mv\FreeSmsApi\Exception\FailedException;

/**
 * Class Sender
 *
 * @package Mv\FreeSmsApi\Sms
 * @author Michaël VEROUX
 */
class Sender implements SenderInterface
{
    /**
     * @var string
     */
    private $httpFreeApi = 'https://smsapi.free-mobile.fr/sendmsg';

    /**
     * @var string
     */
    protected $freeUser;

    /**
     * @var string
     */
    protected $freePass;

    /**
     * @var string
     */
    protected $message = '';

    /**
     * @param string $freeUser
     * @param string $freePass
     */
    public function __construct($freeUser, $freePass)
    {
        $this->freeUser = $freeUser;
        $this->freePass = $freePass;
    }

    /**
     * @param string $httpFreeApi
     *
     * @return $this
     */
    public function setHttpFreeApi($httpFreeApi)
    {
        $this->httpFreeApi = $httpFreeApi;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return $this
     * @author Michaël VEROUX
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return $this
     * @author Michaël VEROUX
     */
    public function addMessage($message)
    {
        if ('' !== $this->message) {
            $this->message .= "\r\n";
        }

        $this->message .= $message;

        return $this;
    }

    /**
     * @return string
     * @author Michaël VEROUX
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return void
     * @author Michaël VEROUX
     */
    public function reset()
    {
        $this->message = '';
    }

    /**
     * @return bool
     * @author Michaël VEROUX
     */
    public function send()
    {
        $data = array(
            'user' => $this->freeUser,
            'pass' => $this->freePass,
            'msg'  => $this->getMessage(),
        );

        $curl = new Curl();
        $curl->get($this->httpFreeApi, $data);

        if (0 < $curl->error_code) {
            $errorMsg = 'Undefined';
            switch ($curl->error_code) {
                case 400:
                    $errorMsg = 'Un des paramètres obligatoires est manquant.';
                    break;
                case 402:
                    $errorMsg = 'Trop de SMS ont été envoyés en trop peu de temps.';
                    break;
                case 403:
                    $errorMsg = 'Le service n’est pas activé sur l’espace abonné, ou login / clé incorrect.';
                    break;
                case 500:
                    $errorMsg = 'Erreur côté serveur. Veuillez réessayez ultérieurement.';
                    break;
            }

            throw new FailedException($errorMsg, $curl->error_code);
        }

        $this->reset();

        return true;
    }
}
