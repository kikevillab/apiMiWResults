<?php   // src/Entity/Result.php

namespace MiW16\Results\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Result
 *
 * @package MiW16\Results\Entity
 *
 * @ORM\Entity
 * @ORM\Table(
 *      name="results",
 *      indexes={
 *          @ORM\Index(name="FK_USER_ID_idx", columns={"user_id"})
 *      }
 *     )
 */
class Result implements \JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="result", type="integer", nullable=false)
     */
    protected $result;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    protected $time;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    protected $user;

    /**
     * Result constructor.
     *
     * @param int       $result result
     * @param User      $user   user
     * @param \DateTime $time   time
     */
    public function __construct($result, User $user, \DateTime $time)
    {
        $this->id     = 0;
        $this->result = $result;
        $this->user   = $user;
        $this->time   = $time;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param int $result
     * @return Result
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Result
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     * @return Result
     */
    public function setTime(\DateTime $time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Implements __toString()
     *
     * @return string
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        return sprintf(
            '%3d - %3d - %30s - %s',
            $this->id,
            $this->result,
            $this->user,
            $this->time->format('Y-m-d H:i:s')
        );
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return array(
            'id'     => $this->id,
            'result' => $this->result,
            'user'   => $this->user,
            'time'   => $this->time
        );
    }
}

/**
 * @SWG\Definition(
 *     definition="Result",
 *     required = { "id", "result", "time", "user" },
 *     @SWG\Property(
 *          property    = "id",
 *          description = "Result Id",
 *          type        = "integer",
 *          format      = "int32"
 *      ),
 *      @SWG\Property(
 *          property    = "result",
 *          description = "Result result",
 *          type        = "integer"
 *      ),
 *      @SWG\Property(
 *          property    = "time",
 *          description = "Result time",
 *          type        = "dateTime"
 *      ),
 *      @SWG\Property(
 *          property    = "user",
 *          description = "Result User",
 *          type        = "User"
 *      ),
 *      example = {
 *          "id"       = 1508,
 *          "result"   = "Result result",
 *          "time"     = "Result time",
 *          "user"     = "Result User"
 *     }
 * )
 * @SWG\Parameter(
 *      name        = "resultId",
 *      in          = "path",
 *      description = "ID of result to fetch",
 *      required    = true,
 *      type        = "integer",
 *      format      = "int32"
 * )
 */

/**
 * @SWG\Definition(
 *      definition = "ResultData",
 *      @SWG\Property(
 *          property    = "result",
 *          description = "Result result",
 *          type        = "integer"
 *          format      = "int32"
 *      ),
 *      @SWG\Property(
 *          property    = "time",
 *          description = "Result time",
 *          type        = "date"
 *      ),
 *      @SWG\Property(
 *          property    = "idUser",
 *          description = "Result User",
 *          type        = "integer"
 *          format      = "int32"
 *      ),
 *      example = {
 *          "result"    = "35",
 *          "time"      = "2016-10-22",
 *          "idUser"    = "7"
 *      }
 * )
 */

/**
 * User array definition
 *
 * @SWG\Definition(
 *     definition = "ResultsArray",
 *      @SWG\Property(
 *          property    = "results",
 *          description = "Results array",
 *          type        = "array",
 *          items       = {
 *              "$ref": "#/definitions/Result"
 *          }
 *      )
 * )
 */
