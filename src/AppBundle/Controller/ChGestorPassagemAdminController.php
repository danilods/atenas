<?php
/**
 * Created by PhpStorm.
 * User: cenipa
 * Date: 19/04/2018
 * Time: 10:59
 */

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

use AppBundle\Entity\TbOrdemServico as Os;
use AppBundle\Entity\TbUsuario as Usuario;
use AppBundle\Entity\TbOrdemServicoAeroporto as Passagem;


use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\Response;

class ChGestorPassagemAdminController extends Controller
{
	
	
	
	public function pdfAction($id)
    {
		$arrayPassagens[] =  $this->getDadosPassagemAerea($id);
		$arrayOrdemServico[] = $this->getDadosOrdemServicos($id);
		
		  /*return $this->render('number.html.twig', array(
			'ordemServico' => $arrayOrdemServico,
			'passagem' => $arrayPassagens,
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));*/
		

		$numOs = str_replace('/','-',$arrayOrdemServico[0]['numOs']);
		
		 $html = $this->renderView('number.html.twig', array(
          'ordemServico' => $arrayOrdemServico,
			'passagem' => $arrayPassagens
			
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            $numOs.'.pdf'
        );

    }
	
	
	public function firpaAction($id)
    {
		  $arrayPassagens[] =  $this->getDadosPassagemAerea($id);
		  $arrayOrdemServico[] = $this->getDadosOrdemServicos($id);
		  
					
		
		
		
		$numOs = str_replace('/','-',$arrayOrdemServico[0]['numOs']);
		
		 $html = $this->renderView('firpa.html.twig', array(
          'ordemServico' => $arrayOrdemServico,
			'passagem' => $arrayPassagens
			
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            $numOs.'.pdf'
        );

    }
	
	public function getDadosOrdemServicos($id){
		
		$ordemServico = $this->getConsulta($id);
		$cidadeMissao =  47;
        $arrayCapitais90 =  array(47,829,1405);
        $arrayCapitais80 =  array(1856,1352,3525,3005,4585,5218);
		$arrayDemaisCapitais = array(02,1330,128,1633,2481,2949,1064,136,4184,2351,87,29,1656,861,05,2197,2045,2892);
		$chefeCenipa = $this->getChefeCenipa();
		
		
		
		
		
		
		$capital90 = false;
		$capital80 = false;
		$demaisCapitais = false;
		if(in_array($cidadeMissao,$arrayCapitais90)){
            $capital90=true;
			$capital80=false;
			$demaisCapitais = false;
        }else if (in_array($cidadeMissao,$arrayCapitais80)){
			$capital90=false;
			$capital80=true;
			$demaisCapitais = false;
		}else if (in_array($cidadeMissao,$arrayDemaisCapitais)){
			$capital90=false;
			$capital80=false;
			$demaisCapitais = true;
			
		}
		
		$arrayOrdemServico[] =  array(
				'numOs' => $ordemServico[0]->getNumeroOrdemServico(),
				'inicioMissao' => $ordemServico[0]->getInicioMissao(),
				'retornoMissao' => $ordemServico[0]->getRetornoMissao(),
				'horarioInicioMissao' => $ordemServico[0]->getHoraInicioMissao(),
				'horarioRetornoMissao' => $ordemServico[0]->getHoraRetornoMissao(),
				'observacoes' => $ordemServico[0]->getObservacoes(),
				'tipoVooUtilizado' => $ordemServico[0]->getTipoAeronaveUtilizada(),
				'despesaContaPropria' => $ordemServico[0]->getDespesasContaPropria(),
				'contaUniao' => $ordemServico[0]->getContaUniao(),
				'pernoiteMissao' => $ordemServico[0]->getPernoiteMissao(),
				'acrescimoDeslocamento' => $ordemServico[0]->getAcrescimentoDeslocamento(),
				'quantidadeAcrescimoDeslocamento' => $ordemServico[0]->getQuantidadeAcrescimo(),
				'disponibildadeFinanceira' => $ordemServico[0]->getDisponibilidadeFinanceira(),
				'quantidadeAcrescimo' => $ordemServico[0]->getQuantidadeAcrescimo(),
				'quantidadeDiarias' => $ordemServico[0]->getQuantidadeDiarias(),
				'quantidadeDiariaCompleta' =>  $ordemServico[0]->getDiariasCompletas(),
				'quantidadeMeiaDiaria' =>  $ordemServico[0]->getMeiaDiaria(),
				'totalDiarias' =>  $ordemServico[0]->getTotalDiarias(),
				'auxilioAlimentacao' => $ordemServico[0]->getAuxilioAlimentacao(),
				'auxiloTransporte' => $ordemServico[0]->getAuxilioTransporte(),
				'custoEstimado' => $ordemServico[0]->getCustoEstimado(),
				'custoLiquido' => $ordemServico[0]->getCustoLiquido(),
				'modificaoDiarias' => $ordemServico[0]->getModificacaoDiarias(),
				'cidadeMissao' => '***',
				'nomeUsuario' => $ordemServico[0]->getTbUsuario()->getNome(),
				'postoGraduacao' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getNomePosto(),
				'especialidade' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getEspecialidade(),
				'diariaNormal' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getCiruculoHierarquico()->getDiariaNormal(),
				'diaria90' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getCiruculoHierarquico()->getNoventa(),
				'valorMeiaDiaria' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getCiruculoHierarquico()->getMeiaDiaria(),
				'diaria80' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getCiruculoHierarquico()->getOitenta(),
				'diaria70' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getCiruculoHierarquico()->getSetenta(),
				'diaria50' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getCiruculoHierarquico()->getCinquenta(),
				'capital90' => $capital90,
				'capital80' => $capital80,
				'demaisCapitais' => $demaisCapitais,
				'setorDivisao' => $ordemServico[0]->getTbUsuario()->getSetorDivisao()->getSigla(),
				'cpfUsuario' =>   $ordemServico[0]->getTbUsuario()->getCpf(),
				'agenciaUsuario' =>   $ordemServico[0]->getTbUsuario()->getAgencia(),
				'bancoUsuario' =>   $ordemServico[0]->getTbUsuario()->getBanco(),
				'contaCorrenteUsuario' =>   $ordemServico[0]->getTbUsuario()->getContaCorrente(),
				'chefeCenipa' => $chefeCenipa[0]->getNome(),
				'postoChefe' => $chefeCenipa[0]->getTbPostoGraduacao()->getNomePosto(),
				
				
	
			);
		
		
		return $arrayOrdemServico[0];
		
		
		
	}
	
	public function getDadosPassagemAerea($id){
		$passagem = $this->getPassagens($id);
		
		$data = date('Y-m-d');
		
		$saida = new \DateTime($data);
		
		if(count($passagem)>1){
			
		foreach($passagem as $aeroportos){
			$arrayPassagens[] =  array(
				'data_viagem' => $aeroportos->getDataViagem(),
				'horario_viagem' => $aeroportos->getHorarioViagem(),
				'valor_passagem' => $aeroportos->getValorPassagem(),
				'aeroporto_origem' => $aeroportos->getAerodromoOrigem()->getIata(),
				'aeroporto_destino' => $aeroportos->getAerodromoDestino()->getIata(),
				
				);
			}
		}
		
		return $arrayPassagens[0];
	}
	
	public function getChefeCenipa(){
		
		$os = $this->getDoctrine()
        ->getRepository(Usuario::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('us')
			->innerJoin('us.setorDivisao', 's')
			->where('s.id = :sigla')
			->setParameter('sigla', 164)
			->getQuery();
			
			return $query->getResult();
		
	}
	
	
	public function getConsulta($id){
		 
	
		
		$os = $this->getDoctrine()
        ->getRepository(Os::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('os')
			->innerJoin('os.tbUsuario', 'u')
			->innerJoin('u.setorDivisao', 's')
			->where('os.id = :id')
			->setParameter('id', $id)
			->getQuery();
			
			return $query->getResult();
	}
	
	public function getPassagens($id){
		
		

		$os = $this->getDoctrine()
        ->getRepository(Passagem::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('p')
			->where('p.ordemServico = :id')
			->setParameter('id', $id)
			->getQuery();
			
			return $query->getResult();
				
			}

}