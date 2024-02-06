<?php

/**
 * Created by PhpStorm.
 * User: iGusev
 * Date: 14/04/16
 * Time: 16:01
 */
namespace DynamicOOOS\TelegramBot\Api\Types\Inline\InputMessageContent;

use DynamicOOOS\TelegramBot\Api\BaseType;
use DynamicOOOS\TelegramBot\Api\TypeInterface;
use DynamicOOOS\TelegramBot\Api\Types\Inline\InputMessageContent;
/**
 * Class Contact
 *
 * @see https://core.telegram.org/bots/api#inputcontactmessagecontent
 * Represents the content of a contact message to be sent as the result of an inline query.
 *
 * @package TelegramBot\Api\Types\Inline
 */
class Contact extends InputMessageContent implements TypeInterface
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static $requiredParams = ['phone_number', 'first_name'];
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected static $map = ['phone_number' => \true, 'first_name' => \true, 'last_name' => \true];
    /**
     * Contact's phone number
     *
     * @var string
     */
    protected $phoneNumber;
    /**
     * Contact's first name
     *
     * @var string
     */
    protected $firstName;
    /**
     * Optional. Contact's last name
     *
     * @var string
     */
    protected $lastName;
    /**
     * Contact constructor.
     *
     * @param string $phoneNumber
     * @param string $firstName
     * @param string|null $lastName
     */
    public function __construct($phoneNumber, $firstName, $lastName = null)
    {
        $this->phoneNumber = $phoneNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }
    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
}
