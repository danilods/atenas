<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbUnidade
 *
 * @ORM\Table(name="tb_unidade")
 * @ORM\Entity
 */
class TbUnidade
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
     * @ORM\Column(name="nome_unidade", type="string", length=45, nullable=true)
     */
    private $nomeUnidade;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=45, nullable=true)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=45, nullable=true)
     */
    private $telefone;


    /**
     * @var \TbUsuario
     *
     * @ORM\ManyToOne(targetEntity="TbUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chefe_id", referencedColumnName="id")
     * })
     */
    private $chefe;



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
     * Set nomeUnidade
     *
     * @param string $nomeUnidade
     *
     * @return TbUnidade
     */
    public function setNomeUnidade($nomeUnidade)
    {
        $this->nomeUnidade = $nomeUnidade;

        return $this;
    }

    /**
     * Get nomeUnidade
     *
     * @return string
     */
    public function getNomeUnidade()
    {
        return $this->nomeUnidade;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     *
     * @return TbUnidade
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
     * Set telefone
     *
     * @param string $telefone
     *
     * @return TbUnidade
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

     /**
     * Set tbUsuario
     *
     * @param \AppBundle\Entity\TbUsuario $tbUsuario
     *
     * @return TbUsuario
     */
    public function setChefe(\AppBundle\Entity\TbUsuario $tbUsuario = null)
    {
        $this->tbUsuario = $tbUsuario;

        return $this;
    }

    /**
     * Get TbUsuario
     *
     * @return \AppBundle\Entity\TbUsuario
     */
    public function getChefe()
    {
        return $this->chefe;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function __toString()
    {
        return $this->nomeUnidade.'';
    }
}
