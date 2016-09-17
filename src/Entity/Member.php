<?php

namespace Application\Entity;

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
}