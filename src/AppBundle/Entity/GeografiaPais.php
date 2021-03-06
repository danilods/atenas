<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeografiaPais
 *
 * @ORM\Table(name="geografia_pais")
 * @ORM\Entity
 */
class GeografiaPais
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
     * @ORM\Column(name="continente", type="string", length=45, nullable=true)
     */
    private $continente;

    /**
     * @var string
     *
     * @ORM\Column(name="idioma_codigo", type="string", length=45, nullable=true)
     */
    private $idiomaCodigo;
	
	/**
     * @var string
     *
     * @ORM\Column(name="grupo", type="string", length=1, nullable=true)
     */
    private $grupo;

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
     * @return GeografiaPais
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
     * @return GeografiaPais
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
     * Set continente
     *
     * @param string $continente
     *
     * @return GeografiaPais
     */
    public function setContinente($continente)
    {
        $this->continente = $continente;

        return $this;
    }

    /**
     * Get continente
     *
     * @return string
     */
    public function getContinente()
    {
        return $this->continente;
    }

    /**
     * Set idiomaCodigo
     *
     * @param string $idiomaCodigo
     *
     * @return GeografiaPais
     */
    public function setIdiomaCodigo($idiomaCodigo)
    {
        $this->idiomaCodigo = $idiomaCodigo;

        return $this;
    }

    /**
     * Get idiomaCodigo
     *
     * @return string
     */
    public function getIdiomaCodigo()
    {
        return $this->idiomaCodigo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return GeografiaPais
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
     * @return GeografiaPais
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
     * @return GeografiaPais
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

    public function __toString()
    {
        return $this->nome;
    }

    /**
     * Set grupo
     *
     * @param string $grupo
     *
     * @return GeografiaPais
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string
     */
    public function getGrupo()
    {
        return $this->grupo;
    }
}
