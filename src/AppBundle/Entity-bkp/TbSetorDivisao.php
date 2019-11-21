<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * TbSetorDivisao
 *
 * @ORM\Table(name="tb_setor_divisao", indexes={@ORM\Index(name="fk_setor_divisao_tb_divisao1_idx", columns={"tb_divisao_id"})})
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"sigla"},
 *     errorPath="sigla",
 *     message="Esta sigla j? existe na base de dados."
 * )
 */
class TbSetorDivisao
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
     * @ORM\Column(name="nome_setor", type="string", length=45, nullable=true)
     */
    private $nomeSetor;

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
     * @var \TbDivisao
     *
     * @ORM\ManyToOne(targetEntity="TbDivisao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_divisao_id", referencedColumnName="id")
     * })
     */
    private $tbDivisao;



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
     * Set nomeSetor
     *
     * @param string $nomeSetor
     *
     * @return TbSetorDivisao
     */
    public function setNomeSetor($nomeSetor)
    {
        $this->nomeSetor = $nomeSetor;

        return $this;
    }

    /**
     * Get nomeSetor
     *
     * @return string
     */
    public function getNomeSetor()
    {
        return $this->nomeSetor;
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return TbSetorDivisao
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
     * @return TbSetorDivisao
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
     * @return TbSetorDivisao
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
     * @return TbSetorDivisao
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
     * Set tbDivisao
     *
     * @param \AppBundle\Entity\TbDivisao $tbDivisao
     *
     * @return TbSetorDivisao
     */
    public function setTbDivisao(\AppBundle\Entity\TbDivisao $tbDivisao = null)
    {
        $this->tbDivisao = $tbDivisao;

        return $this;
    }

    /**
     * Get tbDivisao
     *
     * @return \AppBundle\Entity\TbDivisao
     */
    public function getTbDivisao()
    {
        return $this->tbDivisao;
    }
    public function __toString()
    {
        return $this->getSigla()."";
    }
}
