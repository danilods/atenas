<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeografiaCidade
 *
 * @ORM\Table(name="geografia_cidade", indexes={@ORM\Index(name="fk_geografia_cidade_geografia_uf1_idx", columns={"uf_id"}), @ORM\Index(name="fk_geografia_cidade_geografia_pais1_idx", columns={"pais_id"})})
 * @ORM\Entity
 */
class GeografiaCidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=45, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=45, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="altitude", type="string", length=45, nullable=true)
     */
    private $altitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="diaria", type="integer", nullable=true)
     */
    private $diaria;

    /**
     * @var \GeografiaPais
     *
     * @ORM\ManyToOne(targetEntity="GeografiaPais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     * })
     */
    private $pais;

    /**
     * @var \GeografiaUf
     *
     * @ORM\ManyToOne(targetEntity="GeografiaUf")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uf_id", referencedColumnName="id")
     * })
     */
    private $uf;



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
     * Set nome
     *
     * @param string $nome
     *
     * @return GeografiaCidade
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return GeografiaCidade
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return GeografiaCidade
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set altitude
     *
     * @param string $altitude
     *
     * @return GeografiaCidade
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;

        return $this;
    }

    /**
     * Get altitude
     *
     * @return string
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return GeografiaCidade
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return GeografiaCidade
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return GeografiaCidade
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set diaria
     *
     * @param integer $diaria
     *
     * @return GeografiaCidade
     */
    public function setDiaria($diaria)
    {
        $this->diaria = $diaria;

        return $this;
    }

    /**
     * Get diaria
     *
     * @return integer
     */
    public function getDiaria()
    {
        return $this->diaria;
    }

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\GeografiaPais $pais
     *
     * @return GeografiaCidade
     */
    public function setPais(\AppBundle\Entity\GeografiaPais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\GeografiaPais
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set uf
     *
     * @param \AppBundle\Entity\GeografiaUf $uf
     *
     * @return GeografiaCidade
     */
    public function setUf(\AppBundle\Entity\GeografiaUf $uf = null)
    {
        $this->uf = $uf;
        return $this;
    }

    /**
     * Get uf
     *
     * @return \AppBundle\Entity\GeografiaUf
     */
    public function getUf()
    {
        return $this->uf;
    }

    public function __toString()
    {
        return $this->nome.' - '.$this->getUf();
    }
}
