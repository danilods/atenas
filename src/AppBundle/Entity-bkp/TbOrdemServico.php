<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbOrdemServico
 *
 * @ORM\Table(name="tb_ordem_servico", indexes={@ORM\Index(name="fk_tb_ordem_servico_geografia_cidade1_idx", columns={"cidade_id"}), @ORM\Index(name="fk_tb_ordem_servico_natureza_missao1_idx", columns={"natureza_missao_id"}), @ORM\Index(name="fk_tb_ordem_servico_tb_usuario1_idx", columns={"tb_usuario_id"}), @ORM\Index(name="fk_tb_ordem_servico_tb_taxonomia_natureza_despesa1_idx", columns={"tb_taxonomia_natureza_despesa_id"}), @ORM\Index(name="fk_tb_ordem_servico_tb_setor_divisao1_idx", columns={"setor_id"})})
 * @ORM\Entity
 */
class TbOrdemServico
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
     * @ORM\Column(name="status_os", type="string", length=255, nullable=true)
     */
    private $statusOs;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="status_passagem", type="integer", nullable=true)
     */
    private $statusPassagem;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_ordem_servico", type="string", length=45, nullable=true)
     */
    private $numeroOrdemServico;
	
	/**
     * @var string
     *
     * @ORM\Column(name="codigo_firpa", type="string", length=45, nullable=true)
     */
    private $codigoFirpa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio_missao", type="date", nullable=true)
     */
    private $inicioMissao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio_missao", type="time", nullable=true)
     */
    private $horaInicioMissao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="retorno_missao", type="date", nullable=true)
     */
    private $retornoMissao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_retorno_missao", type="time", nullable=true)
     */
    private $horaRetornoMissao;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="transporte_utilizado", type="string", length=100, nullable=false)
     */
    private $transporteUtilizado = '***';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_aeronave_utilizada", type="string", length=100, nullable=false)
     */
    private $tipoAeronaveUtilizada;

    /**
     * @var string
     *
     * @ORM\Column(name="hospedagem_gratuita", type="string", length=3, nullable=false)
     */
    private $hospedagemGratuita = 'NAO';

    /**
     * @var string
     *
     * @ORM\Column(name="alimentacao_pela_uniao", type="string", length=3, nullable=false)
     */
    private $alimentacaoPelaUniao = 'NAO';

    /**
     * @var string
     *
     * @ORM\Column(name="despesas_conta_propria", type="string", length=45, nullable=true)
     */
    private $despesasContaPropria;

    /**
     * @var string
     *
     * @ORM\Column(name="conta_uniao", type="string", length=45, nullable=true)
     */
    private $contaUniao;

    /**
     * @var string
     *
     * @ORM\Column(name="pernoite_missao", type="string", length=45, nullable=true)
     */
    private $pernoiteMissao;

    /**
     * @var string
     *
     * @ORM\Column(name="acrescimento_deslocamento", type="string", length=45, nullable=true)
     */
    private $acrescimentoDeslocamento;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibilidade_financeira", type="string", length=45, nullable=true)
     */
    private $disponibilidadeFinanceira;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade_acrescimo", type="integer", nullable=true)
     */
    private $quantidadeAcrescimo;

    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="string", length=45, nullable=true)
     */
    private $observacoes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_cadastro", type="datetime", nullable=true)
     */
    private $dataCadastro;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade_diarias", type="integer", nullable=true)
     */
    private $quantidadeDiarias;

    /**
     * @var integer
     *
     * @ORM\Column(name="diarias_completas", type="integer", nullable=false)
     */
    private $diariasCompletas;

    /**
     * @var integer
     *
     * @ORM\Column(name="meia_diaria", type="integer", nullable=false)
     */
    private $meiaDiaria;

    /**
     * @var string
     *
     * @ORM\Column(name="total_diarias", type="string", length=45, nullable=true)
     */
    private $totalDiarias;

    /**
     * @var string
     *
     * @ORM\Column(name="auxilio_alimentacao", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $auxilioAlimentacao;

    /**
     * @var string
     *
     * @ORM\Column(name="auxilio_transporte", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $auxilioTransporte;

    /**
     * @var string
     *
     * @ORM\Column(name="custo_estimado", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $custoEstimado;

    /**
     * @var string
     *
     * @ORM\Column(name="custo_liquido", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $custoLiquido;

    /**
     * @var string
     *
     * @ORM\Column(name="modificacao_diarias", type="string", length=45, nullable=true)
     */
    private $modificacaoDiarias;

    /**
     * @var string
     *
     * @ORM\Column(name="justificativa_antecipacao", type="text", length=65535, nullable=true)
     */
    private $justificativaAntecipacao;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade_id", type="integer", length=45, nullable=true)
     */
    private $cidade;

    /**
     * @var \TbNaturezaMissao
     *
     * @ORM\ManyToOne(targetEntity="TbNaturezaMissao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="natureza_missao_id", referencedColumnName="id")
     * })
     */
    private $naturezaMissao;

    /**
     * @var \TbSetorDivisao
     *
     * @ORM\ManyToOne(targetEntity="TbSetorDivisao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="setor_id", referencedColumnName="id")
     * })
     */
    private $setorId;

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
     * @var \TbUsuario
     *
     * @ORM\ManyToOne(targetEntity="TbUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_usuario_id", referencedColumnName="id")
     * })
     */
    private $tbUsuario;
	
	/**
     * @var \TbUnidade
     *
     * @ORM\ManyToOne(targetEntity="TbUnidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="om_pagadora", referencedColumnName="id")
     * })
     */
    private $omPagadora;
	
	/**
     * @ORM\OneToMany(targetEntity="TbOrdemServicoAeroporto", mappedBy="ordemServico",cascade={"persist"})
     */
    private $aeroporto;
	
	
	/**
     * @ORM\OneToMany(targetEntity="TbOsControle", mappedBy="ordemServico",cascade={"persist"})
     */
    private $controle;
	
	
	/**
     * @ORM\OneToMany(targetEntity="RoteiroMissao", mappedBy="ordemServico",cascade={"persist"})
     */
    private $roteiro;



    /**
     * Constructor
     */
    public function __construct()
    {

        $this->aeroporto = new \Doctrine\Common\Collections\ArrayCollection();
		$this->controle = new \Doctrine\Common\Collections\ArrayCollection();
		$this->roteiro = new \Doctrine\Common\Collections\ArrayCollection();


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
     * Set statusOs
     *
     * @param string $statusOs
     *
     * @return TbOrdemServico
     */
    public function setStatusOs($statusOs)
    {
        $this->statusOs = $statusOs;

        return $this;
    }

    /**
     * Get statusOs
     *
     * @return string
     */
    public function getStatusOs()
    {
        return $this->statusOs;
    }

    /**
     * Set numeroOrdemServico
     *
     * @param string $numeroOrdemServico
     *
     * @return TbOrdemServico
     */
    public function setNumeroOrdemServico($numeroOrdemServico)
    {
        $this->numeroOrdemServico = $numeroOrdemServico;

        return $this;
    }

    /**
     * Get numeroOrdemServico
     *
     * @return string
     */
    public function getNumeroOrdemServico()
    {
        return $this->numeroOrdemServico;
    }

    /**
     * Set inicioMissao
     *
     * @param \DateTime $inicioMissao
     *
     * @return TbOrdemServico
     */
    public function setInicioMissao($inicioMissao)
    {
        $this->inicioMissao = $inicioMissao;

        return $this;
    }

    /**
     * Get inicioMissao
     *
     * @return \DateTime
     */
    public function getInicioMissao()
    {
        return $this->inicioMissao;
    }

    /**
     * Set horaInicioMissao
     *
     * @param \DateTime $horaInicioMissao
     *
     * @return TbOrdemServico
     */
    public function setHoraInicioMissao($horaInicioMissao)
    {
        $this->horaInicioMissao = $horaInicioMissao;

        return $this;
    }

    /**
     * Get horaInicioMissao
     *
     * @return \DateTime
     */
    public function getHoraInicioMissao()
    {
        return $this->horaInicioMissao;
    }

    /**
     * Set retornoMissao
     *
     * @param \DateTime $retornoMissao
     *
     * @return TbOrdemServico
     */
    public function setRetornoMissao($retornoMissao)
    {
        $this->retornoMissao = $retornoMissao;

        return $this;
    }

    /**
     * Get retornoMissao
     *
     * @return \DateTime
     */
    public function getRetornoMissao()
    {
        return $this->retornoMissao;
    }

    /**
     * Set horaRetornoMissao
     *
     * @param \DateTime $horaRetornoMissao
     *
     * @return TbOrdemServico
     */
    public function setHoraRetornoMissao($horaRetornoMissao)
    {
        $this->horaRetornoMissao = $horaRetornoMissao;

        return $this;
    }

    /**
     * Get horaRetornoMissao
     *
     * @return \DateTime
     */
    public function getHoraRetornoMissao()
    {
        return $this->horaRetornoMissao;
    }

    /**
     * Set tipoAeronaveUtilizada
     *
     * @param string $tipoAeronaveUtilizada
     *
     * @return TbOrdemServico
     */
    public function setTipoAeronaveUtilizada($tipoAeronaveUtilizada)
    {
        $this->tipoAeronaveUtilizada = $tipoAeronaveUtilizada;

        return $this;
    }

    /**
     * Get tipoAeronaveUtilizada
     *
     * @return string
     */
    public function getTipoAeronaveUtilizada()
    {
        return $this->tipoAeronaveUtilizada;
    }

    /**
     * Set hospedagemGratuita
     *
     * @param string $hospedagemGratuita
     *
     * @return TbOrdemServico
     */
    public function setHospedagemGratuita($hospedagemGratuita)
    {
        $this->hospedagemGratuita = $hospedagemGratuita;

        return $this;
    }

    /**
     * Get hospedagemGratuita
     *
     * @return string
     */
    public function getHospedagemGratuita()
    {
        return $this->hospedagemGratuita;
    }

    /**
     * Set alimentacaoPelaUniao
     *
     * @param string $alimentacaoPelaUniao
     *
     * @return TbOrdemServico
     */
    public function setAlimentacaoPelaUniao($alimentacaoPelaUniao)
    {
        $this->alimentacaoPelaUniao = $alimentacaoPelaUniao;

        return $this;
    }

    /**
     * Get alimentacaoPelaUniao
     *
     * @return string
     */
    public function getAlimentacaoPelaUniao()
    {
        return $this->alimentacaoPelaUniao;
    }

    /**
     * Set despesasContaPropria
     *
     * @param string $despesasContaPropria
     *
     * @return TbOrdemServico
     */
    public function setDespesasContaPropria($despesasContaPropria)
    {
        $this->despesasContaPropria = $despesasContaPropria;

        return $this;
    }

    /**
     * Get despesasContaPropria
     *
     * @return string
     */
    public function getDespesasContaPropria()
    {
        return $this->despesasContaPropria;
    }

    /**
     * Set contaUniao
     *
     * @param string $contaUniao
     *
     * @return TbOrdemServico
     */
    public function setContaUniao($contaUniao)
    {
        $this->contaUniao = $contaUniao;

        return $this;
    }

    /**
     * Get contaUniao
     *
     * @return string
     */
    public function getContaUniao()
    {
        return $this->contaUniao;
    }

    /**
     * Set pernoiteMissao
     *
     * @param string $pernoiteMissao
     *
     * @return TbOrdemServico
     */
    public function setPernoiteMissao($pernoiteMissao)
    {
        $this->pernoiteMissao = $pernoiteMissao;

        return $this;
    }

    /**
     * Get pernoiteMissao
     *
     * @return string
     */
    public function getPernoiteMissao()
    {
        return $this->pernoiteMissao;
    }

    /**
     * Set acrescimentoDeslocamento
     *
     * @param string $acrescimentoDeslocamento
     *
     * @return TbOrdemServico
     */
    public function setAcrescimentoDeslocamento($acrescimentoDeslocamento)
    {
        $this->acrescimentoDeslocamento = $acrescimentoDeslocamento;

        return $this;
    }

    /**
     * Get acrescimentoDeslocamento
     *
     * @return string
     */
    public function getAcrescimentoDeslocamento()
    {
        return $this->acrescimentoDeslocamento;
    }

    /**
     * Set disponibilidadeFinanceira
     *
     * @param string $disponibilidadeFinanceira
     *
     * @return TbOrdemServico
     */
    public function setDisponibilidadeFinanceira($disponibilidadeFinanceira)
    {
        $this->disponibilidadeFinanceira = $disponibilidadeFinanceira;

        return $this;
    }

    /**
     * Get disponibilidadeFinanceira
     *
     * @return string
     */
    public function getDisponibilidadeFinanceira()
    {
        return $this->disponibilidadeFinanceira;
    }

    /**
     * Set quantidadeAcrescimo
     *
     * @param integer $quantidadeAcrescimo
     *
     * @return TbOrdemServico
     */
    public function setQuantidadeAcrescimo($quantidadeAcrescimo)
    {
        $this->quantidadeAcrescimo = $quantidadeAcrescimo;

        return $this;
    }

    /**
     * Get quantidadeAcrescimo
     *
     * @return integer
     */
    public function getQuantidadeAcrescimo()
    {
        return $this->quantidadeAcrescimo;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     *
     * @return TbOrdemServico
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
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     *
     * @return TbOrdemServico
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set quantidadeDiarias
     *
     * @param integer $quantidadeDiarias
     *
     * @return TbOrdemServico
     */
    public function setQuantidadeDiarias($quantidadeDiarias)
    {
        $this->quantidadeDiarias = $quantidadeDiarias;

        return $this;
    }

    /**
     * Get quantidadeDiarias
     *
     * @return integer
     */
    public function getQuantidadeDiarias()
    {
        return $this->quantidadeDiarias;
    }

    /**
     * Set diariasCompletas
     *
     * @param integer $diariasCompletas
     *
     * @return TbOrdemServico
     */
    public function setDiariasCompletas($diariasCompletas)
    {
        $this->diariasCompletas = $diariasCompletas;

        return $this;
    }

    /**
     * Get diariasCompletas
     *
     * @return integer
     */
    public function getDiariasCompletas()
    {
        return $this->diariasCompletas;
    }

    /**
     * Set meiaDiaria
     *
     * @param integer $meiaDiaria
     *
     * @return TbOrdemServico
     */
    public function setMeiaDiaria($meiaDiaria)
    {
        $this->meiaDiaria = $meiaDiaria;

        return $this;
    }

    /**
     * Get meiaDiaria
     *
     * @return integer
     */
    public function getMeiaDiaria()
    {
        return $this->meiaDiaria;
    }
	
	 /**
     * Set meiaDiaria
     *
     * @param integer $meiaDiaria
     *
     * @return TbOrdemServico
     */
    public function setStatusPassagem($statusPassagem)
    {
        $this->statusPassagem = $statusPassagem;

        return $this;
    }

    /**
     * Get meiaDiaria
     *
     * @return integer
     */
    public function getStatusPassagem()
    {
        return $this->statusPassagem;
    }

    /**
     * Set totalDiarias
     *
     * @param string $totalDiarias
     *
     * @return TbOrdemServico
     */
    public function setTotalDiarias($totalDiarias)
    {
        $this->totalDiarias = $totalDiarias;

        return $this;
    }

    /**
     * Get totalDiarias
     *
     * @return string
     */
    public function getTotalDiarias()
    {
        return $this->totalDiarias;
    }

    /**
     * Set auxilioAlimentacao
     *
     * @param string $auxilioAlimentacao
     *
     * @return TbOrdemServico
     */
    public function setAuxilioAlimentacao($auxilioAlimentacao)
    {
        $this->auxilioAlimentacao = $auxilioAlimentacao;

        return $this;
    }

    /**
     * Get auxilioAlimentacao
     *
     * @return string
     */
    public function getAuxilioAlimentacao()
    {
        return $this->auxilioAlimentacao;
    }

    /**
     * Set auxilioTransporte
     *
     * @param string $auxilioTransporte
     *
     * @return TbOrdemServico
     */
    public function setAuxilioTransporte($auxilioTransporte)
    {
        $this->auxilioTransporte = $auxilioTransporte;

        return $this;
    }

    /**
     * Get auxilioTransporte
     *
     * @return string
     */
    public function getAuxilioTransporte()
    {
        return $this->auxilioTransporte;
    }

    /**
     * Set custoEstimado
     *
     * @param string $custoEstimado
     *
     * @return TbOrdemServico
     */
    public function setCustoEstimado($custoEstimado)
    {
        $this->custoEstimado = $custoEstimado;

        return $this;
    }

    /**
     * Get custoEstimado
     *
     * @return string
     */
    public function getCustoEstimado()
    {
        return $this->custoEstimado;
    }

    /**
     * Set custoLiquido
     *
     * @param string $custoLiquido
     *
     * @return TbOrdemServico
     */
    public function setCustoLiquido($custoLiquido)
    {
        $this->custoLiquido = $custoLiquido;

        return $this;
    }

    /**
     * Get custoLiquido
     *
     * @return string
     */
    public function getCustoLiquido()
    {
        return $this->custoLiquido;
    }

    /**
     * Set modificacaoDiarias
     *
     * @param string $modificacaoDiarias
     *
     * @return TbOrdemServico
     */
    public function setModificacaoDiarias($modificacaoDiarias)
    {
        $this->modificacaoDiarias = $modificacaoDiarias;

        return $this;
    }

    /**
     * Get modificacaoDiarias
     *
     * @return string
     */
    public function getModificacaoDiarias()
    {
        return $this->modificacaoDiarias;
    }

    /**
     * Set justificativaAntecipacao
     *
     * @param string $justificativaAntecipacao
     *
     * @return TbOrdemServico
     */
    public function setJustificativaAntecipacao($justificativaAntecipacao)
    {
        $this->justificativaAntecipacao = $justificativaAntecipacao;

        return $this;
    }

    /**
     * Get justificativaAntecipacao
     *
     * @return string
     */
    public function getJustificativaAntecipacao()
    {
        return $this->justificativaAntecipacao;
    }

    /**
     * Set cidade
     *
     * @param \AppBundle\Entity\GeografiaCidade $cidade
     *
     * @return TbOrdemServico
     */
    public function setCidade(\AppBundle\Entity\GeografiaCidade $cidade = null)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get cidade
     *
     * @return \AppBundle\Entity\GeografiaCidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set naturezaMissao
     *
     * @param \AppBundle\Entity\TbNaturezaMissao $naturezaMissao
     *
     * @return TbOrdemServico
     */
    public function setNaturezaMissao(\AppBundle\Entity\TbNaturezaMissao $naturezaMissao = null)
    {
        $this->naturezaMissao = $naturezaMissao;

        return $this;
    }

    /**
     * Get naturezaMissao
     *
     * @return \AppBundle\Entity\TbNaturezaMissao
     */
    public function getNaturezaMissao()
    {
        return $this->naturezaMissao;
    }

    /**
     * Set setor
     *
     * @param \AppBundle\Entity\TbSetorDivisao $setor
     *
     * @return TbOrdemServico
     */
    public function setSetorId(\AppBundle\Entity\TbSetorDivisao $setor = null)
    {
        $this->setor = $setorId;

        return $this;
    }
	
	
	/**
     * Add aeroporto
     *
     * @param \AppBundle\Entity\TbOrdemServicoAeroporto $aeroporto
     *
     * @return TbOrdemServico
     */
    public function addAeroporto(\AppBundle\Entity\TbOrdemServicoAeroporto $aeroporto)
    {
        $this->aeroporto[] = $aeroporto;

        return $this;
    }

    /**
     * Remove aeroporto
     *
     * @param \AppBundle\Entity\TbOrdemServicoAeroporto $aeroporto
     */
    public function removeAeroporto(\AppBundle\Entity\TbOrdemServicoAeroporto $aeroporto)
    {
        $this->aeroporto->removeElement($aeroporto);
    }

    /**
     * Get aeroporto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAeroporto()
    {
        return $this->aeroporto;
    }

    /**
     * Get setor
     *
     * @return \AppBundle\Entity\TbSetorDivisao
     */
    public function getSetorId()
    {
        return $this->setorId;
    }

    /**
     * Set tbTaxonomiaNaturezaDespesa
     *
     * @param \AppBundle\Entity\TbTaxonomiaNaturezaDespesa $tbTaxonomiaNaturezaDespesa
     *
     * @return TbOrdemServico
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
     * Set tbUsuario
     *
     * @param \AppBundle\Entity\TbUsuario $tbUsuario
     *
     * @return TbOrdemServico
     */
    public function setTbUsuario(\AppBundle\Entity\TbUsuario $tbUsuario = null)
    {
        $this->tbUsuario = $tbUsuario;

        return $this;
    }

    /**
     * Get tbUsuario
     *
     * @return \AppBundle\Entity\TbUsuario
     */
    public function getTbUsuario()
    {
        return $this->tbUsuario;
    }
	
	
	/**
     * Set tbUnidade
     *
     * @param \AppBundle\Entity\TbUnidade $omPagadora
     *
     * @return TbUnidade
     */
    public function setOmPagadora(\AppBundle\Entity\TbUnidade $omPagadora = null)
    {
        $this->omPagadora = $omPagadora;

        return $this;
    }

    /**
     * Get tbUsuario
     *
     * @return \AppBundle\Entity\TbUsuario
     */
    public function getOmPagadora()
    {
        return $this->omPagadora;
    }
	
	public function __toString(){
		return $this->numeroOrdemServico.'/'.$this->getNaturezaMissao();
	}

    /**
     * Add controle
     *
     * @param \AppBundle\Entity\TbOsControle $controle
     *
     * @return TbOrdemServico
     */
    public function addControle(\AppBundle\Entity\TbOsControle $controle)
    {
        $this->controle[] = $controle;

        return $this;
    }

    /**
     * Remove controle
     *
     * @param \AppBundle\Entity\TbOsControle $controle
     */
    public function removeControle(\AppBundle\Entity\TbOsControle $controle)
    {
        $this->controle->removeElement($controle);
    }

    /**
     * Get controle
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getControle()
    {
        return $this->controle;
    }

    /**
     * Set codigoFirpa
     *
     * @param string $codigoFirpa
     *
     * @return TbOrdemServico
     */
    public function setCodigoFirpa($codigoFirpa)
    {
        $this->codigoFirpa = $codigoFirpa;

        return $this;
    }

    /**
     * Get codigoFirpa
     *
     * @return string
     */
    public function getCodigoFirpa()
    {
        return $this->codigoFirpa;
    }

    /**
     * Set transporteUtilizado
     *
     * @param string $transporteUtilizado
     *
     * @return TbOrdemServico
     */
    public function setTransporteUtilizado($transporteUtilizado)
    {
        $this->transporteUtilizado = $transporteUtilizado;

        return $this;
    }

    /**
     * Get transporteUtilizado
     *
     * @return string
     */
    public function getTransporteUtilizado()
    {
        return $this->transporteUtilizado;
    }

    /**
     * Add roteiro
     *
     * @param \AppBundle\Entity\RoteiroMissao $roteiro
     *
     * @return TbOrdemServico
     */
    public function addRoteiro(\AppBundle\Entity\RoteiroMissao $roteiro)
    {
        $this->roteiro[] = $roteiro;

        return $this;
    }

    /**
     * Remove roteiro
     *
     * @param \AppBundle\Entity\RoteiroMissao $roteiro
     */
    public function removeRoteiro(\AppBundle\Entity\RoteiroMissao $roteiro)
    {
        $this->roteiro->removeElement($roteiro);
    }

    /**
     * Get roteiro
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoteiro()
    {
        return $this->roteiro;
    }
}
