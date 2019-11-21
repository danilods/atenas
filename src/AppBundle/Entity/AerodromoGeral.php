<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AerodromoGeral
 *
 * @ORM\Table(name="aerodromo_geral", indexes={@ORM\Index(name="fk_aerodromo_geral_geografia_cidade1_idx", columns={"cidade_id"})})
 * @ORM\Entity
 */
class AerodromoGeral
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
     * @ORM\Column(name="icao", type="string", length=45, nullable=true)
     */
    private $icao;

    /**
     * @var string
     *
     * @ORM\Column(name="iata", type="string", length=45, nullable=true)
     */
    private $iata;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="propriedade", type="string", length=45, nullable=true)
     */
    private $propriedade;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=45, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=45, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=45, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude_decimal", type="string", length=45, nullable=true)
     */
    private $latitudeDecimal;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude_decimal", type="string", length=45, nullable=true)
     */
    private $longitudeDecimal;

    /**
     * @var float
     *
     * @ORM\Column(name="altitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $altitude;

    /**
     * @var string
     *
     * @ORM\Column(name="vfr_diurno", type="string", length=45, nullable=true)
     */
    private $vfrDiurno;

    /**
     * @var string
     *
     * @ORM\Column(name="vfr_noturno", type="string", length=45, nullable=true)
     */
    private $vfrNoturno;

    /**
     * @var string
     *
     * @ORM\Column(name="ifr_diurno", type="string", length=45, nullable=true)
     */
    private $ifrDiurno;

    /**
     * @var string
     *
     * @ORM\Column(name="ifr_noturno", type="string", length=45, nullable=true)
     */
    private $ifrNoturno;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set icao
     *
     * @param string $icao
     *
     * @return AerodromoGeral
     */
    public function setIcao($icao)
    {
        $this->icao = $icao;

        return $this;
    }

    /**
     * Get icao
     *
     * @return string
     */
    public function getIcao()
    {
        return $this->icao;
    }

    /**
     * Set iata
     *
     * @param string $iata
     *
     * @return AerodromoGeral
     */
    public function setIata($iata)
    {
        $this->iata = $iata;

        return $this;
    }

    /**
     * Get iata
     *
     * @return string
     */
    public function getIata()
    {
        return $this->iata;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return AerodromoGeral
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set propriedade
     *
     * @param string $propriedade
     *
     * @return AerodromoGeral
     */
    public function setPropriedade($propriedade)
    {
        $this->propriedade = $propriedade;

        return $this;
    }

    /**
     * Get propriedade
     *
     * @return string
     */
    public function getPropriedade()
    {
        return $this->propriedade;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return AerodromoGeral
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return AerodromoGeral
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return AerodromoGeral
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitudeDecimal
     *
     * @param string $latitudeDecimal
     *
     * @return AerodromoGeral
     */
    public function setLatitudeDecimal($latitudeDecimal)
    {
        $this->latitudeDecimal = $latitudeDecimal;

        return $this;
    }

    /**
     * Get latitudeDecimal
     *
     * @return string
     */
    public function getLatitudeDecimal()
    {
        return $this->latitudeDecimal;
    }

    /**
     * Set longitudeDecimal
     *
     * @param string $longitudeDecimal
     *
     * @return AerodromoGeral
     */
    public function setLongitudeDecimal($longitudeDecimal)
    {
        $this->longitudeDecimal = $longitudeDecimal;

        return $this;
    }

    /**
     * Get longitudeDecimal
     *
     * @return string
     */
    public function getLongitudeDecimal()
    {
        return $this->longitudeDecimal;
    }

    /**
     * Set altitude
     *
     * @param float $altitude
     *
     * @return AerodromoGeral
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;

        return $this;
    }

    /**
     * Get altitude
     *
     * @return float
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * Set vfrDiurno
     *
     * @param string $vfrDiurno
     *
     * @return AerodromoGeral
     */
    public function setVfrDiurno($vfrDiurno)
    {
        $this->vfrDiurno = $vfrDiurno;

        return $this;
    }

    /**
     * Get vfrDiurno
     *
     * @return string
     */
    public function getVfrDiurno()
    {
        return $this->vfrDiurno;
    }

    /**
     * Set vfrNoturno
     *
     * @param string $vfrNoturno
     *
     * @return AerodromoGeral
     */
    public function setVfrNoturno($vfrNoturno)
    {
        $this->vfrNoturno = $vfrNoturno;

        return $this;
    }

    /**
     * Get vfrNoturno
     *
     * @return string
     */
    public function getVfrNoturno()
    {
        return $this->vfrNoturno;
    }

    /**
     * Set ifrDiurno
     *
     * @param string $ifrDiurno
     *
     * @return AerodromoGeral
     */
    public function setIfrDiurno($ifrDiurno)
    {
        $this->ifrDiurno = $ifrDiurno;

        return $this;
    }

    /**
     * Get ifrDiurno
     *
     * @return string
     */
    public function getIfrDiurno()
    {
        return $this->ifrDiurno;
    }

    /**
     * Set ifrNoturno
     *
     * @param string $ifrNoturno
     *
     * @return AerodromoGeral
     */
    public function setIfrNoturno($ifrNoturno)
    {
        $this->ifrNoturno = $ifrNoturno;

        return $this;
    }

    /**
     * Get ifrNoturno
     *
     * @return string
     */
    public function getIfrNoturno()
    {
        return $this->ifrNoturno;
    }

    /**
     * Set cidade
     *
     * @param \AppBundle\Entity\GeografiaCidade $cidade
     *
     * @return AerodromoGeral
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

    public function __toString()
    {
        return $this->iata.' - '.$this->getCidade();
    }
}
