<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matches
 *
 * @ORM\Table(name="matches")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MatchesRepository")
 */
class Matches
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumn(name="local_team_id", referencedColumnName="id")
     */
    private $localteam;

    /**
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team")
     * @ORM\JoinColumn(name="visit_team_id", referencedColumnName="id")
     */
    private $visitteam;

    /**
     * @var int
     *
     * @ORM\Column(name="local_goals", type="integer", nullable=true)
     */
    private $localgoals;

    /**
     * @var int
     *
     * @ORM\Column(name="visit_goals", type="integer", nullable=true)
     */
    private $visitgoals;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Matches
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set localgoals
     *
     * @param integer $localgoals
     *
     * @return Matches
     */
    public function setLocalgoals($localgoals)
    {
        $this->localgoals = $localgoals;

        return $this;
    }

    /**
     * Get localgoals
     *
     * @return integer
     */
    public function getLocalgoals()
    {
        return $this->localgoals;
    }

    /**
     * Set visitgoals
     *
     * @param integer $visitgoals
     *
     * @return Matches
     */
    public function setVisitgoals($visitgoals)
    {
        $this->visitgoals = $visitgoals;

        return $this;
    }

    /**
     * Get visitgoals
     *
     * @return integer
     */
    public function getVisitgoals()
    {
        return $this->visitgoals;
    }

    /**
     * Set localteam
     *
     * @param \AppBundle\Entity\Team $localteam
     *
     * @return Matches
     */
    public function setLocalteam(\AppBundle\Entity\Team $localteam = null)
    {
        $this->localteam = $localteam;

        return $this;
    }

    /**
     * Get localteam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getLocalteam()
    {
        return $this->localteam;
    }

    /**
     * Set visitteam
     *
     * @param \AppBundle\Entity\Team $visitteam
     *
     * @return Matches
     */
    public function setVisitteam(\AppBundle\Entity\Team $visitteam = null)
    {
        $this->visitteam = $visitteam;

        return $this;
    }

    /**
     * Get visitteam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getVisitteam()
    {
        return $this->visitteam;
    }
}
