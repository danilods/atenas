<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbDiariasControle
 *
 * @ORM\Table(name="tb_controle_numeracao_os")
 * @ORM\Entity
 */
class ControleNumeracaoOs
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
     * @ORM\Column(name="numero", type="string", nullable=true)
     */
    private $numero;
	
	/**
     * @var string
     *
     * @ORM\Column(name="ano", type="string", nullable=true)
     */
    private $ano;

    /**
     * @var integer
     *
     * @ORM\Column(name="unidade", type="integer", nullable=true)
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
     * Set numero
     *
     * @param string $numero
     *
     * @return ControleNumeracaoOs
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set ano
     *
     * @param string $ano
     *
     * @return ControleNumeracaoOs
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get ano
     *
     * @return string
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Set unidade
     *
     * @param integer $unidade
     *
     * @return ControleNumeracaoOs
     */
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;

        return $this;
    }

    /**
     * Get unidade
     *
     * @return integer
     */
    public function getUnidade()
    {
        return $this->unidade;
    }
}
