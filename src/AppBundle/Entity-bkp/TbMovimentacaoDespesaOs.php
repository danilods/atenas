<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbMovimentacaoDespesaOs
 *
 * @ORM\Table(name="tb_movimentacao_despesa_os", indexes={@ORM\Index(name="fk_tb_movimentacao_despesa_os_tb_natureza_despesa1_idx", columns={"natureza_despesa_id"}), @ORM\Index(name="fk_tb_movimentacao_despesa_os_tb_ordem_servico1_idx", columns={"ordem_servico_id"})})
 * @ORM\Entity
 */
class TbMovimentacaoDespesaOs
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
     * @var integer
     *
     * @ORM\Column(name="natureza_despesa_id", type="integer", nullable=true)
     */
    private $naturezaDespesaId;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_despesa", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $valorDespesa;

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
     * @var \TbOrdemServico
     *
     * @ORM\ManyToOne(targetEntity="TbOrdemServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ordem_servico_id", referencedColumnName="id")
     * })
     */
    private $ordemServico;

	
	/**
     * @var string
     *
     * @ORM\Column(name="exercicio", type="string", nullable=true)
     */
    private $exercicio;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="registro_em", type="datetime", nullable=false)
     */
    private $registroEm;

	

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
     * @return TbMovimentacaoDespesaOs
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
     * Set naturezaDespesaId
     *
     * @param integer $naturezaDespesaId
     *
     * @return TbMovimentacaoDespesaOs
     */
    public function setNaturezaDespesaId($naturezaDespesaId)
    {
        $this->naturezaDespesaId = $naturezaDespesaId;

        return $this;
    }

    /**
     * Get naturezaDespesaId
     *
     * @return integer
     */
    public function getNaturezaDespesaId()
    {
        return $this->naturezaDespesaId;
    }

    /**
     * Set valorDespesa
     *
     * @param string $valorDespesa
     *
     * @return TbMovimentacaoDespesaOs
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
     * Set registroEm
     *
     * @param \DateTime $registroEm
     *
     * @return TbMovimentacaoDespesaOs
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
     * Set ordemServico
     *
     * @param \AppBundle\Entity\TbOrdemServico $ordemServico
     *
     * @return TbMovimentacaoDespesaOs
     */
    public function setOrdemServico(\AppBundle\Entity\TbOrdemServico $ordemServico = null)
    {
        $this->ordemServico = $ordemServico;

        return $this;
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

    /**
     * Get ordemServico
     *
     * @return \AppBundle\Entity\TbOrdemServico
     */
    public function getOrdemServico()
    {
        return $this->ordemServico;
    }
}
