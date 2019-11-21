<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbOsControle
 *
 * @ORM\Table(name="tb_os_controle", indexes={@ORM\Index(name="fk_tb_processo_tb_ordem_servico1_idx", columns={"tb_ordem_servico_id"}), @ORM\Index(name="fk_tb_os_controle_tb_usuario1_idx", columns={"registrado_por_id"})})
 * @ORM\Entity
 */
class TbOsControle
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
     * @ORM\Column(name="data_registro", type="datetime", nullable=true)
     */
    private $dataRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="status_ordem_servico", type="string", length=45, nullable=true)
     */
    private $statusOrdemServico;

    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="text", nullable=true)
     */
    private $observacoes;

    /**
     * @var string
     *
     * @ORM\Column(name="registrado_por", type="string", nullable=true)
     */
    private $registradoPor;

    /**
     * @var \TbOrdemServico
     *
     * @ORM\ManyToOne(targetEntity="TbOrdemServico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_ordem_servico_id", referencedColumnName="id")
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
     * Set dataRegistro
     *
     * @param \DateTime $dataRegistro
     *
     * @return TbOsControle
     */
    public function setDataRegistro($dataRegistro)
    {
        $this->dataRegistro = $dataRegistro;

        return $this;
    }

    /**
     * Get dataRegistro
     *
     * @return \DateTime
     */
    public function getDataRegistro()
    {
        return $this->dataRegistro;
    }

    /**
     * Set statusOrdemServico
     *
     * @param string $statusOrdemServico
     *
     * @return TbOsControle
     */
    public function setStatusOrdemServico($statusOrdemServico)
    {
        $this->statusOrdemServico = $statusOrdemServico;

        return $this;
    }

    /**
     * Get statusOrdemServico
     *
     * @return string
     */
    public function getStatusOrdemServico()
    {
        return $this->statusOrdemServico;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     *
     * @return TbOsControle
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Get observacoes
     *
     * @return string
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

   /**
     * Set observacoes
     *
     * @param string $registradoPor
     *
     * @return TbOsControle
     */
    public function setRegistradoPor($registradoPor)
    {
        $this->registradoPor = $registradoPor;

        return $this;
    }

    /**
     * Set observacoes
     *
     * @param string $registradoPor
     *
     * @return TbOsControle
     */
    public function getRegistradoPor()
    {
        return $this->registradoPor;
    }

    /**
     * Set tbOrdemServico
     *
     * @param \AppBundle\Entity\TbOrdemServico $tbOrdemServico
     *
     * @return TbOsControle
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
     * Set ordemServico
     *
     * @param \AppBundle\Entity\TbOrdemServico $ordemServico
     *
     * @return TbOsControle
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
}
