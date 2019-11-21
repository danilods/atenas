<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbOrdemServico
 *
 * @ORM\Table(name="tb_ordem_servico", indexes={@ORM\Index(name="fk_tb_ordem_servico_geografia_cidade1_idx", columns={"cidade_id"}), @ORM\Index(name="fk_tb_ordem_servico_natureza_missao1_idx", columns={"natureza_missao_id"})})
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
     * @ORM\Column(name="numero_ordem_servico", type="string", length=45, nullable=true)
     */
    private $numeroOrdemServico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio_missao", type="date", nullable=true)
     */
    private $inicioMissao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="retorno_missao", type="date", nullable=true)
     */
    private $retornoMissao;

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
     * @var string
     *
     * @ORM\Column(name="total_diarias", type="string", length=45, nullable=true)
     */
    private $totalDiarias;

    /**
     * @var string
     *
     * @ORM\Column(name="custo_estimado", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $custoEstimado;

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
     * @var \GeografiaCidade
     *
     * @ORM\ManyToOne(targetEntity="GeografiaCidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cidade_id", referencedColumnName="id")
     * })
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="TbNaturezaDespesa", mappedBy="tbOrdemServico")
     */
    private $naturezaDespesa;
	
	 /**
     * @ORM\ManyToMany(targetEntity="TbUsuario", inversedBy="tbOrdemServico")
     * @ORM\JoinTable(name="tb_usuario_ordem_servico")
     */
	 private $tbUsuario;
	 
	 
	/**
     * @ORM\OneToMany(targetEntity="TbOrdemServicoAeroporto", mappedBy="ordemServicoAeroportos")
     */
	 private $aeroporto;
	
	

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->naturezaDespesa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tbUsuario = new \Doctrine\Common\Collections\ArrayCollection();
		$this->aeroporto = new \Doctrine\Common\Collections\ArrayCollection();
    
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
     * Add naturezaDespesa
     *
     * @param \AppBundle\Entity\TbNaturezaDespesa $naturezaDespesa
     *
     * @return TbOrdemServico
     */
    public function addNaturezaDespesa(\AppBundle\Entity\TbNaturezaDespesa $naturezaDespesa)
    {
        $this->naturezaDespesa[] = $naturezaDespesa;

        return $this;
    }

    /**
     * Remove naturezaDespesa
     *
     * @param \AppBundle\Entity\TbNaturezaDespesa $naturezaDespesa
     */
    public function removeNaturezaDespesa(\AppBundle\Entity\TbNaturezaDespesa $naturezaDespesa)
    {
        $this->naturezaDespesa->removeElement($naturezaDespesa);
    }
	
	

    /**
     * Get naturezaDespesa
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNaturezaDespesa()
    {
        return $this->naturezaDespesa;
    }

    /**
     * Add tbUsuario
     *
     * @param \AppBundle\Entity\TbUsuario $tbUsuario
     *
     * @return TbOrdemServico
     */
    public function addTbUsuario(\AppBundle\Entity\TbUsuario $tbUsuario)
    {
        $this->tbUsuario[] = $tbUsuario;

        return $this;
    }

    /**
     * Remove tbUsuario
     *
     * @param \AppBundle\Entity\TbUsuario $tbUsuario
     */
    public function removeTbUsuario(\AppBundle\Entity\TbUsuario $tbUsuario)
    {
        $this->tbUsuario->removeElement($tbUsuario);
    }

    /**
     * Get tbUsuario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTbUsuario()
    {
        return $this->tbUsuario;
    }
}
