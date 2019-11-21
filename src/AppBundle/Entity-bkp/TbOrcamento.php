<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbOrcamento
 *
 * @ORM\Table(name="tb_orcamento", indexes={@ORM\Index(name="fk_tb_orcamento_tb_unidade1_idx", columns={"tb_unidade_id"})})
 * @ORM\Entity
 */
class TbOrcamento
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
     * @ORM\Column(name="total_custeio", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $totalCusteio;

    /**
     * @var string
     *
     * @ORM\Column(name="total_investimento", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $totalInvestimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="exercicio", type="string", nullable=false)
     */
    private $exercicio;

    /**
     * @var \TbUnidade
     *
     * @ORM\ManyToOne(targetEntity="TbUnidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_unidade_id", referencedColumnName="id")
     * })
     */
    private $tbUnidade;



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
     * Set totalCusteio
     *
     * @param string $totalCusteio
     *
     * @return TbOrcamento
     */
    public function setTotalCusteio($totalCusteio)
    {
        $this->totalCusteio = $totalCusteio;

        return $this;
    }

    /**
     * Get totalCusteio
     *
     * @return string
     */
    public function getTotalCusteio()
    {
        return $this->totalCusteio;
    }

    /**
     * Set totalInvestimento
     *
     * @param string $totalInvestimento
     *
     * @return TbOrcamento
     */
    public function setTotalInvestimento($totalInvestimento)
    {
        $this->totalInvestimento = $totalInvestimento;

        return $this;
    }

    /**
     * Get totalInvestimento
     *
     * @return string
     */
    public function getTotalInvestimento()
    {
        return $this->totalInvestimento;
    }

    /**
     * Set exercicio
     *
     * @param \DateTime $exercicio
     *
     * @return TbOrcamento
     */
    public function setExercicio($exercicio)
    {
        $this->exercicio = $exercicio;

        return $this;
    }

    /**
     * Get exercicio
     *
     * @return \DateTime
     */
    public function getExercicio()
    {
        return $this->exercicio;
    }

    /**
     * Set tbUnidade
     *
     * @param \AppBundle\Entity\TbUnidade $tbUnidade
     *
     * @return TbOrcamento
     */
    public function setTbUnidade(\AppBundle\Entity\TbUnidade $tbUnidade = null)
    {
        $this->tbUnidade = $tbUnidade;

        return $this;
    }

    /**
     * Get tbUnidade
     *
     * @return \AppBundle\Entity\TbUnidade
     */
    public function getTbUnidade()
    {
        return $this->tbUnidade;
    }
	
	public function __toString(){
		
		return $this->getTbUnidade().' - '.$this->exercicio;
	}
}
