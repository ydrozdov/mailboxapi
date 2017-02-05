<?php

namespace Mailbox\Documents;



/**
 * Mailbox\Documents\Item
 */
class Item implements \JsonSerializable
{
    /**
     * @var $_id
     */
    protected $_id;

    /**
     * @var integer $uid
     */
    protected $uid;

    /**
     * @var string $sender
     */
    protected $sender;

    /**
     * @var string $subject
     */
    protected $subject;

    /**
     * @var string $message
     */
    protected $message;

    /**
     * @var timestamp $time_sent
     */
    protected $time_sent;

    /**
     * @var boolean $read
     */
    protected $read;

    /**
     * @var boolean $archived
     */
    protected $archived;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set uid
     *
     * @param integer $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }

    /**
     * Get uid
     *
     * @return integer $uid
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set sender
     *
     * @param string $sender
     * @return $this
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * Get sender
     *
     * @return string $sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get subject
     *
     * @return string $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get message
     *
     * @return string $message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set timeSent
     *
     * @param timestamp $timeSent
     * @return $this
     */
    public function setTimeSent($timeSent)
    {
        $this->time_sent = $timeSent;
        return $this;
    }

    /**
     * Get timeSent
     *
     * @return timestamp $timeSent
     */
    public function getTimeSent()
    {
        return $this->time_sent;
    }
    
    /**
     * Set read
     *
     * @param boolean $read
     * @return $this
     */
    public function setRead($read)
    {
        $this->read = $read;
        return $this;
    }

    /**
     * Get read
     *
     * @return boolean $read
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     * @return $this
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean $archived
     */
    public function getArchived()
    {
        return $this->archived;
    }
    
    public function jsonSerialize()
    {
        return [
            "uid"       => $this->getUid(),
            "sender"    => $this->getSender(),
            "subject"   => $this->getSubject(),
            "message"   => $this->getMessage(),
            "time_sent" => $this->getTimeSent(),
            "read"      => $this->getRead(),
            "archived"  => $this->getArchived()
        ];
    }
}
