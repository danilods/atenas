<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbNaturezaDespesa
 *
 * @ORM\Table(name="tb_natureza_despesa", indexes={@ORM\Index(name="fk_tb_natureza_despesa_tb_orcamento1_idx", columns={"tb_orcamento_id"}), @ORM\Index(name="fk_tb_natureza_despesa_tb_taxonomia_natureza_despesa1_idx", columns={"tb_taxonomia_natureza_despesa_id"})})
 * @ORM\Entity
 */
class TbNaturezaDespesa
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
     * @ORM\Column(name="descricao_natureza", type="string", length=255, nullable=false)
     */
    private $descricaoNatureza;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_natureza", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $valorNatureza;


    /**
     * @var string
     *
     * @ORM\Column(name="valor_descentralizado", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $valorDescentralizado;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_total", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $subTotal;

    /**
     * @ORM\OneToMany(targetEntity="TbControleNaturezaDespesa", mappedBy="tbNaturezaDespesa",cascade={"persist"})
     */
    private $despesas;


    /**
     * @var \TbOrcamento
     *
     * @ORM\ManyToOne(targetEntity="TbOrcamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_orcamento_id", referencedColumnName="id")
     * })
     */
    private $tbOrcamento;

    /**
     * @var \TbTaxonomiaNaturezaDespesa
     *
     * @ORM\ManyToOne(targetEntity="TbTaxonomiaNaturezaDespesa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_taxonomia_natureza_despesa_id", referencedColumnName="id")
     * })
     */
    private $tbTaxonomiaNaturezaDespesa;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="TbProcesso", inversedBy="naturezaDespesa")
     * @ORM\JoinTable(name="tb_natureza_despesa_recurso_processo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="natureza_despesa_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="processo_id", referencedColumnName="id")
     *   }
     * )
     */
    private $processo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->processo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->despesas = new \Doctrine\Common\Collections\ArrayCollection();

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
     * Set descricaoNatureza
     *
     * @param string $descricaoNatureza
     *
     * @return TbNaturezaDespesa
     */
    public function setDescricaoNatureza($descricaoNatureza)
    {
        $this->descricaoNatureza = $descricaoNatureza;

        return $this;
    }

    /**
     * Get descricaoNatureza
     *
     * @return string
     */
    public function getDescricaoNatureza()
    {
        return $this->descricaoNatureza;
    }

    /**
     * Set valorNatureza
     *
     * @param string $valorNatureza
     *
     * @return TbNaturezaDespesa
     */
    public function setValorNatureza($valorNatureza)
    {
        $this->valorNatureza = $valorNatureza;

        return $this;
    }

    /**
     * Get valorDescentralizado
     *
     * @return string
     */
    public function getValorDescentralizado()
    {
        return $this->valorDescentralizado;
    }


    /**
     * Set valorDescentralizado
     *
     * @param string $valorDescentralizado
     *
     * @return TbNaturezaDespesa
     */
    public function setValorDescentralizado($valorDescentralizado)
    {
        $this->valorDescentralizado = $valorDescentralizado;

        return $this;
    }

    /**
     * Get valorNatureza
     *
     * @return string
     */
    public function getValorNatureza()
    {
        return $this->valorNatureza;
    }


    /**
     * Set subTotal
     *
     * @param string $subTotal
     *
     * @return TbNaturezaDespesa
     */
    public function setSubTotal($subTotal)
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * Get subTotal
     *
     * @return string
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * Set dataRegistro
     *
     * @param \DateTime $dataRegistro
     *
     * @return TbNaturezaDespesa
     */
    public function setDataRegistro($dataRegistro)
    {
        $this->dataRegistro = $dataRegistro;

        return $this;
    }

    /**
     * Get dataRegistro
     *
     * @return \DateTime
     */
    public function getDataRegistro()
    {
        return $this->dataRegistro;
    }

    /**
     * Set tbOrcamento
     *
     * @param \AppBundle\Entity\TbOrcamento $tbOrcamento
     *
     * @return TbNaturezaDespesa
     */
    public function setTbOrcamento(\AppBundle\Entity\TbOrcamento $tbOrcamento = null)
    {
        $this->tbOrcamento = $tbOrcamento;

        return $this;
    }

    /**
     * Get tbOrcamento
     *
     * @return \AppBundle\Entity\TbOrcamento
     */
    public function getTbOrcamento()
    {
        return $this->tbOrcamento;
    }

    /**
     * Set tbTaxonomiaNaturezaDespesa
     *
     * @param \AppBundle\Entity\TbTaxonomiaNaturezaDespesa $tbTaxonomiaNaturezaDespesa
     *
     * @return TbNaturezaDespesa
     */
    public function setTbTaxonomiaNaturezaDespesa(\AppBundle\Entity\TbTaxonomiaNaturezaDespesa $tbTaxonomiaNaturezaDespesa = null)
    {
        $this->tbTaxonomiaNaturezaDespesa = $tbTaxonomiaNaturezaDespesa;

        return $this;
    }

    /**
     * Get tbTaxonomiaNaturezaDespesa
     *
     * @return \AppBundle\Entity\TbTaxonomiaNaturezaDespesa
     */
    public function getTbTaxonomiaNaturezaDespesa()
    {
        return $this->tbTaxonomiaNaturezaDespesa;
    }

    /**
     * Add processo
     *
     * @param \AppBundle\Entity\TbProcesso $processo
     *
     * @return TbNaturezaDespesa
     */
    public function addProcesso(\AppBundle\Entity\TbProcesso $processo)
    {
        $this->processo[] = $processo;

        return $this;
    }

    /**
     * Remove processo
     *
     * @param \AppBundle\Entity\TbProcesso $processo
     */
    public function removeProcesso(\AppBundle\Entity\TbProcesso $processo)
    {
        $this->processo->removeElement($processo);
    }

    /**
     * Get processo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProcesso()
    {
        return $this->processo;
    }
	
	public function __toString(){
		
		return $this->getTbTaxonomiaNaturezaDespesa().'';
	}

    /**
     * Add despesa
     *
     * @param \AppBundle\Entity\TbControleNaturezaDespesa $despesa
     *
     * @return TbNaturezaDespesa
     */
    public function addDespesa(\AppBundle\Entity\TbControleNaturezaDespesa $despesa)
    {
        $this->despesas[] = $despesa;

        return $this;
    }

    /**
     * Remove despesa
     *
     * @param \AppBundle\Entity\TbControleNaturezaDespesa $despesa
     */
    public function removeDespesa(\AppBundle\Entity\TbControleNaturezaDespesa $despesa)
    {
        $this->despesas->removeElement($despesa);
    }

    /**
     * Get despesas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDespesas()
    {
        return $this->despesas;
    }

    
}
