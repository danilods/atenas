<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbCirculoHierarquico
 *
 * @ORM\Table(name="tb_circulo_hierarquico")
 * @ORM\Entity
 */
class TbCirculoHierarquico
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
     * @ORM\Column(name="nome_circulo_hierarquico", type="string", length=45, nullable=true)
     */
    private $nomeCirculoHierarquico;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=255, nullable=false)
     */
    private $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="diaria_normal", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $diariaNormal;

    /**
     * @var string
     *
     * @ORM\Column(name="meia_diaria", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $meiaDiaria;

    /**
     * @var string
     *
     * @ORM\Column(name="noventa", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $noventa;

    /**
     * @var string
     *
     * @ORM\Column(name="oitenta", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $oitenta;

    /**
     * @var string
     *
     * @ORM\Column(name="setenta", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $setenta;

    /**
     * @var string
     *
     * @ORM\Column(name="cinquenta", type="decimal", precision=7, scale=2, nullable=true)
     */
    private $cinquenta;



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
     * Set nomeCirculoHierarquico
     *
     * @param string $nomeCirculoHierarquico
     *
     * @return TbCirculoHierarquico
     */
    public function setNomeCirculoHierarquico($nomeCirculoHierarquico)
    {
        $this->nomeCirculoHierarquico = $nomeCirculoHierarquico;

        return $this;
    }

    /**
     * Get nomeCirculoHierarquico
     *
     * @return string
     */
    public function getNomeCirculoHierarquico()
    {
        return $this->nomeCirculoHierarquico;
    }

    /**
     * Set sigla
     *
     * @param string $sigla
     *
     * @return TbCirculoHierarquico
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set diariaNormal
     *
     * @param string $diariaNormal
     *
     * @return TbCirculoHierarquico
     */
    public function setDiariaNormal($diariaNormal)
    {
        $this->diariaNormal = $diariaNormal;

        return $this;
    }

    /**
     * Get diariaNormal
     *
     * @return string
     */
    public function getDiariaNormal()
    {
        return $this->diariaNormal;
    }

    /**
     * Set meiaDiaria
     *
     * @param string $meiaDiaria
     *
     * @return TbCirculoHierarquico
     */
    public function setMeiaDiaria($meiaDiaria)
    {
        $this->meiaDiaria = $meiaDiaria;

        return $this;
    }

    /**
     * Get meiaDiaria
     *
     * @return string
     */
    public function getMeiaDiaria()
    {
        return $this->meiaDiaria;
    }

    /**
     * Set noventa
     *
     * @param string $noventa
     *
     * @return TbCirculoHierarquico
     */
    public function setNoventa($noventa)
    {
        $this->noventa = $noventa;

        return $this;
    }

    /**
     * Get noventa
     *
     * @return string
     */
    public function getNoventa()
    {
        return $this->noventa;
    }

    /**
     * Set oitenta
     *
     * @param string $oitenta
     *
     * @return TbCirculoHierarquico
     */
    public function setOitenta($oitenta)
    {
        $this->oitenta = $oitenta;

        return $this;
    }

    /**
     * Get oitenta
     *
     * @return string
     */
    public function getOitenta()
    {
        return $this->oitenta;
    }

    /**
     * Set setenta
     *
     * @param string $setenta
     *
     * @return TbCirculoHierarquico
     */
    public function setSetenta($setenta)
    {
        $this->setenta = $setenta;

        return $this;
    }

    /**
     * Get setenta
     *
     * @return string
     */
    public function getSetenta()
    {
        return $this->setenta;
    }

    /**
     * Set cinquenta
     *
     * @param string $cinquenta
     *
     * @return TbCirculoHierarquico
     */
    public function setCinquenta($cinquenta)
    {
        $this->cinquenta = $cinquenta;

        return $this;
    }

    /**
     * Get cinquenta
     *
     * @return string
     */
    public function getCinquenta()
    {
        return $this->cinquenta;
    }

    public function __toString()
    {
        return $this->getNomeCirculoHierarquico().'';
    }

}

