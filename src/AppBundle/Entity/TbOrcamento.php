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
     * @ORM\Column(name="diarias", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $diarias;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="custo_diarias", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $custoDiarias;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo_diarias", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $saldoDiarias;

	/**
     * @var string
     *
     * @ORM\Column(name="diaria_descentralizada", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $diariaDescentralizada;

    /**
     * @var string
     *
     * @ORM\Column(name="passagem", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $passagem;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="custo_passagem", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $custoPassagem;
	
	/**
     * @var string
     *
     * @ORM\Column(name="passagem_descentralizada", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $passagemDescentralizada;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo_passagens", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $saldoPassagem;


    /**
     * @var string
     *
     * @ORM\Column(name="total_custeio", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $totalCusteio;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo_custeio", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $saldoCusteio;
	
	/**
     * @var string
     *
     * @ORM\Column(name="custo_custeio", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $custoCusteio;


	/**
     * @var string
     *
     * @ORM\Column(name="custeio_descentralizado", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $custeioDescentralizado;
	
	
    /**
     * @var string
     *
     * @ORM\Column(name="total_investimento", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $totalInvestimento;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="custo_investimento", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $custoInvestimento;


    /**
     * @var string
     *
     * @ORM\Column(name="saldo_investimento", type="decimal", precision=19, scale=2, nullable=true)
     */
    private $saldoInvestimento;

	/**
     * @var string
     *
     * @ORM\Column(name="investimento_descentralizado", type="decimal", precision=19, scale=4, nullable=true)
     */
    private $investimentoDescentralizado;
    
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

    /**
     * Set diarias
     *
     * @param string $diarias
     *
     * @return TbOrcamento
     */
    public function setDiarias($diarias)
    {
        $this->diarias = $diarias;

        return $this;
    }

    /**
     * Get diarias
     *
     * @return string
     */
    public function getDiarias()
    {
        return $this->diarias;
    }

    /**
     * Set passagem
     *
     * @param string $passagem
     *
     * @return TbOrcamento
     */
    public function setPassagem($passagem)
    {
        $this->passagem = $passagem;

        return $this;
    }

    /**
     * Get passagem
     *
     * @return string
     */
    public function getPassagem()
    {
        return $this->passagem;
    }

	
    /**
     * Set saldoDiarias
     *
     * @param string $saldoDiarias
     *
     * @return TbOrcamento
     */
    public function setSaldoDiarias($saldoDiarias)
    {
        $this->saldoDiarias = $saldoDiarias;

        return $this;
    }

    /**
     * Get saldoDiarias
     *
     * @return string
     */
    public function getSaldoDiarias()
    {
        return $this->saldoDiarias;
    }

    /**
     * Set saldoPassagem
     *
     * @param string $saldoPassagem
     *
     * @return TbOrcamento
     */
    public function setSaldoPassagem($saldoPassagem)
    {
        $this->saldoPassagem = $saldoPassagem;

        return $this;
    }

    /**
     * Get saldoPassagem
     *
     * @return string
     */
    public function getSaldoPassagem()
    {
        return $this->saldoPassagem;
    }

    /**
     * Set saldoCusteio
     *
     * @param string $saldoCusteio
     *
     * @return TbOrcamento
     */
    public function setSaldoCusteio($saldoCusteio)
    {
        $this->saldoCusteio = $saldoCusteio;

        return $this;
    }

    /**
     * Get saldoCusteio
     *
     * @return string
     */
    public function getSaldoCusteio()
    {
        return $this->saldoCusteio;
    }

    /**
     * Set saldoInvestimento
     *
     * @param string $saldoInvestimento
     *
     * @return TbOrcamento
     */
    public function setSaldoInvestimento($saldoInvestimento)
    {
        $this->saldoInvestimento = $saldoInvestimento;

        return $this;
    }

    /**
     * Get saldoInvestimento
     *
     * @return string
     */
    public function getSaldoInvestimento()
    {
        return $this->saldoInvestimento;
    }

    /**
     * Set custoDiarias
     *
     * @param string $custoDiarias
     *
     * @return TbOrcamento
     */
    public function setCustoDiarias($custoDiarias)
    {
        $this->custoDiarias = $custoDiarias;

        return $this;
    }

    /**
     * Get custoDiarias
     *
     * @return string
     */
    public function getCustoDiarias()
    {
        return $this->custoDiarias;
    }

    /**
     * Set diariaDescentralizada
     *
     * @param string $diariaDescentralizada
     *
     * @return TbOrcamento
     */
    public function setDiariaDescentralizada($diariaDescentralizada)
    {
        $this->diariaDescentralizada = $diariaDescentralizada;

        return $this;
    }

    /**
     * Get diariaDescentralizada
     *
     * @return string
     */
    public function getDiariaDescentralizada()
    {
        return $this->diariaDescentralizada;
    }

    /**
     * Set custoPassagem
     *
     * @param string $custoPassagem
     *
     * @return TbOrcamento
     */
    public function setCustoPassagem($custoPassagem)
    {
        $this->custoPassagem = $custoPassagem;

        return $this;
    }

    /**
     * Get custoPassagem
     *
     * @return string
     */
    public function getCustoPassagem()
    {
        return $this->custoPassagem;
    }

    /**
     * Set passagemDescentralizada
     *
     * @param string $passagemDescentralizada
     *
     * @return TbOrcamento
     */
    public function setPassagemDescentralizada($passagemDescentralizada)
    {
        $this->passagemDescentralizada = $passagemDescentralizada;

        return $this;
    }

    /**
     * Get passagemDescentralizada
     *
     * @return string
     */
    public function getPassagemDescentralizada()
    {
        return $this->passagemDescentralizada;
    }

    /**
     * Set custoCusteio
     *
     * @param string $custoCusteio
     *
     * @return TbOrcamento
     */
    public function setCustoCusteio($custoCusteio)
    {
        $this->custoCusteio = $custoCusteio;

        return $this;
    }

    /**
     * Get custoCusteio
     *
     * @return string
     */
    public function getCustoCusteio()
    {
        return $this->custoCusteio;
    }

    /**
     * Set custeioDescentralizado
     *
     * @param string $custeioDescentralizado
     *
     * @return TbOrcamento
     */
    public function setCusteioDescentralizado($custeioDescentralizado)
    {
        $this->custeioDescentralizado = $custeioDescentralizado;

        return $this;
    }

    /**
     * Get custeioDescentralizado
     *
     * @return string
     */
    public function getCusteioDescentralizado()
    {
        return $this->custeioDescentralizado;
    }

    /**
     * Set custoInvestimento
     *
     * @param string $custoInvestimento
     *
     * @return TbOrcamento
     */
    public function setCustoInvestimento($custoInvestimento)
    {
        $this->custoInvestimento = $custoInvestimento;

        return $this;
    }

    /**
     * Get custoInvestimento
     *
     * @return string
     */
    public function getCustoInvestimento()
    {
        return $this->custoInvestimento;
    }

    /**
     * Set investimentoDescentralizado
     *
     * @param string $investimentoDescentralizado
     *
     * @return TbOrcamento
     */
    public function setInvestimentoDescentralizado($investimentoDescentralizado)
    {
        $this->investimentoDescentralizado = $investimentoDescentralizado;

        return $this;
    }

    /**
     * Get investimentoDescentralizado
     *
     * @return string
     */
    public function getInvestimentoDescentralizado()
    {
        return $this->investimentoDescentralizado;
    }
}
