<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * TbDivisao
 * @UniqueEntity(fields="sigla", message="Sigla/divisão já existente")
 * @ORM\Table(name="tb_divisao", indexes={@ORM\Index(name="fk_tb_divisao_tb_unidade1_idx", columns={"unidade_id"})})
 * @ORM\Entity
 */
class TbDivisao
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
     * @ORM\Column(name="nome_departamento", type="string", length=45, nullable=true)
     */
    private $nomeDepartamento;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao_departamento", type="string", length=45, nullable=true)
     */
    private $descricaoDepartamento;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=45, nullable=true)
     */
    private $sigla;

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
     * @var \TbUnidade
     *
     * @ORM\ManyToOne(targetEntity="TbUnidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unidade_id", referencedColumnName="id")
     * })
     */
    private $unidade;



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
     * Set nomeDepartamento
     *
     * @param string $nomeDepartamento
     *
     * @return TbDivisao
     */
    public function setNomeDepartamento($nomeDepartamento)
    {
        $this->nomeDepartamento = $nomeDepartamento;

        return $this;
    }

    /**
     * Get nomeDepartamento
     *
     * @return string
     */
    public function getNomeDepartamento()
    {
        return $this->nomeDepartamento;
    }

    /**
     * Set descricaoDepartamento
     *
     * @param string $descricaoDepartamento
     *
     * @return TbDivisao
     */
    public function setDescricaoDepartamento($descricaoDepartamento)
    {
        $this->descricaoDepartamento = $descricaoDepartamento;

        return $this;
    }

    /**
     * Get descricaoDepartamento
     *
     * @return string
     */
    public function getDescricaoDepartamento()
    {
        return $this->descricaoDepartamento;
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return TbDivisao
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TbDivisao
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
     * @return TbDivisao
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
     * @return TbDivisao
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
     * Set unidade
     *
     * @param \AppBundle\Entity\TbUnidade $unidade
     *
     * @return TbDivisao
     */
    public function setUnidade(\AppBundle\Entity\TbUnidade $unidade = null)
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Get unidade
     *
     * @return \AppBundle\Entity\TbUnidade
     */
    public function getUnidade()
    {
        return $this->unidade;
    }
    public function __toString()
    {
        return ''.$this->nomeDepartamento;
    }
}
