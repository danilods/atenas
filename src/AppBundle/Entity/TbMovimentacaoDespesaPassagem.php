<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbMovimentacaoDespesaPassagem
 *
 * @ORM\Table(name="tb_movimentacao_despesa_passagem", indexes={@ORM\Index(name="fk_tb_movimentacao_despesa_passagem_tb_natureza_despesa1_idx", columns={"natureza_despesa_id"}), @ORM\Index(name="fk_tb_movimentacao_despesa_passagem_tb_ordem_servico_aeropo_idx", columns={"passagem_id"})})
 * @ORM\Entity
 */
class TbMovimentacaoDespesaPassagem
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
     * @ORM\Column(name="tipo_operacao", type="string", length=45, nullable=true)
     */
    private $tipoOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_despesa", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $valorDespesa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registro_em", type="datetime", nullable=true)
     */
    private $registroEm;

    /**
     * @var integer
     *
     * @ORM\Column(name="natureza_despesa_id", type="integer", nullable=true)
     */
    private $naturezaDespesa;

    /**
     * @var \TbOrdemServicoAeroporto
     *
     * @ORM\ManyToOne(targetEntity="TbOrdemServicoAeroporto", cascade={"Persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="passagem_id", referencedColumnName="id")
     * })
     */
    private $passagem;
	
	 /**
     * @var integer
     *
     * @ORM\Column(name="natureza_missao", type="integer", nullable=false)
     */
    private $naturezaMissao;
	
	 /**
     * @var integer
     *
     * @ORM\Column(name="unidade_id", type="integer", nullable=false)
     */
    private $unidade;


    /**
     * @var integer
     *
     * @ORM\Column(name="ordem_servico_id", type="integer", nullable=false)
     */
    private $ordemServico;
	
	/**
     * @var string
     *
     * @ORM\Column(name="exercicio", type="string", nullable=true)
     */
    private $exercicio;



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
     * Set tipoOperacao
     *
     * @param string $tipoOperacao
     *
     * @return TbMovimentacaoDespesaPassagem
     */
    public function setTipoOperacao($tipoOperacao)
    {
        $this->tipoOperacao = $tipoOperacao;

        return $this;
    }

    /**
     * Get tipoOperacao
     *
     * @return string
     */
    public function getTipoOperacao()
    {
        return $this->tipoOperacao;
    }

    /**
     * Set valorDespesa
     *
     * @param string $valorDespesa
     *
     * @return TbMovimentacaoDespesaPassagem
     */
    public function setValorDespesa($valorDespesa)
    {
        $this->valorDespesa = $valorDespesa;

        return $this;
    }

    /**
     * Get valorDespesa
     *
     * @return string
     */
    public function getValorDespesa()
    {
        return $this->valorDespesa;
    }

    /**
     * Set registroEm
     *
     * @param \DateTime $registroEm
     *
     * @return TbMovimentacaoDespesaPassagem
     */
    public function setRegistroEm($registroEm)
    {
        $this->registroEm = $registroEm;

        return $this;
    }

    /**
     * Get registroEm
     *
     * @return \DateTime
     */
    public function getRegistroEm()
    {
        return $this->registroEm;
    }

    /**
     * Set naturezaDespesa
     *
     * @param \AppBundle\Entity\TbTaxonomiaNaturezaDespesa $naturezaDespesa
     *
     * @return TbMovimentacaoDespesaPassagem
     */
    public function setNaturezaDespesa($naturezaDespesa = null)
    {
        $this->naturezaDespesa = $naturezaDespesa;

        return $this;
    }

    /**
     * Get naturezaDespesa
     *
     * @return \AppBundle\Entity\TbTaxonomiaNaturezaDespesa
     */
    public function getNaturezaDespesa()
    {
        return $this->naturezaDespesa;
    }

    /**
     * Set passagem
     *
     * @param \AppBundle\Entity\TbOrdemServicoAeroporto $passagem
     *
     * @return TbMovimentacaoDespesaPassagem
     */
    public function setPassagem(\AppBundle\Entity\TbOrdemServicoAeroporto $passagem = null)
    {
        $this->passagem = $passagem;

        return $this;
    }

    /**
     * Get passagem
     *
     * @return \AppBundle\Entity\TbOrdemServicoAeroporto
     */
    public function getPassagem()
    {
        return $this->passagem;
    }
	
	/**
     * Set naturezaMissao
     *
     * @param integer $naturezaMissao
     *
     * @return TbMovimentacaoDespesaOs
     */
    public function setNaturezaMissao($naturezaMissao)
    {
        $this->naturezaMissao = $naturezaMissao;

        return $this;
    }

    /**
     * Get naturezaMissao
     *
     * @return integer
     */
    public function getNaturezaMissao()
    {
        return $this->naturezaMissao;
    }

    /**
     * Set unidade
     *
     * @param integer $unidade
     *
     * @return TbMovimentacaoDespesaOs
     */
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Get unidade
     *
     * @return integer
     */
    public function getUnidade()
    {
        return $this->unidadeId;
    }


    /**
     * Set ordemServico
     *
     * @param integer $unidade
     *
     * @return TbMovimentacaoDespesaOs
     */
    public function setOrdemServico($ordemServico)
    {
        $this->ordemServico = $ordemServico;

        return $this;
    }

    /**
     * Get ordemServico
     *
     * @return integer
     */
    public function getOrdemServico()
    {
        return $this->ordemServico;
    }
	
	/**
     * Set exercicio
     *
     * @param string $exercicio
     *
     * @return exercicio
     */
    public function setExercicio($exercicio)
    {
        $this->exercicio = $exercicio;

        return $this;
    }

    /**
     * Get exercicio
     *
     * @return string
     */
    public function getExercicio()
    {
        return $this->exercicio;
    }

}
