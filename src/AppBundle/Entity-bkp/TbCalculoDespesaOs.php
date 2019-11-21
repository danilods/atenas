<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbCalculoDespesaOs
 *
 * @ORM\Table(name="tb_calculo_despesa_os", indexes={@ORM\Index(name="fk_tb_calculo_despesa_os_tb_natureza_despesa1_idx", columns={"tb_natureza_despesa_id"}), @ORM\Index(name="fk_tb_calculo_despesa_os_tb_ordem_servico1_idx", columns={"tb_ordem_servico_id"})})
 * @ORM\Entity
 */
class TbCalculoDespesaOs
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
     * @ORM\Column(name="natureza_despesa", type="string", length=100, nullable=true)
     */
    private $naturezaDespesa;

    /**
     * @var string
     *
     * @ORM\Column(name="total_depesa_missao", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $totalDepesaMissao;

    /**
     * @var string
     *
     * @ORM\Column(name="exercicio", type="string", length=10, nullable=true)
     */
    private $exercicio;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_natureza_despesa", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $valorNaturezaDespesa;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo_natureza", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $saldoNatureza;

    /**
     * @var integer
     *
     * @ORM\Column(name="natureza_missao", type="integer", nullable=true)
     */
    private $naturezaMissao;


  /**
     * @var string
     *
     * @ORM\Column(name="unidade", type="string", length=10, nullable=true)
     */
    private $unidade;


  


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
     * Set naturezaDespesa
     *
     * @param string $naturezaDespesa
     *
     * @return TbCalculoDespesaOs
     */
    public function setNaturezaDespesa($naturezaDespesa)
    {
        $this->naturezaDespesa = $naturezaDespesa;

        return $this;
    }

    /**
     * Get naturezaDespesa
     *
     * @return string
     */
    public function getNaturezaDespesa()
    {
        return $this->naturezaDespesa;
    }

    /**
     * Set totalDepesaMissao
     *
     * @param string $totalDepesaMissao
     *
     * @return TbCalculoDespesaOs
     */
    public function setTotalDepesaMissao($totalDepesaMissao)
    {
        $this->totalDepesaMissao = $totalDepesaMissao;

        return $this;
    }

    /**
     * Get totalDepesaMissao
     *
     * @return string
     */
    public function getTotalDepesaMissao()
    {
        return $this->totalDepesaMissao;
    }

    /**
     * Set exercicio
     *
     * @param string $exercicio
     *
     * @return TbCalculoDespesaOs
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
     * Set valorNaturezaDespesa
     *
     * @param string $valorNaturezaDespesa
     *
     * @return TbCalculoDespesaOs
     */
    public function setValorNaturezaDespesa($valorNaturezaDespesa)
    {
        $this->valorNaturezaDespesa = $valorNaturezaDespesa;

        return $this;
    }

    /**
     * Get valorNaturezaDespesa
     *
     * @return string
     */
    public function getValorNaturezaDespesa()
    {
        return $this->valorNaturezaDespesa;
    }

    /**
     * Set saldoNatureza
     *
     * @param string $saldoNatureza
     *
     * @return TbCalculoDespesaOs
     */
    public function setSaldoNatureza($saldoNatureza)
    {
        $this->saldoNatureza = $saldoNatureza;

        return $this;
    }

    /**
     * Get saldoNatureza
     *
     * @return string
     */
    public function getSaldoNatureza()
    {
        return $this->saldoNatureza;
    }

    /**
     * Set naturezaMissao
     *
     * @param integer $naturezaMissao
     *
     * @return TbCalculoDespesaOs
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
     * @param string $unidade
     *
     * @return TbCalculoDespesaOs
     */
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Get exercicio
     *
     * @return string
     */
    public function getUnidade()
    {
        return $this->unidade;
    }




    /**
     * Set tbNaturezaDespesa
     *
     * @param \AppBundle\Entity\TbNaturezaDespesa $tbNaturezaDespesa
     *
     * @return TbCalculoDespesaOs
     */
    public function setTbNaturezaDespesa(\AppBundle\Entity\TbNaturezaDespesa $tbNaturezaDespesa = null)
    {
        $this->tbNaturezaDespesa = $tbNaturezaDespesa;

        return $this;
    }

    /**
     * Get tbNaturezaDespesa
     *
     * @return \AppBundle\Entity\TbNaturezaDespesa
     */
    public function getTbNaturezaDespesa()
    {
        return $this->tbNaturezaDespesa;
    }

    /**
     * Set tbOrdemServico
     *
     * @param \AppBundle\Entity\TbOrdemServico $tbOrdemServico
     *
     * @return TbCalculoDespesaOs
     */
    public function setTbOrdemServico(\AppBundle\Entity\TbOrdemServico $tbOrdemServico = null)
    {
        $this->tbOrdemServico = $tbOrdemServico;

        return $this;
    }

    /**
     * Get tbOrdemServico
     *
     * @return \AppBundle\Entity\TbOrdemServico
     */
    public function getTbOrdemServico()
    {
        return $this->tbOrdemServico;
    }
}
