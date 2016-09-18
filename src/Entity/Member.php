<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use GraphAware\Neo4j\OGM\Annotations as OGM;


/**
 * @OGM\Node(label="Person")
 */
class Member
{
    /**
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @OGM\Property(type="string")
     */
    protected $email;

    /**
     * @OGM\Property(type="string")
     */
    protected $forename;

    /**
     * @OGM\Property(type="string")
     */
    protected $surname;

    /**
     * @OGM\Relationship(type="FRIENDS_WITH", direction="OUTGOING", targetEntity="Member", collection=true)
     * @var ArrayCollection|Member[]
     */
    protected $friends;

    /**
     * Member constructor.
     * @param $email
     * @param $forename
     * @param $surname
     */
    public function __construct($email, $forename, $surname)
    {
        $this->email = $email;
        $this->forename = $forename;
        $this->surname = $surname;
        $this->friends = new ArrayCollection();
        $this->friendRequests = new ArrayCollection();
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getForename()
    {
        return $this->forename;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|Member
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * @param Member $member
     */
    public function addFriend(Member $member)
    {
        if (!$this->friends->contains($member)) {
            $this->friends->add($member);
        }
    }


    public function removeFriend(Member $member)
    {
        if ($this->friends->contains($member)) {
            $this->friends->removeElement($member);
        }
    }

    /**
     * @return mixed
     */
    public function getFriendRequests()
    {
        return $this->friendRequests;
    }
}