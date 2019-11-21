<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * TbUsuario
 * @UniqueEntity(fields="cpf", message="CPF já existe")
 * @UniqueEntity(fields="pcdp", message="PCDP já existe")
 * @ORM\Table(name="tb_usuario", indexes={@ORM\Index(name="fk_tb_efetivo_tb_posto_graduacao1_idx", columns={"tb_posto_graduacao_id"}), @ORM\Index(name="fk_tb_efetivo_setor_divisao1_idx", columns={"setor_divisao_id"}), @ORM\Index(name="fk_quadro_especialidade", columns={"quadro_id"})})
 * @ORM\Entity
 * 
 */
class TbUsuario
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
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Nome não pode conter números"
     * )
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_guerra", type="string", length=45, nullable=true)
     */
    private $nomeGuerra;

    /**
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * 
     * @ORM\Column(name="pcdp", type="string", length=255, nullable=true)
     */
    private $pcdp;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=45, nullable=true)
     */
    private $telefone;
	
	/**
     * @var string
     *
     * @ORM\Column(name="tipo_atividade", type="string", length=10, nullable=true)
     */
    private $tipoAtividade;

     /**
     * 
     * @ORM\Column(name="cpf", type="string", length=45, nullable=false, unique=true)
     */
    private $cpf;
	
     /**
     * 
     * @ORM\Column(name="identidade", type="string", length=255, nullable=true)
     */
    private $identidade;
	
     /**
     * 
     * @ORM\Column(name="saram", type="string", length=45, nullable=false, unique=true)
     */
    private $saram;

     /**
     * 
     * @ORM\Column(name="banco", type="string", length=255, nullable=false)
     */
    private $banco;

     /**
     * 
     * @ORM\Column(name="agencia", type="string", length=45, nullable=true)
     */
    private $agencia;
	
     /**
     * @var boolean
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=false)
     */
	 private $ativo;

     /**
     * 
     * @ORM\Column(name="conta_corrente", type="string", length=45, nullable=true)
     */
    private $contaCorrente;

    /**
     * @var \TbQuadroEspecialidade
     *
     * @ORM\ManyToOne(targetEntity="TbQuadroEspecialidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quadro_id", referencedColumnName="id")
     * })
     */
    private $quadro;

    /**
     * @var \TbSetorDivisao
     *
     * @ORM\ManyToOne(targetEntity="TbSetorDivisao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="setor_divisao_id", referencedColumnName="id")
     * })
     */
    private $setorDivisao;

    /**
     * @var \TbPostoGraduacao
     *
     * @ORM\ManyToOne(targetEntity="TbPostoGraduacao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tb_posto_graduacao_id", referencedColumnName="id")
     * })
     */
    private $tbPostoGraduacao;



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
     * Set nome
     *
     * @param string $nome
     *
     * @return TbUsuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set nomeGuerra
     *
     * @param string $nomeGuerra
     *
     * @return TbUsuario
     */
    public function setNomeGuerra($nomeGuerra)
    {
        $this->nomeGuerra = $nomeGuerra;

        return $this;
    }

    /**
     * Get nomeGuerra
     *
     * @return string
     */
    public function getNomeGuerra()
    {
        return $this->nomeGuerra;
    }

    /**
     * Set pcdp
     *
     * @param string $pcdp
     *
     * @return TbUsuario
     */
    public function setPcdp($pcdp)
    {
        $this->pcdp = $pcdp;

        return $this;
    }

    /**
     * Get pcdp
     *
     * @return string
     */
    public function getPcdp()
    {
        return $this->pcdp;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return TbUsuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return TbUsuario
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
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
	
	
	/**
     * Set tipoAtividade
     *
     * @param string $tipoAtividade
     *
     * @return TbUsuario
     */
    public function setTipoAtividade($tipoAtividade)
    {
        $this->tipoAtividade = $tipoAtividade;

        return $this;
    }

    /**
     * Get tipoAtividade
     *
     * @return string
     */
    public function getTipoAtividade()
    {
        return $this->tipoAtividade;
    }
	
	
	

    /**
     * Set cpf
     *
     * @param string $cpf
     *
     * @return TbUsuario
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }
	
	
	 /**
     * Set identidade
     *
     * @param string $identidade
     *
     * @return TbUsuario
     */
    public function setIdentidade($identidade)
    {
        $this->identidade = $identidade;

        return $this;
    }

    /**
     * Get identidade
     *
     * @return string
     */
    public function getIdentidade()
    {
        return $this->identidade;
    }
	
	/**
     * Set saram
     *
     * @param string $saram
     *
     * @return TbUsuario
     */
    public function setSaram($saram)
    {
        $this->saram = $saram;

        return $this;
    }

    /**
     * Get cpf
     *
     * @return string
     */
    public function getSaram()
    {
        return $this->saram;
    }

    /**
     * Set banco
     *
     * @param string $banco
     *
     * @return TbUsuario
     */
    public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }

    /**
     * Get banco
     *
     * @return string
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * Set agencia
     *
     * @param string $agencia
     *
     * @return TbUsuario
     */
    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;

        return $this;
    }

    /**
     * Get agencia
     *
     * @return string
     */
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * Set contaCorrente
     *
     * @param string $contaCorrente
     *
     * @return TbUsuario
     */
    public function setContaCorrente($contaCorrente)
    {
        $this->contaCorrente = $contaCorrente;

        return $this;
    }

    /**
     * Get contaCorrente
     *
     * @return string
     */
    public function getContaCorrente()
    {
        return $this->contaCorrente;
    }

    /**
     * Set quadro
     *
     * @param \AppBundle\Entity\TbQuadroEspecialidade $quadro
     *
     * @return TbUsuario
     */
    public function setQuadro(\AppBundle\Entity\TbQuadroEspecialidade $quadro = null)
    {
        $this->quadro = $quadro;

        return $this;
    }

    /**
     * Get quadro
     *
     * @return \AppBundle\Entity\TbQuadroEspecialidade
     */
    public function getQuadro()
    {
        return $this->quadro;
    }

    /**
     * Set setorDivisao
     *
     * @param \AppBundle\Entity\TbSetorDivisao $setorDivisao
     *
     * @return TbUsuario
     */
    public function setSetorDivisao(\AppBundle\Entity\TbSetorDivisao $setorDivisao = null)
    {
        $this->setorDivisao = $setorDivisao;

        return $this;
    }

    /**
     * Get setorDivisao
     *
     * @return \AppBundle\Entity\TbSetorDivisao
     */
    public function getSetorDivisao()
    {
        return $this->setorDivisao;
    }

    /**
     * Set tbPostoGraduacao
     *
     * @param \AppBundle\Entity\TbPostoGraduacao $tbPostoGraduacao
     *
     * @return TbUsuario
     */
    public function setTbPostoGraduacao(\AppBundle\Entity\TbPostoGraduacao $tbPostoGraduacao = null)
    {
        $this->tbPostoGraduacao = $tbPostoGraduacao;

        return $this;
    }
	
	/**
     * Set ativo
     *
     * @param boolean $ativo
     *
     * @return TbUsuario
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get ativo
     *
     * @return boolean
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Get tbPostoGraduacao
     *
     * @return \AppBundle\Entity\TbPostoGraduacao
     */
    public function getTbPostoGraduacao()
    {
        return $this->tbPostoGraduacao;
    }
	
	public function __toString(){
		return $this->getTbPostoGraduacao().' '.$this->nomeGuerra;
	}
}
