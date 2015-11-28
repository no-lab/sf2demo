<?php
namespace FrontEndBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="invoice")
*/
class Invoice
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $dueDate;

    /**
    * @ORM\Column(type="decimal", scale=2)
    */
    protected $amount;

    /**
    * @ORM\Column(type="text")
    */
    protected $reference;

    /**
    * @ORM\Column(type="string", length=255)
    */
    protected $sellerEmail;

    /**
    * @ORM\Column(type="string", length=255)
    */
    protected $debtorEmail;

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
