<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * TbControleNaturezaDespesa
 *
 * @ORM\Table(name="tb_controle_natureza_despesa", indexes={@ORM\Index(name="fk_tb_controle_natureza_despesa_tb_natureza_despesa1_idx", columns={"tb_natureza_despesa_id"})})
 * @ORM\Entity
 * @Vich\Uploadable
 */
class TbControleNaturezaDespesa
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
     * @ORM\Column(name="tipo_operacao", type="string", length=45, nullable=true)
     */
    private $tipoOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_empenho",  type="string", length=45, nullable=true)
     */
    private $notaEmpenho;


    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_registro", type="datetime", nullable=true)
     */
    private $dataRegistro;

    /**
     * @ORM\Column(name="image_name", type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="image_name")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @var \TbNaturezaDespesa
     *
     * @ORM\ManyToOne(targetEntity="TbNaturezaDespesa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_natureza_despesa_id", referencedColumnName="id")
     * })
     */
    private $tbNaturezaDespesa;


     public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->dataRegistro = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }


    /**
     * Set imageName
     *
     * @param string $imageName
     * @return RcsvControle
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->imageName;
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
     * Set tipoOperacao
     *
     * @param string $tipoOperacao
     *
     * @return TbControleNaturezaDespesa
     */
    public function setTipoOperacao($tipoOperacao)
    {
        $this->tipoOperacao = $tipoOperacao;

        return $this;
    }

    /**
     * Get tipoOperacao
     *
     * @return string
     */
    public function getNotaEmpenho()
    {
        return $this->notaEmpenho;
    }


    /**
     * Set notaEmpenho
     *
     * @param string $notaEmpenho
     *
     * @return TbControleNaturezaDespesa
     */
    public function setNotaEmpenho($notaEmpenho)
    {
        $this->notaEmpenho = $notaEmpenho;

        return $this;
    }

    /**
     * Get tipoOperacao
     *
     * @return string
     */
    public function getTipoOperacao()
    {
        return $this->tipoOperacao;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return TbControleNaturezaDespesa
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set dataRegistro
     *
     * @param \DateTime $dataRegistro
     *
     * @return TbControleNaturezaDespesa
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
     * Set anexo
     *
     * @param string $anexo
     *
     * @return TbControleNaturezaDespesa
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;

        return $this;
    }

    /**
     * Get anexo
     *
     * @return string
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * Set tbNaturezaDespesa
     *
     * @param \AppBundle\Entity\TbNaturezaDespesa $tbNaturezaDespesa
     *
     * @return TbControleNaturezaDespesa
     */
    public function setTbNaturezaDespesa(\AppBundle\Entity\TbNaturezaDespesa $tbNaturezaDespesa = null)
    {
        $this->tbNaturezaDespesa = $tbNaturezaDespesa;

        return $this;
    }

    /**
     * Get tbNaturezaDespesa
     *
     * @return \AppBundle\Entity\TbNaturezaDespesa
     */
    public function getTbNaturezaDespesa()
    {
        return $this->tbNaturezaDespesa;
    }


  

}
