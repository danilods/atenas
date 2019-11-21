<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbDiariasControle
 *
 * @ORM\Table(name="tb_diarias_controle", indexes={@ORM\Index(name="fk_tb_diarias_controle_tb_usuario1_idx", columns={"tb_usuario_id"}), @ORM\Index(name="fk_tb_diarias_controle_tb_ordem_servico1_idx", columns={"tb_ordem_servico_id"})})
 * @ORM\Entity
 */
class TbDiariasControle
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
     * @var decimal
     *
     * @ORM\Column(name="quantidade", type="decimal", nullable=true)
     */
    private $quantidade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=true)
     */
    private $data;

    /**
     * @var \TbOrdemServico
     *
     * @ORM\ManyToOne(targetEntity="TbOrdemServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_ordem_servico_id", referencedColumnName="id")
     * })
     */
    private $tbOrdemServico;

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
     * @var string
     *
     * @ORM\Column(name="ano", type="string", length=10, nullable=true)
     */
    private $exercicio;



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
     * Set quantidade
     *
     * @param integer $quantidade
     *
     * @return TbDiariasControle
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade
     *
     * @return integer
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return TbDiariasControle
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set tbOrdemServico
     *
     * @param \AppBundle\Entity\TbOrdemServico $tbOrdemServico
     *
     * @return TbDiariasControle
     */
    public function setTbOrdemServico(\AppBundle\Entity\TbOrdemServico $tbOrdemServico = null)
    {
        $this->tbOrdemServico = $tbOrdemServico;

        return $this;
    }

    /**
     * Get tbOrdemServico
     *
     * @return \AppBundle\Entity\TbOrdemServico
     */
    public function getTbOrdemServico()
    {
        return $this->tbOrdemServico;
    }

    /**
     * Set tbUsuario
     *
     * @param \AppBundle\Entity\TbUsuario $tbUsuario
     *
     * @return TbDiariasControle
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

    /**
     * Set exercicio
     *
     * @param string $exercicio
     *
     * @return TbCalculoDespesaOs
     */
    public function setExercicio($exercicio)
    {
        $this->exercicio = $exercicio;

        return $this;
    }

    /**
     * Get exercicio
     *
     * @return string
     */
    public function getExercicio()
    {
        return $this->exercicio;
    }
}
