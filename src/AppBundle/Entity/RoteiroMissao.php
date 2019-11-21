<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * RoteiroMissao
 *
 * @ORM\Table(name="roteiro_missao", indexes={@ORM\Index(name="fk_roteiro_missao_geografia_cidade1_idx", columns={"geografia_cidade_id"}), @ORM\Index(name="fk_roteiro_missao_tb_ordem_servico1_idx", columns={"ordem_servico_id"})})
 * @ORM\Entity
 */
class RoteiroMissao
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
     * @var boolean
     *
     * @ORM\Column(name="adicional_deslocamento", type="boolean", nullable=true)
     */
    private $adicionalDeslocamento;

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
     * @ORM\Column(name="transporte_utilizado", type="string", length=100, nullable=false)
     */
    private $transporteUtilizado;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_diaria", type="decimal", precision=6, scale=2, nullable=false)
     */
    private $valorDiaria = '0.00';
	
	
    /**
     * @var decimal
     *
     * @ORM\Column(name="quantidade_diarias", type="string",  nullable=true)
     */
    private $quantidadeDiarias = '0.0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="pernoite", type="boolean", nullable=false)
     */
    private $pernoite;

    /**
     * @var \GeografiaCidade
     *
     * @ORM\ManyToOne(targetEntity="GeografiaCidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="geografia_cidade_id", referencedColumnName="id")
     * })
     */
    private $geografiaCidade;

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
     * @return RoteiroMissao
     */
    public function setDataInicio( $dataInicio)
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
     * Set dataInicio
     *
     * @param string $dataInicio
     *
     * @return RoteiroMissao
     */
    public function setDataInicioTxt($dataInicioTxt)
    {
        $this->dateInicioTxt = $dataInicioTxt;

        return $this;
    }

    /**
     * Get dataInicio
     *
     * @return string
     */
    public function getDataInicioTxt()
    {
        return $this->dateInicioTxt;
    }


    /**
     * Set dataFim
     *
     * @param string $dataFim
     *
     * @return RoteiroMissao
     */
    public function setDataFimTxt($dataFim)
    {
        $this->dataFimTxt = $dataFim;

        return $this;
    }

    /**
     * Get dataInicio
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
     * @return RoteiroMissao
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
     * Set adicionalDeslocamento
     *
     * @param boolean $adicionalDeslocamento
     *
     * @return RoteiroMissao
     */
    public function setAdicionalDeslocamento($adicionalDeslocamento)
    {
        $this->adicionalDeslocamento = $adicionalDeslocamento;

        return $this;
    }

    /**
     * Get adicionalDeslocamento
     *
     * @return boolean
     */
    public function getAdicionalDeslocamento()
    {
        return $this->adicionalDeslocamento;
    }

    /**
     * Set horaInicio
     *
     * @param string $horaInicio
     *
     * @return RoteiroMissao
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
     * @return RoteiroMissao
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
     * Set transporteUtilizado
     *
     * @param string $transporteUtilizado
     *
     * @return RoteiroMissao
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
     * Set valorDiaria
     *
     * @param string $valorDiaria
     *
     * @return RoteiroMissao
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
     * Set quantidadeDiarias
     *
     * @param string $quantidadeDiarias
     *
     * @return RoteiroMissao
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
     * Set pernoite
     *
     * @param boolean $pernoite
     *
     * @return RoteiroMissao
     */
    public function setPernoite($pernoite)
    {
        $this->pernoite = $pernoite;

        return $this;
    }

    /**
     * Get pernoite
     *
     * @return boolean
     */
    public function getPernoite()
    {
        return $this->pernoite;
    }

    /**
     * Set geografiaCidade
     *
     * @param \AppBundle\Entity\GeografiaCidade $geografiaCidade
     *
     * @return RoteiroMissao
     */
    public function setGeografiaCidade(\AppBundle\Entity\GeografiaCidade $geografiaCidade = null)
    {
        $this->geografiaCidade = $geografiaCidade;

        return $this;
    }

    /**
     * Get geografiaCidade
     *
     * @return \AppBundle\Entity\GeografiaCidade
     */
    public function getGeografiaCidade()
    {
        return $this->geografiaCidade;
    }

    /**
     * Set ordemServico
     *
     * @param \AppBundle\Entity\TbOrdemServico $ordemServico
     *
     * @return RoteiroMissao
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

    public function getSaida(){

        $inicio = date( 'd/m/Y' , strtotime( $this->dataInicio ) );

        $fim = date( 'd/m/Y' , strtotime( $this->dateTermino ) );


		echo "<i class=\"fa fa-map-marker\" aria-hidden=\"true\"></i> ".$this->getGeografiaCidade().'<br><i class="fa fa-calendar" aria-hidden="true"></i>  '.$this->dataInicio->format("d/m/Y").' a '.$this->dateTermino->format("d/m/Y").'<br>';

       
    }
	
	

	
	
}
