<?php

namespace JYPS\RegisterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 */
class Member implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=30)
    */ 
    private $firstname;
    /**
     * @ORM\Column(type="string", length=30, nullable=true)
    */ 
    private $second_name;
    /**
    * @ORM\Column(type="string", length=50)
    */ 
    private $surname;
    /**
    * @ORM\Column(type="string", length=60)
    */ 
    private $street_address;
    /**
    * @ORM\Column(type="string", length=10)
     * @Expose
    */
    private $postal_code;
    /**
    * @ORM\Column(type="string", length=60)
    * @Expose
    */
    private $city;
    /**
    * @ORM\Column(type="string", length=60, nullable=true)
    * @Expose
    */
    private $country;
    /**
    * @ORM\Column(type="string", length=60, nullable=true)
    */
    private $email;
    /**
    * @ORM\Column(type="string", length=60, nullable=true)
    */
    private $referer_person_name;
    /**
    * @ORM\Column(type="boolean")
    */
    private $magazine_preference;
    /**
    * @ORM\Column(type="boolean")
    */
    private $invoice_preference;
    /**
    * @ORM\Column(type="string", length=255,nullable=true)
    */
    private $memo;
    /**
    * @ORM\Column(type="date")
    * @Expose
    */
    private $membership_start_date;
    /**
    * @ORM\Column(type="date", nullable=true)
    * @Expose
    */
    private $membership_end_date;
    /**
    * @ORM\Column(type="integer", nullable=true)
    * @Expose
    */
    private $birth_year;
    /**
    * @ORM\Column(type="integer",unique=true)
    * @ORM\GeneratedValue(strategy="AUTO")
    * @Expose
    */
    private $member_id;
    /**
    * @ORM\Column(type="string", nullable=true)
    */   
    private $telephone;
    /**
    * @ORM\Column(type="boolean", nullable=true)
    * @Expose
    */   
    private $gender;
    /**
    * @ORM\Column(type="string", nullable=true)
    */   
    private $selfcare_password;
   /**
    * @ORM\Column(type="string", nullable=true)
    */   
    private $selfcare_password_salt;
    /**
    * @ORM\Column(type="string", nullable=true)
    */   
    private $join_form_freeword;
    /**
    * @ORM\Column(type="boolean")
    */   
    private $mailing_list_yleinen;
    /**
    * @ORM\Column(type="date", nullable=true)
    */
    private $reminder_sent_date;
    /**
     * @ORM\OneToMany(targetEntity="MemberFee", mappedBy="memberfee", cascade={"persist", "remove"})
     */
    protected $memberfees;
     /**
     * @ORM\OneToMany(targetEntity="Intrest", mappedBy="intrest",  cascade={"persist", "remove"})
     */
    protected $intrests;
    /**
     * @ORM\ManyToOne(targetEntity="MemberFeeConfig", inversedBy="membertypes", cascade={"persist", "remove"})
     * '
     */
    protected $member_type;
    
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->membership_start_date = new \DateTime("now");
        $this->selfcare_passowrd_salt = md5(uniqid(null, true));
        $this->mailing_list_yleinen = false;
        $this->magazine_preference = false;
        $this->invoice_preference = false;

    }

    public function getUsername()
    {
        return $this->username;
    }
    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }
    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }
    
    /**
     * @inheritDoc
     */
    public function getFullName()
    {
        $fullname = $this->firstname." ".$this->second_name." ".$this->surname;
        return  $fullname;
    }

    /**
     * @inheritDoc
     */
    public function getFullNameSurnameFirst()
    {
        $fullname = $this->surname." ".$this->firstname;
        return  $fullname;
    }

    public function getFullAddress()
    {
        $fulladdress = $this->street_address." ".$this->postal_code." ".$this->city;
        return $fulladdress;
    }
  

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
    
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->salt,
            $this->password,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->salt,
            $this->password,
        ) = unserialize($serialized);
    }
 
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
     * Set firstname
     *
     * @param string $firstname
     * @return Member
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Member
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set street_address
     *
     * @param string $streetAddress
     * @return Member
     */
    public function setStreetAddress($streetAddress)
    {
        $this->street_address = $streetAddress;

        return $this;
    }

    /**
     * Get street_address
     *
     * @return string 
     */
    public function getStreetAddress()
    {
        return $this->street_address;
    }

    /**
     * Set postal_code
     *
     * @param integer $postalCode
     * @return Member
     */
    public function setPostalCode($postalCode)
    {
        $this->postal_code = $postalCode;

        return $this;
    }

    /**
     * Get postal_code
     *
     * @return integer 
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Member
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Member
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Member
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set referer_person_name
     *
     * @param string $refererPersonName
     * @return Member
     */
    public function setRefererPersonName($refererPersonName)
    {
        $this->referer_person_name = $refererPersonName;

        return $this;
    }

    /**
     * Get referer_person_name
     *
     * @return string 
     */
    public function getRefererPersonName()
    {
        return $this->referer_person_name;
    }

    /**
     * Set magazine_preference
     *
     * @param integer $magazinePreference
     * @return Member
     */
    public function setMagazinePreference($magazinePreference)
    {
        $this->magazine_preference = $magazinePreference;

        return $this;
    }

    /**
     * Get magazine_preference
     *
     * @return integer 
     */
    public function getMagazinePreference()
    {
        return $this->magazine_preference;
    }

    /**
     * Set invoice_preference
     *
     * @param integer $invoicePreference
     * @return Member
     */
    public function setInvoicePreference($invoicePreference)
    {
        $this->invoice_preference = $invoicePreference;

        return $this;
    }

    /**
     * Get invoice_preference
     *
     * @return integer 
     */
    public function getInvoicePreference()
    {
        return $this->invoice_preference;
    }

    /**
     * Set memo
     *
     * @param string $memo
     * @return Member
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * Get memo
     *
     * @return string 
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set membership_start_date
     *
     * @param \DateTime $membershipStartDate
     * @return Member
     */
    public function setMembershipStartDate($membershipStartDate)
    {
        $this->membership_start_date = $membershipStartDate;

        return $this;
    }

    /**
     * Get membership_start_date
     *
     * @return \DateTime 
     */
    public function getMembershipStartDate()
    {
        return $this->membership_start_date;
    }

    /**
     * Set membership_end_date
     *
     * @param \DateTime $membershipEndDate
     * @return Member
     */
    public function setMembershipEndDate($membershipEndDate)
    {
        $this->membership_end_date = $membershipEndDate;

        return $this;
    }

    /**
     * Get membership_end_date
     *
     * @return \DateTime 
     */
    public function getMembershipEndDate()
    {
        return $this->membership_end_date;
    }
    /**
     * Get memberid
     *
     * @return integer 
     */
    public function getMemberid()
    {
        return $this->member_id;
    }

    /**
     * Set selfcare_password
     *
     * @param string $selfcarePassword
     * @return Member
     */
    public function setSelfcarePassword($selfcarePassword)
    {
        $this->selfcare_password = $selfcarePassword;

        return $this;
    }

    /**
     * Get selfcare_password
     *
     * @return string 
     */
    public function getSelfcarePassword()
    {
        return $this->selfcare_password;
    }
    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    /**
     * Set selfcare_password_salt
     *
     * @param string $selfcarePasswordSalt
     * @return Member
     */
    public function setSelfcarePasswordSalt($selfcarePasswordSalt)
    {
        $this->selfcare_password_salt = $selfcarePasswordSalt;

        return $this;
    }

    /**
     * Get selfcare_password_salt
     *
     * @return string 
     */
    public function getSelfcarePasswordSalt()
    {
        return $this->selfcare_password_salt;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Member
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Member
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set member_id
     *
     * @param integer $memberId
     * @return Member
     */
    public function setMemberId($memberId)
    {
        $this->member_id = $memberId;

        return $this;
    }

    /**
     * Set interests
     *
     * @param string $interests
     * @return Member
     */
    public function setinterests($interests)
    {
        $this->interests = $interests;

        return $this;
    }

   

    /**
     * Set join_form_freeword
     *
     * @param string $joinFormFreeword
     * @return Member
     */
    public function setJoinFormFreeword($joinFormFreeword)
    {
        $this->join_form_freeword = $joinFormFreeword;

        return $this;
    }

    /**
     * Get join_form_freeword
     *
     * @return string 
     */
    public function getJoinFormFreeword()
    {
        return $this->join_form_freeword;
    }

    /**
     * Set mailing_list_yleinen
     *
     * @param boolean $mailingListYleinen
     * @return Member
     */
    public function setMailingListYleinen($mailingListYleinen)
    {
        $this->mailing_list_yleinen = $mailingListYleinen;

        return $this;
    }

    /**
     * Get mailing_list_yleinen
     *
     * @return boolean 
     */
    public function getMailingListYleinen()
    {
        return $this->mailing_list_yleinen;
    }

    /**
     * Add memberfees
     *
     * @param \JYPS\RegisterBundle\Entity\MemberFee $memberfees
     * @return Member
     */
    public function addMemberfee(\JYPS\RegisterBundle\Entity\MemberFee $memberfees)
    {
        $this->memberfees[] = $memberfees;

        return $this;
    }

    /**
     * Remove memberfees
     *
     * @param \JYPS\RegisterBundle\Entity\MemberFee $memberfees
     */
    public function removeMemberfee(\JYPS\RegisterBundle\Entity\MemberFee $memberfees)
    {
        $this->memberfees->removeElement($memberfees);
    }

    /**
     * Get memberfees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMemberfees()
    {
        return $this->memberfees;
    }


    /**
     * Add intrests
     *
     * @param \JYPS\RegisterBundle\Entity\Intrest $intrests
     * @return Member
     */
    public function addIntrest(\JYPS\RegisterBundle\Entity\Intrest $intrests)
    {
        $this->intrests[] = $intrests;

        return $this;
    }

    /**
     * Remove intrests
     *
     * @param \JYPS\RegisterBundle\Entity\Intrest $intrests
     */
    public function removeIntrest(\JYPS\RegisterBundle\Entity\Intrest $intrests)
    {
        $this->intrests->removeElement($intrests);
    }

    /**
     * Get intrests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIntrests()
    {
        return $this->intrests;
    }

    /**
     * Set birth_year
     *
     * @param integer $birthYear
     * @return Member
     */
    public function setBirthYear($birthYear)
    {
        $this->birth_year = $birthYear;

        return $this;
    }

    /**
     * Get birth_year
     *
     * @return integer 
     */
    public function getBirthYear()
    {
        return $this->birth_year;
    }


    /**
     * Set member_type
     *
     * @param \JYPS\RegisterBundle\Entity\MemberFeeConfig $memberType
     * @return Member
     */
    public function setMemberType(\JYPS\RegisterBundle\Entity\MemberFeeConfig $memberType = null)
    {
        $this->member_type = $memberType;

        return $this;
    }

    /**
     * Get member_type
     *
     * @return \JYPS\RegisterBundle\Entity\MemberFeeConfig 
     */
    public function getMemberType()
    {
        return $this->member_type;
    }

    /**
     * Set second_name
     *
     * @param string $secondName
     * @return Member
     */
    public function setSecondName($secondName)
    {
        $this->second_name = $secondName;

        return $this;
    }

    /**
     * Get second_name
     *
     * @return string 
     */
    public function getSecondName()
    {
        return $this->second_name;
    }

    /**
     * Set reminder_sent_date
     *
     * @param \DateTime $reminderSentDate
     * @return Member
     */
    public function setReminderSentDate($reminderSentDate)
    {
        $this->reminder_sent_date = $reminderSentDate;

        return $this;
    }

    /**
     * Get reminder_sent_date
     *
     * @return \DateTime 
     */
    public function getReminderSentDate()
    {
        return $this->reminder_sent_date;
    }
}
