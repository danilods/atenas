<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbNaturezaDespesaRecursoProcesso
 *
 * @ORM\Table(name="tb_natureza_despesa_recurso_processo", indexes={@ORM\Index(name="fk_tb_natureza_despesa_has_tb_processo_tb_processo1_idx", columns={"processo_id"}), @ORM\Index(name="fk_tb_natureza_despesa_has_tb_processo_tb_natureza_despesa1_idx", columns={"natureza_despesa_id"})})
 * @ORM\Entity
 */
class TbNaturezaDespesaRecursoProcesso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="natureza_despesa_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $naturezaDespesaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="processo_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $processoId;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_alocado", type="decimal", precision=7, scale=3, nullable=true)
     */
    private $valorAlocado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_registro", type="datetime", nullable=true)
     */
    private $dataRegistro;



    /**
     * Set naturezaDespesaId
     *
     * @param integer $naturezaDespesaId
     *
     * @return TbNaturezaDespesaRecursoProcesso
     */
    public function setNaturezaDespesaId($naturezaDespesaId)
    {
        $this->naturezaDespesaId = $naturezaDespesaId;

        return $this;
    }

    /**
     * Get naturezaDespesaId
     *
     * @return integer
     */
    public function getNaturezaDespesaId()
    {
        return $this->naturezaDespesaId;
    }

    /**
     * Set processoId
     *
     * @param integer $processoId
     *
     * @return TbNaturezaDespesaRecursoProcesso
     */
    public function setProcessoId($processoId)
    {
        $this->processoId = $processoId;

        return $this;
    }

    /**
     * Get processoId
     *
     * @return integer
     */
    public function getProcessoId()
    {
        return $this->processoId;
    }

    /**
     * Set valorAlocado
     *
     * @param string $valorAlocado
     *
     * @return TbNaturezaDespesaRecursoProcesso
     */
    public function setValorAlocado($valorAlocado)
    {
        $this->valorAlocado = $valorAlocado;

        return $this;
    }

    /**
     * Get valorAlocado
     *
     * @return string
     */
    public function getValorAlocado()
    {
        return $this->valorAlocado;
    }

    /**
     * Set dataRegistro
     *
     * @param \DateTime $dataRegistro
     *
     * @return TbNaturezaDespesaRecursoProcesso
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
}
