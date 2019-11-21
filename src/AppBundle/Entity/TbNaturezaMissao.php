<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbNaturezaMissao
 *
 * @ORM\Table(name="tb_natureza_missao")
 * @ORM\Entity
 */
class TbNaturezaMissao
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
     * @ORM\Column(name="nome_natureza_missao", type="string", length=45, nullable=true)
     */
    private $nomeNaturezaMissao;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao_natureza", type="string", length=45, nullable=true)
     */
    private $descricaoNatureza;



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
     * Set nomeNaturezaMissao
     *
     * @param string $nomeNaturezaMissao
     *
     * @return TbNaturezaMissao
     */
    public function setNomeNaturezaMissao($nomeNaturezaMissao)
    {
        $this->nomeNaturezaMissao = $nomeNaturezaMissao;

        return $this;
    }

    /**
     * Get nomeNaturezaMissao
     *
     * @return string
     */
    public function getNomeNaturezaMissao()
    {
        return $this->nomeNaturezaMissao;
    }

    /**
     * Set descricaoNatureza
     *
     * @param string $descricaoNatureza
     *
     * @return TbNaturezaMissao
     */
    public function setDescricaoNatureza($descricaoNatureza)
    {
        $this->descricaoNatureza = $descricaoNatureza;

        return $this;
    }

    /**
     * Get descricaoNatureza
     *
     * @return string
     */
    public function getDescricaoNatureza()
    {
        return $this->descricaoNatureza;
    }

    public function __toString()
    {
        return $this->nomeNaturezaMissao.'';
    }
}
