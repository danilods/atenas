<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbUnidade
 *
 * @ORM\Table(name="tb_ordem_servico_aeroporto_ext")
 * @ORM\Entity
 */
class TbOrdemServicoAeroportoExt
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
     * @var \DateTime
     *
     * @ORM\Column(name="data_viagem", type="date", nullable=true)
     */
    private $dataViagem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horario_viagem", type="string", nullable=true)
     */
    private $horarioViagem;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_passagem", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $valorPassagem;

    /**
     * @var string
     *
     * @ORM\Column(name="aerodromo_destino", type="string", length=255, nullable=false)
     */
    private $aerodromoDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="aerodromo_origem", type="string", length=255, nullable=false)
     */
    private $aerodromoOrigem;

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
     * @var \TbOrdemServico
     *
     * @ORM\ManyToOne(targetEntity="TbOrdemServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ordem_servico_id", referencedColumnName="id")
     * })
     */
    private $ordemServico;
	
	
	/**
     * @var \String
     *
     * @ORM\Column(name="observacoes", type="text", nullable=true)
     */
    private $observacoes;
	
	/**
     * @var \String
     *
     * @ORM\Column(name="obs_cenipa", type="text", nullable=true)
     */
    private $obsDpg;



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
     * Set dataViagem
     *
     * @param \DateTime $dataViagem
     *
     * @return TbOrdemServicoAeroporto
     */
    public function setDataViagem($dataViagem)
    {
        $this->dataViagem = $dataViagem;

        return $this;
    }

    /**
     * Get dataViagem
     *
     * @return \DateTime
     */
    public function getDataViagem()
    {
        return $this->dataViagem;
    }

    /**
     * Set horarioViagem
     *
     * @param \DateTime $horarioViagem
     *
     * @return TbOrdemServicoAeroporto
     */
    public function setHorarioViagem($horarioViagem)
    {
        $this->horarioViagem = $horarioViagem;

        return $this;
    }

    /**
     * Get horarioViagem
     *
     * @return \DateTime
     */
    public function getHorarioViagem()
    {
        return $this->horarioViagem;
    }

    /**
     * Set valorPassagem
     *
     * @param string $valorPassagem
     *
     * @return TbOrdemServicoAeroporto
     */
    public function setValorPassagem($valorPassagem)
    {
        $this->valorPassagem = $valorPassagem;

        return $this;
    }

    /**
     * Get valorPassagem
     *
     * @return string
     */
    public function getValorPassagem()
    {
        return $this->valorPassagem;
    }

    


    /**
     * Set tbTaxonomiaNaturezaDespesa
     *
     * @param \AppBundle\Entity\TbTaxonomiaNaturezaDespesa $tbTaxonomiaNaturezaDespesa
     *
     * @return TbOrdemServicoAeroporto
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
     * Set ordemServico
     *
     * @param \AppBundle\Entity\TbOrdemServico $ordemServico
     *
     * @return TbOrdemServicoAeroporto
     */
    public function setOrdemServico(\AppBundle\Entity\TbOrdemServico $ordemServico = null)
    {
        $this->ordemServico = $ordemServico;

        return $this;
    }

    /**
     * Get ordemServico
     *
     * @return \AppBundle\Entity\TbOrdemServico
     */
    public function getOrdemServico()
    {
        return $this->ordemServico;
    }
	
	public function __toString(){
		return $this->aerodromoOrigem.'/'.$this->aerodromoDestino;
	}

    /**
     * Set observacoes
     *
     * @param string $observacoes
     *
     * @return TbOrdemServicoAeroporto
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Get observacoes
     *
     * @return string
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Set obsDpg
     *
     * @param string $obsDpg
     *
     * @return TbOrdemServicoAeroporto
     */
    public function setObsDpg($obsDpg)
    {
        $this->obsDpg = $obsDpg;

        return $this;
    }

    /**
     * Get obsDpg
     *
     * @return string
     */
    public function getObsDpg()
    {
        return $this->obsDpg;
    }

    /**
     * Set aerodromoDestino
     *
     * @param string $aerodromoDestino
     *
     * @return TbOrdemServicoAeroportoExt
     */
    public function setAerodromoDestino($aerodromoDestino)
    {
        $this->aerodromoDestino = $aerodromoDestino;

        return $this;
    }

    /**
     * Get aerodromoDestino
     *
     * @return string
     */
    public function getAerodromoDestino()
    {
        return $this->aerodromoDestino;
    }

    /**
     * Set aerodromoOrigem
     *
     * @param string $aerodromoOrigem
     *
     * @return TbOrdemServicoAeroportoExt
     */
    public function setAerodromoOrigem($aerodromoOrigem)
    {
        $this->aerodromoOrigem = $aerodromoOrigem;

        return $this;
    }

    /**
     * Get aerodromoOrigem
     *
     * @return string
     */
    public function getAerodromoOrigem()
    {
        return $this->aerodromoOrigem;
    }
}
