<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TbNaturezaDespesa
 *
 * @ORM\Table(name="tb_taxonomia_natureza_despesa", indexes={@ORM\Index(name="fk_tb_natureza_despesa_tb_orcamento1_idx", columns={"tb_orcamento_id"})})
 * @ORM\Entity
 */
class TbTaxonomiaNaturezaDespesa
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
     * @ORM\Column(name="tipo_natureza", type="string", length=45, nullable=true)
     */
    private $tipoNatureza;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao_natureza", type="string", length=255, nullable=false)
     */
    private $descricaoNatureza;




    /**
     * Constructor
     */
    public function __construct()
    {
       // $this->processo = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set tipoNatureza
     *
     * @param string $tipoNatureza
     *
     * @return TbNaturezaDespesa
     */
    public function setTipoNatureza($tipoNatureza)
    {
        $this->tipoNatureza = $tipoNatureza;

        return $this;
    }

    /**
     * Get tipoNatureza
     *
     * @return string
     */
    public function getTipoNatureza()
    {
        return $this->tipoNatureza;
    }

    /**
     * Set descricaoNatureza
     *
     * @param string $descricaoNatureza
     *
     * @return TbNaturezaDespesa
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
        return $this->tipoNatureza.' - '.$this->descricaoNatureza;
    }
}
