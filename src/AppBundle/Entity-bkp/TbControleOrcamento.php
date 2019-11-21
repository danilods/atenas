<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbControleOrcamento
 *
 * @ORM\Table(name="tb_controle_orcamento", indexes={@ORM\Index(name="fk_tb_controle_orcamento_tb_orcamento1_idx", columns={"tb_orcamento_id"})})
 * @ORM\Entity
 */
class TbControleOrcamento
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
     * @ORM\Column(name="tipo_operacao", type="string", length=255, nullable=true)
     */
    private $tipoOperacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_registro", type="datetime", nullable=true)
     */
    private $dataRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo", type="string", length=255, nullable=true)
     */
    private $anexo;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valor;

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
     * @return TbControleOrcamento
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
     * Set dataRegistro
     *
     * @param \DateTime $dataRegistro
     *
     * @return TbControleOrcamento
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
     * Set anexo
     *
     * @param string $anexo
     *
     * @return TbControleOrcamento
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;

        return $this;
    }

    /**
     * Get anexo
     *
     * @return string
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return TbControleOrcamento
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set tbOrcamento
     *
     * @param \AppBundle\Entity\TbOrcamento $tbOrcamento
     *
     * @return TbControleOrcamento
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
}
