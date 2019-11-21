<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbProcesso
 *
 * @ORM\Table(name="tb_processo", indexes={@ORM\Index(name="fk_tb_rims_tb_efetivo1_idx", columns={"requisitante_id"}), @ORM\Index(name="fk_tb_rims_tb_efetivo2_idx", columns={"responsavel_id"}), @ORM\Index(name="fk_tb_processo_tb_destinatario_processo1_idx", columns={"destinatario_processo_id"})})
 * @ORM\Entity
 */
class TbProcesso
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
     * @ORM\Column(name="numero_requisicao", type="string", length=45, nullable=true)
     */
    private $numeroRequisicao;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_processo", type="string", length=45, nullable=true)
     */
    private $numeroProcesso;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="string", length=45, nullable=true)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="justificativa_requisicao", type="string", length=45, nullable=true)
     */
    private $justificativaRequisicao;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficio_direto", type="string", length=45, nullable=true)
     */
    private $beneficioDireto;

    /**
     * @var string
     *
     * @ORM\Column(name="beneficio_indireto", type="string", length=45, nullable=true)
     */
    private $beneficioIndireto;

    /**
     * @var string
     *
     * @ORM\Column(name="conexao_planejamento", type="string", length=45, nullable=true)
     */
    private $conexaoPlanejamento;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo_contratacao", type="string", length=45, nullable=true)
     */
    private $objetivoContratacao;

    /**
     * @var string
     *
     * @ORM\Column(name="prazo_execucao", type="string", length=45, nullable=true)
     */
    private $prazoExecucao;

    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="text", length=65535, nullable=true)
     */
    private $observacoes;

    /**
     * @var string
     *
     * @ORM\Column(name="obrigacoes_contrata", type="text", length=65535, nullable=true)
     */
    private $obrigacoesContrata;

    /**
     * @var string
     *
     * @ORM\Column(name="staus_processo", type="string", length=45, nullable=true)
     */
    private $stausProcesso;

    /**
     * @var \TbDestinatarioProcesso
     *
     * @ORM\ManyToOne(targetEntity="TbDestinatarioProcesso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destinatario_processo_id", referencedColumnName="id")
     * })
     */
    private $destinatarioProcesso;

    /**
     * @var \TbUsuario
     *
     * @ORM\ManyToOne(targetEntity="TbUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="requisitante_id", referencedColumnName="id")
     * })
     */
    private $requisitante;

    /**
     * @var \TbUsuario
     *
     * @ORM\ManyToOne(targetEntity="TbUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="responsavel_id", referencedColumnName="id")
     * })
     */
    private $responsavel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="TbNaturezaDespesa", mappedBy="processo")
     */
    private $naturezaDespesa;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->naturezaDespesa = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numeroRequisicao
     *
     * @param string $numeroRequisicao
     *
     * @return TbProcesso
     */
    public function setNumeroRequisicao($numeroRequisicao)
    {
        $this->numeroRequisicao = $numeroRequisicao;

        return $this;
    }

    /**
     * Get numeroRequisicao
     *
     * @return string
     */
    public function getNumeroRequisicao()
    {
        return $this->numeroRequisicao;
    }

    /**
     * Set numeroProcesso
     *
     * @param string $numeroProcesso
     *
     * @return TbProcesso
     */
    public function setNumeroProcesso($numeroProcesso)
    {
        $this->numeroProcesso = $numeroProcesso;

        return $this;
    }

    /**
     * Get numeroProcesso
     *
     * @return string
     */
    public function getNumeroProcesso()
    {
        return $this->numeroProcesso;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return TbProcesso
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set justificativaRequisicao
     *
     * @param string $justificativaRequisicao
     *
     * @return TbProcesso
     */
    public function setJustificativaRequisicao($justificativaRequisicao)
    {
        $this->justificativaRequisicao = $justificativaRequisicao;

        return $this;
    }

    /**
     * Get justificativaRequisicao
     *
     * @return string
     */
    public function getJustificativaRequisicao()
    {
        return $this->justificativaRequisicao;
    }

    /**
     * Set beneficioDireto
     *
     * @param string $beneficioDireto
     *
     * @return TbProcesso
     */
    public function setBeneficioDireto($beneficioDireto)
    {
        $this->beneficioDireto = $beneficioDireto;

        return $this;
    }

    /**
     * Get beneficioDireto
     *
     * @return string
     */
    public function getBeneficioDireto()
    {
        return $this->beneficioDireto;
    }

    /**
     * Set beneficioIndireto
     *
     * @param string $beneficioIndireto
     *
     * @return TbProcesso
     */
    public function setBeneficioIndireto($beneficioIndireto)
    {
        $this->beneficioIndireto = $beneficioIndireto;

        return $this;
    }

    /**
     * Get beneficioIndireto
     *
     * @return string
     */
    public function getBeneficioIndireto()
    {
        return $this->beneficioIndireto;
    }

    /**
     * Set conexaoPlanejamento
     *
     * @param string $conexaoPlanejamento
     *
     * @return TbProcesso
     */
    public function setConexaoPlanejamento($conexaoPlanejamento)
    {
        $this->conexaoPlanejamento = $conexaoPlanejamento;

        return $this;
    }

    /**
     * Get conexaoPlanejamento
     *
     * @return string
     */
    public function getConexaoPlanejamento()
    {
        return $this->conexaoPlanejamento;
    }

    /**
     * Set objetivoContratacao
     *
     * @param string $objetivoContratacao
     *
     * @return TbProcesso
     */
    public function setObjetivoContratacao($objetivoContratacao)
    {
        $this->objetivoContratacao = $objetivoContratacao;

        return $this;
    }

    /**
     * Get objetivoContratacao
     *
     * @return string
     */
    public function getObjetivoContratacao()
    {
        return $this->objetivoContratacao;
    }

    /**
     * Set prazoExecucao
     *
     * @param string $prazoExecucao
     *
     * @return TbProcesso
     */
    public function setPrazoExecucao($prazoExecucao)
    {
        $this->prazoExecucao = $prazoExecucao;

        return $this;
    }

    /**
     * Get prazoExecucao
     *
     * @return string
     */
    public function getPrazoExecucao()
    {
        return $this->prazoExecucao;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     *
     * @return TbProcesso
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
     * Set obrigacoesContrata
     *
     * @param string $obrigacoesContrata
     *
     * @return TbProcesso
     */
    public function setObrigacoesContrata($obrigacoesContrata)
    {
        $this->obrigacoesContrata = $obrigacoesContrata;

        return $this;
    }

    /**
     * Get obrigacoesContrata
     *
     * @return string
     */
    public function getObrigacoesContrata()
    {
        return $this->obrigacoesContrata;
    }

    /**
     * Set stausProcesso
     *
     * @param string $stausProcesso
     *
     * @return TbProcesso
     */
    public function setStausProcesso($stausProcesso)
    {
        $this->stausProcesso = $stausProcesso;

        return $this;
    }

    /**
     * Get stausProcesso
     *
     * @return string
     */
    public function getStausProcesso()
    {
        return $this->stausProcesso;
    }

    /**
     * Set destinatarioProcesso
     *
     * @param \AppBundle\Entity\TbDestinatarioProcesso $destinatarioProcesso
     *
     * @return TbProcesso
     */
    public function setDestinatarioProcesso(\AppBundle\Entity\TbDestinatarioProcesso $destinatarioProcesso = null)
    {
        $this->destinatarioProcesso = $destinatarioProcesso;

        return $this;
    }

    /**
     * Get destinatarioProcesso
     *
     * @return \AppBundle\Entity\TbDestinatarioProcesso
     */
    public function getDestinatarioProcesso()
    {
        return $this->destinatarioProcesso;
    }

    /**
     * Set requisitante
     *
     * @param \AppBundle\Entity\TbUsuario $requisitante
     *
     * @return TbProcesso
     */
    public function setRequisitante(\AppBundle\Entity\TbUsuario $requisitante = null)
    {
        $this->requisitante = $requisitante;

        return $this;
    }

    /**
     * Get requisitante
     *
     * @return \AppBundle\Entity\TbUsuario
     */
    public function getRequisitante()
    {
        return $this->requisitante;
    }

    /**
     * Set responsavel
     *
     * @param \AppBundle\Entity\TbUsuario $responsavel
     *
     * @return TbProcesso
     */
    public function setResponsavel(\AppBundle\Entity\TbUsuario $responsavel = null)
    {
        $this->responsavel = $responsavel;

        return $this;
    }

    /**
     * Get responsavel
     *
     * @return \AppBundle\Entity\TbUsuario
     */
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * Add naturezaDespesa
     *
     * @param \AppBundle\Entity\TbNaturezaDespesa $naturezaDespesa
     *
     * @return TbProcesso
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
}
