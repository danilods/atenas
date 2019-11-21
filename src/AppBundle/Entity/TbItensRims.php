<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbItensRims
 *
 * @ORM\Table(name="tb_itens_rims", indexes={@ORM\Index(name="fk_tb_itens_rims_tb_rims1_idx", columns={"tb_rims_id"})})
 * @ORM\Entity
 */
class TbItensRims
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
     * @ORM\Column(name="descricao_item", type="string", length=45, nullable=true)
     */
    private $descricaoItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=true)
     */
    private $quantidade;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_item", type="string", length=45, nullable=true)
     */
    private $valorItem;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_total", type="string", length=45, nullable=true)
     */
    private $valorTotal;

    /**
     * @var \TbProcesso
     *
     * @ORM\ManyToOne(targetEntity="TbProcesso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_rims_id", referencedColumnName="id")
     * })
     */
    private $tbRims;



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
     * Set descricaoItem
     *
     * @param string $descricaoItem
     *
     * @return TbItensRims
     */
    public function setDescricaoItem($descricaoItem)
    {
        $this->descricaoItem = $descricaoItem;

        return $this;
    }

    /**
     * Get descricaoItem
     *
     * @return string
     */
    public function getDescricaoItem()
    {
        return $this->descricaoItem;
    }

    /**
     * Set quantidade
     *
     * @param integer $quantidade
     *
     * @return TbItensRims
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade
     *
     * @return integer
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set valorItem
     *
     * @param string $valorItem
     *
     * @return TbItensRims
     */
    public function setValorItem($valorItem)
    {
        $this->valorItem = $valorItem;

        return $this;
    }

    /**
     * Get valorItem
     *
     * @return string
     */
    public function getValorItem()
    {
        return $this->valorItem;
    }

    /**
     * Set valorTotal
     *
     * @param string $valorTotal
     *
     * @return TbItensRims
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    /**
     * Get valorTotal
     *
     * @return string
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * Set tbRims
     *
     * @param \AppBundle\Entity\TbProcesso $tbRims
     *
     * @return TbItensRims
     */
    public function setTbRims(\AppBundle\Entity\TbProcesso $tbRims = null)
    {
        $this->tbRims = $tbRims;

        return $this;
    }

    /**
     * Get tbRims
     *
     * @return \AppBundle\Entity\TbProcesso
     */
    public function getTbRims()
    {
        return $this->tbRims;
    }
}
