<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeografiaUf
 *
 * @ORM\Table(name="geografia_uf", indexes={@ORM\Index(name="fk_geografia_uf_geografia_pais1_idx", columns={"pais_id"})})
 * @ORM\Entity
 */
class GeografiaUf
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
     * @ORM\Column(name="nome_codigo", type="string", length=45, nullable=true)
     */
    private $nomeCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="regiao", type="string", length=45, nullable=true)
     */
    private $regiao;

    /**
     * @var string
     *
     * @ORM\Column(name="comar", type="string", length=45, nullable=true)
     */
    private $comar;

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
     * @ORM\Column(name="diaria", type="integer", nullable=false)
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
     * @return GeografiaUf
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
     * Set nomeCodigo
     *
     * @param string $nomeCodigo
     *
     * @return GeografiaUf
     */
    public function setNomeCodigo($nomeCodigo)
    {
        $this->nomeCodigo = $nomeCodigo;

        return $this;
    }

    /**
     * Get nomeCodigo
     *
     * @return string
     */
    public function getNomeCodigo()
    {
        return $this->nomeCodigo;
    }

    /**
     * Set regiao
     *
     * @param string $regiao
     *
     * @return GeografiaUf
     */
    public function setRegiao($regiao)
    {
        $this->regiao = $regiao;

        return $this;
    }

    /**
     * Get regiao
     *
     * @return string
     */
    public function getRegiao()
    {
        return $this->regiao;
    }

    /**
     * Set comar
     *
     * @param string $comar
     *
     * @return GeografiaUf
     */
    public function setComar($comar)
    {
        $this->comar = $comar;

        return $this;
    }

    /**
     * Get comar
     *
     * @return string
     */
    public function getComar()
    {
        return $this->comar;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return GeografiaUf
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
     * @return GeografiaUf
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
     * @return GeografiaUf
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
     * @return GeografiaUf
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
     * @return GeografiaUf
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

    public function __toString()
    {
        return $this->nomeCodigo;
    }
}
