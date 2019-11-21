<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbRimsAcompanhamento
 *
 * @ORM\Table(name="tb_rims_acompanhamento", indexes={@ORM\Index(name="fk_tb_rims_acompanhamento_tb_usuario1_idx", columns={"tb_usuario_id"}), @ORM\Index(name="fk_tb_rims_acompanhamento_tb_processo1_idx", columns={"tb_processo_id"})})
 * @ORM\Entity
 */
class TbRimsAcompanhamento
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
     * @ORM\Column(name="data_", type="string", length=45, nullable=true)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=45, nullable=true)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_rims", type="string", length=45, nullable=true)
     */
    private $anexoRims;

    /**
     * @var \TbProcesso
     *
     * @ORM\ManyToOne(targetEntity="TbProcesso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_processo_id", referencedColumnName="id")
     * })
     */
    private $tbProcesso;

    /**
     * @var \TbUsuario
     *
     * @ORM\ManyToOne(targetEntity="TbUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_usuario_id", referencedColumnName="id")
     * })
     */
    private $tbUsuario;



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
     * Set data
     *
     * @param string $data
     *
     * @return TbRimsAcompanhamento
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return TbRimsAcompanhamento
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set anexoRims
     *
     * @param string $anexoRims
     *
     * @return TbRimsAcompanhamento
     */
    public function setAnexoRims($anexoRims)
    {
        $this->anexoRims = $anexoRims;

        return $this;
    }

    /**
     * Get anexoRims
     *
     * @return string
     */
    public function getAnexoRims()
    {
        return $this->anexoRims;
    }

    /**
     * Set tbProcesso
     *
     * @param \AppBundle\Entity\TbProcesso $tbProcesso
     *
     * @return TbRimsAcompanhamento
     */
    public function setTbProcesso(\AppBundle\Entity\TbProcesso $tbProcesso = null)
    {
        $this->tbProcesso = $tbProcesso;

        return $this;
    }

    /**
     * Get tbProcesso
     *
     * @return \AppBundle\Entity\TbProcesso
     */
    public function getTbProcesso()
    {
        return $this->tbProcesso;
    }

    /**
     * Set tbUsuario
     *
     * @param \AppBundle\Entity\TbUsuario $tbUsuario
     *
     * @return TbRimsAcompanhamento
     */
    public function setTbUsuario(\AppBundle\Entity\TbUsuario $tbUsuario = null)
    {
        $this->tbUsuario = $tbUsuario;

        return $this;
    }

    /**
     * Get tbUsuario
     *
     * @return \AppBundle\Entity\TbUsuario
     */
    public function getTbUsuario()
    {
        return $this->tbUsuario;
    }
}
