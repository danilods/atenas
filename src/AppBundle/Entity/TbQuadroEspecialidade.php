<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbQuadroEspecialidade
 *
 * @ORM\Table(name="tb_quadro_especialidade")
 * @ORM\Entity
 */
class TbQuadroEspecialidade
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
     * @ORM\Column(name="nome_quadro", type="string", length=255, nullable=false)
     */
    private $nomeQuadro;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla_quadro", type="string", length=20, nullable=false)
     */
    private $siglaQuadro;



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
     * Set nomeQuadro
     *
     * @param string $nomeQuadro
     *
     * @return TbQuadroEspecialidade
     */
    public function setNomeQuadro($nomeQuadro)
    {
        $this->nomeQuadro = $nomeQuadro;

        return $this;
    }

    /**
     * Get nomeQuadro
     *
     * @return string
     */
    public function getNomeQuadro()
    {
        return $this->nomeQuadro;
    }

    /**
     * Set siglaQuadro
     *
     * @param string $siglaQuadro
     *
     * @return TbQuadroEspecialidade
     */
    public function setSiglaQuadro($siglaQuadro)
    {
        $this->siglaQuadro = $siglaQuadro;

        return $this;
    }

    /**
     * Get siglaQuadro
     *
     * @return string
     */
    public function getSiglaQuadro()
    {
        return $this->siglaQuadro;
    }
	
	 public function __toString()
    {
        return $this->siglaQuadro.'';
    }
}
