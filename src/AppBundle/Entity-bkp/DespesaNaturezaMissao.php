<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DespesaNaturezaMissao
 *
 * @ORM\Table(name="despesa_natureza_missao", indexes={@ORM\Index(name="fk_despesa_natureza_missao_tb_natureza_despesa1_idx", columns={"natureza_despesa_id"}), @ORM\Index(name="fk_despesa_natureza_missao_tb_natureza_missao1_idx", columns={"tb_natureza_missao_id"})})
 * @ORM\Entity
 */
class DespesaNaturezaMissao
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
     * @ORM\Column(name="valor_gasto_por_despesa", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $valorGastoPorDespesa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_operacao", type="datetime", nullable=true)
     */
    private $dataOperacao;

    /**
     * @var \TbNaturezaDespesa
     *
     * @ORM\ManyToOne(targetEntity="TbNaturezaDespesa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="natureza_despesa_id", referencedColumnName="id")
     * })
     */
    private $naturezaDespesa;

    /**
     * @var \TbNaturezaMissao
     *
     * @ORM\ManyToOne(targetEntity="TbNaturezaMissao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_natureza_missao_id", referencedColumnName="id")
     * })
     */
    private $tbNaturezaMissao;



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
     * Set valorGastoPorDespesa
     *
     * @param string $valorGastoPorDespesa
     *
     * @return DespesaNaturezaMissao
     */
    public function setValorGastoPorDespesa($valorGastoPorDespesa)
    {
        $this->valorGastoPorDespesa = $valorGastoPorDespesa;

        return $this;
    }

    /**
     * Get valorGastoPorDespesa
     *
     * @return string
     */
    public function getValorGastoPorDespesa()
    {
        return $this->valorGastoPorDespesa;
    }

    /**
     * Set dataOperacao
     *
     * @param \DateTime $dataOperacao
     *
     * @return DespesaNaturezaMissao
     */
    public function setDataOperacao($dataOperacao)
    {
        $this->dataOperacao = $dataOperacao;

        return $this;
    }

    /**
     * Get dataOperacao
     *
     * @return \DateTime
     */
    public function getDataOperacao()
    {
        return $this->dataOperacao;
    }

    /**
     * Set naturezaDespesa
     *
     * @param \AppBundle\Entity\TbNaturezaDespesa $naturezaDespesa
     *
     * @return DespesaNaturezaMissao
     */
    public function setNaturezaDespesa(\AppBundle\Entity\TbNaturezaDespesa $naturezaDespesa = null)
    {
        $this->naturezaDespesa = $naturezaDespesa;

        return $this;
    }

    /**
     * Get naturezaDespesa
     *
     * @return \AppBundle\Entity\TbNaturezaDespesa
     */
    public function getNaturezaDespesa()
    {
        return $this->naturezaDespesa;
    }

    /**
     * Set tbNaturezaMissao
     *
     * @param \AppBundle\Entity\TbNaturezaMissao $tbNaturezaMissao
     *
     * @return DespesaNaturezaMissao
     */
    public function setTbNaturezaMissao(\AppBundle\Entity\TbNaturezaMissao $tbNaturezaMissao = null)
    {
        $this->tbNaturezaMissao = $tbNaturezaMissao;

        return $this;
    }

    /**
     * Get tbNaturezaMissao
     *
     * @return \AppBundle\Entity\TbNaturezaMissao
     */
    public function getTbNaturezaMissao()
    {
        return $this->tbNaturezaMissao;
    }
}
