<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * RoteiroExterior
 *
 * @ORM\Table(name="roteiro_exterior", indexes={@ORM\Index(name="fk_roteiro_missao_geografia_pais1_idx", columns={"pais_missao"}), @ORM\Index(name="fk_roteiro_missao_tb_ordem_servico1_idx", columns={"ordem_servico_id"})})
 * @ORM\Entity
 */
class RoteiroExterior
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
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio", type="date", nullable=true)
     */
    private $dataInicio;


    /**
     * @var string
     *
     * @ORM\Column(name="data_inicio_txt", type="string", length=45, nullable=true)
     */
    private $dateInicioTxt;

    /**
     * @var string
     *
     * @ORM\Column(name="data_fim_txt", type="string", length=45, nullable=true)
     */
    private $dataFimTxt;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_termino", type="date", nullable=true)
     */
    private $dateTermino;
	
	/**
     * @var string
     *
     * @ORM\Column(name="hora_inicio", type="string", length=45, nullable=true)
     */
    private $horaInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="hora_final", type="string", length=45, nullable=true)
     */
    private $horaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=255, nullable=true)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="detalhe_cidade", type="string", length=255, nullable=true)
     */
    private $detalheCidade;

   
     /**
     * @var string
     *
     * @ORM\Column(name="dias_transito_ida", type="integer",  nullable=true)
     */
    private $diasTransitoIda;

     /**
     * @var integer
     *
     * @ORM\Column(name="dias_transito_volta", type="integer",  nullable=true)
     */
    private $diasTransitoVolta;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade_dias", type="integer",  nullable=true)
     */
    private $quantidadeDias;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_diaria", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $valorDiaria;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="valor_diaria_dolar", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $valorDiariaDolar;

    /**
     * @var string
     *
     * @ORM\Column(name="cotacao_dolar", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $cotacaoDolar;

   

    /**
     * @var string
     *
     * @ORM\Column(name="estabelecimento", type="string", length=255, nullable=true)
     */
    private $estabelecimento;


    /**
     * @var \GeografiaPais
     *
     * @ORM\ManyToOne(targetEntity="GeografiaPais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_missao", referencedColumnName="id")
     * })
     */
    private $paisMissao;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dataInicio
     *
     * @param \DateTime $dataInicio
     *
     * @return RoteiroExterior
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Get dataInicio
     *
     * @return \DateTime
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set dateInicioTxt
     *
     * @param string $dateInicioTxt
     *
     * @return RoteiroExterior
     */
    public function setDateInicioTxt($dateInicioTxt)
    {
        $this->dateInicioTxt = $dateInicioTxt;

        return $this;
    }

    /**
     * Get dateInicioTxt
     *
     * @return string
     */
    public function getDateInicioTxt()
    {
        return $this->dateInicioTxt;
    }

    /**
     * Set dataFimTxt
     *
     * @param string $dataFimTxt
     *
     * @return RoteiroExterior
     */
    public function setDataFimTxt($dataFimTxt)
    {
        $this->dataFimTxt = $dataFimTxt;

        return $this;
    }

    /**
     * Get dataFimTxt
     *
     * @return string
     */
    public function getDataFimTxt()
    {
        return $this->dataFimTxt;
    }

    /**
     * Set dateTermino
     *
     * @param \DateTime $dateTermino
     *
     * @return RoteiroExterior
     */
    public function setDateTermino($dateTermino)
    {
        $this->dateTermino = $dateTermino;

        return $this;
    }

    /**
     * Get dateTermino
     *
     * @return \DateTime
     */
    public function getDateTermino()
    {
        return $this->dateTermino;
    }

    /**
     * Set horaInicio
     *
     * @param string $horaInicio
     *
     * @return RoteiroExterior
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return string
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFinal
     *
     * @param string $horaFinal
     *
     * @return RoteiroExterior
     */
    public function setHoraFinal($horaFinal)
    {
        $this->horaFinal = $horaFinal;

        return $this;
    }

    /**
     * Get horaFinal
     *
     * @return string
     */
    public function getHoraFinal()
    {
        return $this->horaFinal;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     *
     * @return RoteiroExterior
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set detalheCidade
     *
     * @param string $detalheCidade
     *
     * @return RoteiroExterior
     */
    public function setDetalheCidade($detalheCidade)
    {
        $this->detalheCidade = $detalheCidade;

        return $this;
    }

    /**
     * Get detalheCidade
     *
     * @return string
     */
    public function getDetalheCidade()
    {
        return $this->detalheCidade;
    }

    /**
     * Set valorDiaria
     *
     * @param string $valorDiaria
     *
     * @return RoteiroExterior
     */
    public function setValorDiaria($valorDiaria)
    {
        $this->valorDiaria = $valorDiaria;

        return $this;
    }

    /**
     * Get valorDiaria
     *
     * @return string
     */
    public function getValorDiaria()
    {
        return $this->valorDiaria;
    }

    /**
     * Set estabelecimento
     *
     * @param string $estabelecimento
     *
     * @return RoteiroExterior
     */
    public function setEstabelecimento($estabelecimento)
    {
        $this->estabelecimento = $estabelecimento;

        return $this;
    }

    /**
     * Get estabelecimento
     *
     * @return string
     */
    public function getEstabelecimento()
    {
        return $this->estabelecimento;
    }

    /**
     * Set paisMissao
     *
     * @param \AppBundle\Entity\GeografiaPais $paisMissao
     *
     * @return RoteiroExterior
     */
    public function setPaisMissao(\AppBundle\Entity\GeografiaPais $paisMissao = null)
    {
        $this->paisMissao = $paisMissao;

        return $this;
    }

    /**
     * Get paisMissao
     *
     * @return \AppBundle\Entity\GeografiaPais
     */
    public function getPaisMissao()
    {
        return $this->paisMissao;
    }

    /**
     * Set ordemServico
     *
     * @param \AppBundle\Entity\TbOrdemServico $ordemServico
     *
     * @return RoteiroExterior
     */
    public function setOrdemServico(\AppBundle\Entity\TbOrdemServico $ordemServico = null)
    {
        $this->ordemServico = $ordemServico;

        return $this;
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

    /**
     * Set diasTransitoIda
     *
     * @param integer $diasTransitoIda
     *
     * @return RoteiroExterior
     */
    public function setDiasTransitoIda($diasTransitoIda)
    {
        $this->diasTransitoIda = $diasTransitoIda;

        return $this;
    }

    /**
     * Get diasTransitoIda
     *
     * @return integer
     */
    public function getDiasTransitoIda()
    {
        return $this->diasTransitoIda;
    }

    /**
     * Set diasTransitoVolta
     *
     * @param integer $diasTransitoVolta
     *
     * @return RoteiroExterior
     */
    public function setDiasTransitoVolta($diasTransitoVolta)
    {
        $this->diasTransitoVolta = $diasTransitoVolta;

        return $this;
    }

    /**
     * Get diasTransitoVolta
     *
     * @return integer
     */
    public function getDiasTransitoVolta()
    {
        return $this->diasTransitoVolta;
    }

    /**
     * Set quantidadeDias
     *
     * @param integer $quantidadeDias
     *
     * @return RoteiroExterior
     */
    public function setQuantidadeDias($quantidadeDias)
    {
        $this->quantidadeDias = $quantidadeDias;

        return $this;
    }

    /**
     * Get quantidadeDias
     *
     * @return integer
     */
    public function getQuantidadeDias()
    {
        return $this->quantidadeDias;
    }

    /**
     * Set cotacaoDolar
     *
     * @param string $cotacaoDolar
     *
     * @return RoteiroExterior
     */
    public function setCotacaoDolar($cotacaoDolar)
    {
        $this->cotacaoDolar = $cotacaoDolar;

        return $this;
    }

    /**
     * Get cotacaoDolar
     *
     * @return string
     */
    public function getCotacaoDolar()
    {
        return $this->cotacaoDolar;
    }
	
	
	 public function getSaida(){

        $inicio = date( 'd/m/Y' , strtotime( $this->dateInicioTxt ) );

        $fim = date( 'd/m/Y' , strtotime( $this->dataFimTxt ) );


		echo "<i class=\"fa fa-map-marker\" aria-hidden=\"true\"></i> ".$this->detalheCidade.' - '.$this->getPaisMissao().'<br>'.
			"<i class=\"fa fa-map-marker\" aria-hidden=\"true\"></i> ".$this->estabelecimento.'<br><i class="fa fa-calendar" aria-hidden="true"></i>  '.$inicio.' a '.$fim.'<br>
		
		';

       
    }

    /**
     * Set valorDiariaDolar
     *
     * @param string $valorDiariaDolar
     *
     * @return RoteiroExterior
     */
    public function setValorDiariaDolar($valorDiariaDolar)
    {
        $this->valorDiariaDolar = $valorDiariaDolar;

        return $this;
    }

    /**
     * Get valorDiariaDolar
     *
     * @return string
     */
    public function getValorDiariaDolar()
    {
        return $this->valorDiariaDolar;
    }
}
