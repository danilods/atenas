<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbPostoGraduacao
 *
 * @ORM\Table(name="tb_posto_graduacao", indexes={@ORM\Index(name="fk_tb_posto_graduacao_custos_cidades1_idx", columns={"ciruculo_hierarquico_id"})})
 * @ORM\Entity
 */
class TbPostoGraduacao
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
     * @ORM\Column(name="nome_posto", type="string", length=45, nullable=true)
     */
    private $nomePosto;

    /**
     * @var string
     *
     * @ORM\Column(name="especialidade", type="string", length=45, nullable=true)
     */
    private $especialidade;

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
     * @var \TbCirculoHierarquico
     *
     * @ORM\ManyToOne(targetEntity="TbCirculoHierarquico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciruculo_hierarquico_id", referencedColumnName="id")
     * })
     */
    private $ciruculoHierarquico;



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
     * Set nomePosto
     *
     * @param string $nomePosto
     *
     * @return TbPostoGraduacao
     */
    public function setNomePosto($nomePosto)
    {
        $this->nomePosto = $nomePosto;

        return $this;
    }

    /**
     * Get nomePosto
     *
     * @return string
     */
    public function getNomePosto()
    {
        return $this->nomePosto;
    }

    /**
     * Set especialidade
     *
     * @param string $especialidade
     *
     * @return TbPostoGraduacao
     */
    public function setEspecialidade($especialidade)
    {
        $this->especialidade = $especialidade;

        return $this;
    }

    /**
     * Get especialidade
     *
     * @return string
     */
    public function getEspecialidade()
    {
        return $this->especialidade;
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return TbPostoGraduacao
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
     * @return TbPostoGraduacao
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
     * @return TbPostoGraduacao
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
     * @return TbPostoGraduacao
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
     * Set ciruculoHierarquico
     *
     * @param \AppBundle\Entity\TbCirculoHierarquico $ciruculoHierarquico
     *
     * @return TbPostoGraduacao
     */
    public function setCiruculoHierarquico(\AppBundle\Entity\TbCirculoHierarquico $ciruculoHierarquico = null)
    {
        $this->ciruculoHierarquico = $ciruculoHierarquico;

        return $this;
    }

    /**
     * Get ciruculoHierarquico
     *
     * @return \AppBundle\Entity\TbCirculoHierarquico
     */
    public function getCiruculoHierarquico()
    {
        return $this->ciruculoHierarquico;
    }
    public function __toString()
    {
        return $this->nomePosto.' '.$this->especialidade;
    }
}
