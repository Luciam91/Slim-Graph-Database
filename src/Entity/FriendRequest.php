<?php

namespace Application\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="FriendRequest")
 */
class FriendRequest
{
    const STATUS_ACCEPTED=1;
    const STATUS_REJECTED=2;

    /**
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @OGM\Relationship(type="REQUEST_FROM", direction="OUTGOING", targetEntity="Member")
     */
    protected $from;

    /**
     * @OGM\Relationship(type="REQUEST_TO", direction="OUTGOING", targetEntity="Member")
     */
    protected $to;

    /**
     * @OGM\Property(type="boolean")
     */
    protected $status = null;

    /**
     * @OGM\Property(type="string")
     */
    protected $createdAt;

    /**
     * FriendRequest constructor.
     * @param $from
     * @param $to
     * @param $status
     */
    public function __construct(Member $from, Member $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->createdAt = date("Y-m-d H:i:s");
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function accept()
    {
        $this->status = self::STATUS_ACCEPTED;
    }


    public function reject()
    {
        $this->status = self::STATUS_REJECTED;
    }
}