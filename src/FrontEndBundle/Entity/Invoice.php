<?php
namespace FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity
* @ORM\Table(name="invoice")
*/
class Invoice
{
    const STATUS_APPROVED = 1;
    const STATUS_NOT_APPROVED = 0;

    public $availableStatus = array(
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_NOT_APPROVED => 'Not Approved'
    );

    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @ORM\Column(type="datetime")
    * @Assert\NotBlank()
    */
    protected $dueDate;

    /**
    * @ORM\Column(type="decimal", scale=2)
    * @Assert\NotBlank()
    * @Assert\Type(type="integer", message="The value {{ value }} is not a valid {{ type }}.")
    */
    protected $amount;

    /**
    * @ORM\Column(type="text")
    * @Assert\NotBlank()
    */
    protected $reference;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Email(message = "The email '{{ value }}' is not a valid email.", checkMX = true, checkHost = true)
    */
    protected $sellerEmail;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\NotBlank()
    * @Assert\Email(message = "The email '{{ value }}' is not a valid email.", checkMX = true, checkHost = true)
    */
    protected $debtorEmail;

    /**
    * @ORM\Column(type="integer")
    */
    protected $status;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $createdTime;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $updatedTime;

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
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Invoice
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return Invoice
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Invoice
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set sellerEmail
     *
     * @param string $sellerEmail
     *
     * @return Invoice
     */
    public function setSellerEmail($sellerEmail)
    {
        $this->sellerEmail = $sellerEmail;

        return $this;
    }

    /**
     * Get sellerEmail
     *
     * @return string
     */
    public function getSellerEmail()
    {
        return $this->sellerEmail;
    }

    /**
    * Set debtorEmail
    *
    * @param string $debtorEmail
    *
    * @return Invoice
    */
    public function setDebtorEmail($debtorEmail)
    {
        $this->debtorEmail = $debtorEmail;

        return $this;
    }

    /**
    * Get debtorEmail
    *
    * @return string
    */
    public function getDebtorEmail()
    {
        return $this->debtorEmail;
    }

    /**
    * Set status
    *
    * @param integer $status
    *
    * @return Invoice
    */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
    * Get status
    *
    * @return integer
    */
    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusName()
    {
        return $this->availableStatus[$this->status];
    }

    /**
     * Set createdTime
     *
     * @param \DateTime $createdTime
     *
     * @return Invoice
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;

        return $this;
    }

    /**
     * Get createdTime
     *
     * @return \DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * Set updatedTime
     *
     * @param \DateTime $updatedTime
     *
     * @return Invoice
     */
    public function setUpdatedTime($updatedTime)
    {
        $this->updatedTime = $updatedTime;

        return $this;
    }

    /**
     * Get updatedTime
     *
     * @return \DateTime
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }
}
