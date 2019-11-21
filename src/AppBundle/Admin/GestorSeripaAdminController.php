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

use AppBundle\Entity\RoteiroMissao;

use AppBundle\Entity\TbOrdemServicoAeroporto as Passagem;
use AppBundle\Entity\TbOsControle as OsControle;


use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\Response;

class GestorSeripaAdminController extends Controller
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
		
			$rot = $this->getDoctrine()
        	->getRepository(RoteiroMissao::class);
				$queryRot = $rot->createQueryBuilder('r')
				->where('r.ordemServico = :cod')
				->setParameter('cod', $id)
				->getQuery();
				
				
			

			$roteiros = $queryRot->getResult();
			
			    $valor1 = 0;
			    $valor2 = 0;
				$valor3 = 0;
				$valor4 = 0;
				
			    $quantidade1 = 0;
				$quantidade2 = 0;
				$quantidade3 = 0;
				$quantidade4 = 0;

				$subTotal1 = 0;
				$subTotal2 = 0;
				$subTotal3 = 0;
				$subTotal4 = 0;
				$quantidadeAdicionalDeslocamento = 0;
				$valorTotalDeslocamento = 0.00;
				if($arrayOrdemServico[0]['missaoSemCusto'] == 0){
					
					
					
				
                 $numeroRotas = count($roteiros);
				 $i =1;
					foreach ($roteiros as $rotas) {

						$quantidadeAdicionalDeslocamento += $rotas->getAdicionalDeslocamento();
						
						
                        if($numeroRotas==$i){

			                $meiaDiaria=0.5;
                        }else{
			                $meiaDiaria=0;
                        }


						$cidadeMissao =  $rotas->getGeografiaCidade()->getId();
						$arrayCapitais90 =  array(47,829,1405);
						$arrayCapitais80 =  array(1856,1352,3525,3005,4585,5218);
						$arrayDemaisCapitais = array(02,1330,128,1633,2481,2949,1064,136,4184,2351,87,29,1656,861,05,2197,2045,2892,463);
					
						$capital90 = false;
						$capital80 = false;
						$demaisCapitais = false;
						
					if(in_array($cidadeMissao,$arrayCapitais90)){
						$valor1 = $arrayOrdemServico[0]['diaria90'];
					    $quantidade1 += $rotas->getQuantidadeDiarias();
					    $subTotal1= $valor1*$quantidade1;
					}elseif (in_array($cidadeMissao,$arrayCapitais80)){
						$valor2 = $arrayOrdemServico[0]['diaria80'];
					    $quantidade2 += $rotas->getQuantidadeDiarias();
					    $subTotal2 = $valor2*$quantidade2;
					}elseif (in_array($cidadeMissao,$arrayDemaisCapitais)){
						$valor3 = $arrayOrdemServico[0]['diaria70'];
					    $quantidade3 += $rotas->getQuantidadeDiarias();
					    $subTotal3 = $valor3*$quantidade3;
					}else{
						
						$valor4 = $arrayOrdemServico[0]['diaria50'];
					    $quantidade4 += $rotas->getQuantidadeDiarias();
					    $subTotal4 = $valor4*$quantidade4;
					}
				
					$arrayRotas[] =  array(
						'cidade' => $rotas->getGeografiaCidade(),
						'cidadeValor' => $rotas->getGeografiaCidade()->getDiaria(),
						'data_inicio' => $rotas->getDataInicio(),
						'hora_inicio' => $rotas->getHoraInicio(),
						'data_fim' => $rotas->getDateTermino(),
						'hora_fim' => $rotas->getHoraFinal(),
						'deslocamento' => $rotas->getAdicionalDeslocamento(),
						'pernoite' => $rotas->getPernoite(),
						'transporte' => $rotas->getTransporteUtilizado(),
						'capital90' => $capital90,
						'capital80' => $capital80,
						'demaisCapitais' => $demaisCapitais,
						'diarias' => $rotas->getQuantidadeDiarias(),
						'custoRoteiro' =>  $rotas->getValorDiaria()
			
					);

					$i++;

					}
			
			
				
					$valorTotalDeslocamento = $quantidadeAdicionalDeslocamento * 95.00;
			
				}
				  
			$userId = $arrayOrdemServico[0]['idUser'];

			
			$usu = $this->getDoctrine()
        	->getRepository(Usuario::class);
				$queryUser = $usu->createQueryBuilder('u')
				->innerJoin('u.setorDivisao', 'sd')
				->innerJoin('sd.tbDivisao', 'd')
				->innerJoin('d.unidade', 'un')
				->where('u.id = :cod')
				->setParameter('cod', $userId)
				->getQuery();
			
			$userPorOs = $queryUser->getResult();	  
			
			$usuarioPosto = $userPorOs[0]->getTbPostoGraduacao()->getId();
			
			$usuarioCivil = array(21,27,28);
			
			//se usuario for civil externo, pegar om pagadora
			if(in_array($usuarioPosto,$usuarioCivil)){
				$unidade = $arrayOrdemServico[0]['unidadeId'];
			}else{
				
				$unidade = $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getNomeUnidade();
				
			}	
				
			
			$numOs = str_replace('/','-',$arrayOrdemServico[0]['numOs']);
					$html = $this->renderView('number.html.twig', array(
					
						'ordemServico' => $arrayOrdemServico,
						'unidadeEmissaoOs' =>$unidade,
						'passagem' => $arrayPassagens,
						'roteiro' => $arrayRotas,
						'valorCapital90' => $valor1,
						'valorCapital80' => $valor2,
					    'valorDemaisCapitais' => $valor3,
						'valorDemaisDeslocamentos' => $valor4,
						'quantidade90' => $quantidade1,
						'quantidade80' => $quantidade2,
						'quantidadeDemaisCapitais' => $quantidade3,
						'quantidadeOutros' => $quantidade4,
						'subTotal90' => $subTotal1,
						'subTotal80' => $subTotal2,
						'subTotalDemaisCapitais' => $subTotal3,
						'subTotalOutros' => $subTotal4,
						'quantidadeDeslocamento' => $quantidadeAdicionalDeslocamento,
						'somaDeslocamento' => $valorTotalDeslocamento,
						'chefeUser' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getNome(),
						'unidadeUser' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getNomeUnidade(),
						'postoChefeUser' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getTbPostoGraduacao()->getNomePosto(),
						'quadroChefeUser' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getQuadro(),
		

 					));
					
					
					return new PdfResponse(
						$this->get('knp_snappy.pdf')->getOutputFromHtml($html),
						$numOs.'.pdf'
					);
		

    }
	
	public function diariasAction($id)
    {
		
		$os = $this->getDoctrine()
        ->getRepository(Os::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('os')
			->where('os.id = :id')
			->setParameter('id', $id)
			->getQuery();
			
			$ordemServico = $query->getResult();
			
			
		    $usuario = $ordemServico[0]->getTbUsuario()->getId();

            $em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
	
			
		
			$qb->andWhere('o.tbUsuario = :usuario');
			
			$qb->setParameter('status', $usuario);
			

			return $count = $qb->getQuery()->getSingleScalarResult();



	}
	public function sadAction($id)
    {
		$arrayPassagens[] =  $this->getDadosPassagemAerea($id);
		$arrayOrdemServico[] = $this->getDadosOrdemServicos($id);
		//$arrayRequisitante = $this->getRequisitantesOs($id);
		
		
		
		$os = $this->getDoctrine()
        ->getRepository(Os::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('os')
			->where('os.id = :id')
			->setParameter('id', $id)
			->getQuery();
			

			$ordemServicoPorCodigo = $query->getResult();
			$userId = $ordemServicoPorCodigo[0]->getTbUsuario()->getId();



			$usu = $this->getDoctrine()
        	->getRepository(Usuario::class);
				$queryUser = $usu->createQueryBuilder('u')
				->innerJoin('u.setorDivisao', 'sd')
				->innerJoin('sd.tbDivisao', 'd')
				->innerJoin('d.unidade', 'un')
				->where('u.id = :cod')
				->setParameter('cod', $userId)
				->getQuery();
			
			$userPorOs = $queryUser->getResult();


			$rot = $this->getDoctrine()
        	->getRepository(RoteiroMissao::class);
				$queryRot = $rot->createQueryBuilder('r')
				->where('r.ordemServico = :cod')
				->setParameter('cod', $id)
				->getQuery();

			$roteiros = $queryRot->getResult();

			foreach ($roteiros as $rotas) {
					$arrayRotas[] =  array(
						'cidade' => $rotas->getGeografiaCidade(),
						'data_inicio' => $rotas->getDataInicio(),
						'hora_inicio' => $rotas->getHoraInicio(),
						'data_fim' => $rotas->getDateTermino(),
						'hora_fim' => $rotas->getHoraInicio(),
						'deslocamento' => $rotas->getAdicionalDeslocamento(),
						'pernoite' => $rotas->getPernoite(),
						'transporte' => $rotas->getTransporteUtilizado(),
			
				);			
			}

			$pass = $this->getDoctrine()
        	->getRepository(Passagem::class);
				$queryPass = $pass->createQueryBuilder('p')
				->where('p.ordemServico = :cod')
				->setParameter('cod', $id)
				->getQuery();
			

			$passagens = $queryPass->getResult();
			$custoPassagem = 0.00;

			foreach ($passagens as $p) {
					$custoPassagem += $p->getValorPassagem();
							
			}

			$countRotas = count($arrayRotas);
			$inicioAutorizado = $arrayRotas[0]['data_inicio'];
			$retornoAutorizado = $arrayRotas[$countRotas-1]['data_fim'];

		 $html = $this->renderView('sad.html.twig', array(
			'ordem' => $arrayOrdemServico,
			'passagem' => $arrayPassagens,
			'roteiros' => $arrayRotas,
			'custoPassagem' => $custoPassagem,
			'nome' => $userPorOs[0]->getNome(),
			'posto' => $userPorOs[0]->getTbPostoGraduacao()->getNomePosto(),
			'regiao' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getEndereco(),
			'nomeChefeUnidade' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getNome(),
			'postoChefe'  => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getTbPostoGraduacao(),
			'nomeUnidade' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getNomeUnidade(),
			'quadro' => $userPorOs[0]->getQuadro(),
			'email' => $userPorOs[0]->getEmail(),
			'inicioAutorizado' => $inicioAutorizado,
			'retornoAutorizado' => $retornoAutorizado,
			'cpf' => $userPorOs[0]->getCpf(),
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
		
		
		
		
		$numOs = str_replace('/','-',$arrayOrdemServico[0]['numOs']);
		
		
		
       	return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'SAD-'.$numOs.'.pdf'
        );

    }

	public function getUsersPorCodigoFirpa($codigoFirpa){
		
		
		$os = $this->getDoctrine()
        ->getRepository(Os::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('os')
			->where('os.codigoFirpa = :cod')
			->setParameter('cod', $codigoFirpa)
			->getQuery();
			
			$ordemServicoPorCodigo = $query->getResult();
			
			foreach($ordemServicoPorCodigo as $os){
			$arrayUsers[] =  array(
				'nome' => $os->getTbUsuario()->getNome(),
				'posto' => $os->getTbUsuario()->getTbPostoGraduacao()->getNomePosto(),
				'quadro' => $os->getTbUsuario()->getQuadro(),
				'identidade' => $os->getTbUsuario()->getIdentidade(),
				'cpf' => $os->getTbUsuario()->getCpf(),

				

				);
			}
			
			return $arrayUsers;
			
		
			
	}
    public function osAction($id)
    {
		$arrayPassagens[] =  $this->getDadosPassagemAerea($id);
		$arrayOrdemServico[] = $this->getDadosOrdemServicos($id);
		//$arrayRequisitante = $this->getRequisitantesOs($id);
		
		
		
		
		
		$os = $this->getDoctrine()
        ->getRepository(Os::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('os')
			->where('os.id = :id')
			->setParameter('id', $id)
			->getQuery();
			

			$ordemServicoPorCodigo = $query->getResult();
			$userId = $ordemServicoPorCodigo[0]->getTbUsuario()->getId();



			$usu = $this->getDoctrine()
        	->getRepository(Usuario::class);
				$queryUser = $usu->createQueryBuilder('u')
				->innerJoin('u.setorDivisao', 'sd')
				->innerJoin('sd.tbDivisao', 'd')
				->innerJoin('d.unidade', 'un')
				->where('u.id = :cod')
				->setParameter('cod', $userId)
				->getQuery();
			
			$userPorOs = $queryUser->getResult();


			
			
			$rot = $this->getDoctrine()
        	->getRepository(RoteiroMissao::class);
				$queryRot = $rot->createQueryBuilder('r')
				->where('r.ordemServico = :cod')
				->setParameter('cod', $id)
				->getQuery();
			

			$roteiros = $queryRot->getResult();
			
			$totalAcrescimos = 0;
			
			$countRotas = count($roteiros);
			
			$i=1;
			
			
			foreach ($roteiros as $rotas) {
					$arrayRotas[] =  array(
						'cidade' => $rotas->getGeografiaCidade(),
						'data_inicio' => $rotas->getDataInicio(),
						'hora_inicio' => $rotas->getHoraInicio(),
						'data_fim' => $rotas->getDateTermino(),
						'hora_fim' => $rotas->getHoraFinal(),
						'deslocamento' => $rotas->getAdicionalDeslocamento(),
						'pernoite' => $rotas->getPernoite(),
						'transporte' => $rotas->getTransporteUtilizado(),
			
				);
				
				$i++;
				$totalAcrescimos += $rotas->getAdicionalDeslocamento();
				
				
				 
			}
			
			$somaAcrescimos = 95.00 * $totalAcrescimos;

			$inicioAutorizado = $arrayRotas[0]['data_inicio'];
			$horaInicio = $arrayRotas[0]['hora_inicio'];
			
			
			$retornoAutorizado = $arrayRotas[$countRotas-1]['data_fim'];
			$horaRetorno = $arrayRotas[$countRotas-1]['hora_fim'];

			
			$usuarioPosto = $userPorOs[0]->getTbPostoGraduacao()->getId();
			
			$usuarioCivil = array(21,27,28);
			
			//se usuario for civil externo, pegar om pagadora
			if(in_array($usuarioPosto,$usuarioCivil)){
				$unidade = $arrayOrdemServico[0]['unidadeId'];
			}else{
				
				$unidade = $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getNomeUnidade();
				
			}

			
		
			
			
		 $html = $this->renderView('ordem-servico.html.twig', array(
			'ordem' => $arrayOrdemServico,
			'passagem' => $arrayPassagens,
			'roteiros' => $arrayRotas,
			'nome' => $userPorOs[0]->getNome(),
			'posto' => $userPorOs[0]->getTbPostoGraduacao()->getNomePosto(),
			'unidadeEmissaoOs' => $unidade,
			'especialidade' => $userPorOs[0]->getQuadro(),
			'regiao' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getEndereco(),
			'diarias' => $userPorOs[0]->getTotalAno(),
			'banco' => $userPorOs[0]->getBanco(),
			'agencia' => $userPorOs[0]->getAgencia(),
			'conta' => $userPorOs[0]->getContaCorrente(),
			'identidade' => $userPorOs[0]->getIdentidade(),
			'saram' => $userPorOs[0]->getSaram(),
			'somaAcrescimos' => $somaAcrescimos,
			'quantidadeAcrescimo' => $totalAcrescimos,
			'chefeUser' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getNome(),
			'unidadeUser' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getNomeUnidade(),
			'postoChefeUser' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getTbPostoGraduacao()->getNomePosto(),
			'quadroChefeUser' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getQuadro(),
			'identidade' => $userPorOs[0]->getIdentidade(),
			'inicioAutorizado' => $inicioAutorizado,
			'horaInicio' => $horaInicio,
			'retornoAutorizado' => $retornoAutorizado,
			'horaRetorno' => $horaRetorno,
			'cpf' => $userPorOs[0]->getCpf(),
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
		
		
		
		
		$numOs = str_replace('/','-',$arrayOrdemServico[0]['numOs']);
		
		
		
       return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            $numOs.'.pdf'
        );

    }
	
	
	public function getUsersPorCodigo($codigoFirpa){
		
		
		$os = $this->getDoctrine()
        ->getRepository(Os::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('os')
			->where('os.tbUsuario = :cod')
			->setParameter('cod', $codigoFirpa)
			->getQuery();
			
			$ordemServicoPorCodigo = $query->getResult();

			foreach ($ordemServicoPorCodigo as $os);

				$arrayUsers[] =  array(
						'nome' => $os->getTbUsuario()->getNome(),
						'posto' => $os->getTbUsuario()->getTbPostoGraduacao()->getNomePosto(),
						'quadro' => $os->getTbUsuario()->getQuadro(),
						'identidade' => $os->getTbUsuario()->getIdentidade(),
						'cpf' => $os->getTbUsuario()->getCpf(),

				

					);

				return $arrayUsers;
				}
			
				
			
		
		public function getRoteiroPorCodigoFirpa($codigoFirpa){
		
		
		$roteiro = $this->getDoctrine()
        ->getRepository(RoteiroMissao::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $roteiro->createQueryBuilder('r')
			->innerJoin('r.ordemServico', 'os')
			->where('os.codigoFirpa = :cod')
			->setParameter('cod', $codigoFirpa)
			->getQuery();
			
			$ordemServicoPorCodigo = $query->getResult();
			
			foreach($ordemServicoPorCodigo as $os){
			$arrayUsers[] =  array(
				'cidade' => $os->getGeografiaCidade(),
				'data_inicio' => $os->getDataInicio(),
				'hora_inicio' => $os->getHoraInicio(),
				'data_fim' => $os->getDateTermino(),
				'hora_fim' => $os->getHoraInicio(),
				'deslocamento' => $os->getAdicionalDeslocamento(),
				'pernoite' => $os->getPernoite(),
				'transporte' => $os->getTransporteUtilizado(),
			
				);
			}
			
			return $arrayUsers;
			
		
			
	}	
	
	
	
	public function getRoteiroPorCodigo($idOs){
		
		
		$roteiro = $this->getDoctrine()
        ->getRepository(RoteiroMissao::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $roteiro->createQueryBuilder('r')
			->innerJoin('r.ordemServico', 'os')
			->where('os.id = :cod')
			->setParameter('cod', $idOs)
			->getQuery();
			
			$roteiroPorCodigo = $query->getResult();
			
			foreach($roteiroPorCodigo as $os){
			$arrayRotas[] =  array(
				'cidade' => $os->getGeografiaCidade(),
				'data_inicio' => $os->getDataInicio(),
				'hora_inicio' => $os->getHoraInicio(),
				'data_fim' => $os->getDateTermino(),
				'hora_fim' => $os->getHoraInicio(),
				'deslocamento' => $os->getAdicionalDeslocamento(),
				'pernoite' => $os->getPernoite(),
				'transporte' => $os->getTransporteUtilizado(),
			
				);
			}
			
			return $arrayRotas;
			
		
			
	}
	
	
	public function getPassagensPorCodigoFirpa($codigoFirpa){
		
		
		$passagem = $this->getDoctrine()
        ->getRepository(Passagem::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $passagem->createQueryBuilder('p')
			->innerJoin('p.ordemServico', 'os')
			->where('os.codigoFirpa = :cod')
			->setParameter('cod', $codigoFirpa)
			->getQuery();
			
			$passagemPorCodigo = $query->getResult();
			
			if(count($passagemPorCodigo>0)){
			
					foreach($passagemPorCodigo as $pass){
						$arrayUsers[] =  array(
						'data_viagem' => $pass->getDataViagem(),
						'hora' => $pass->getHorarioViagem(),
						'valor_passagem' => $pass->getValorPassagem(),
						'origem' => $pass->getAerodromoOrigem(),
						'destino' => $pass->getAerodromoDestino(),
					
					
						);
					}
			
			  return $arrayUsers;
			}
			else{
				
				return 0;
				
			}
		
			
	}
	
	
	public function firpaAction($id)
    {
		
	$arrayOrdemServico[] = $this->getDadosOrdemServicos($id);

		$os = $this->getDoctrine()
        ->getRepository(Os::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbOrdemServico
		// and aliases it to "os"
			$query = $os->createQueryBuilder('os')
			->where('os.id = :id')
			->setParameter('id', $id)
			->getQuery();
			
			$ordemServico = $query->getResult();
		
		
		$numOs = str_replace('/','-',$arrayOrdemServico[0]['numOs']);
		
		
		$codigoFirpa = $ordemServico[0]->getCodigoFirpa();
		
		$relacaoGrupoFirpa = $this->getUsersPorCodigoFirpa($codigoFirpa);
		
		$roteiroPorCodigo = $this->getRoteiroPorCodigoFirpa($codigoFirpa);
		
		$pass = $this->getDoctrine()
        	->getRepository(Passagem::class);
				$queryPass = $pass->createQueryBuilder('p')
				->innerJoin('p.ordemServico', 'os')
				->where('p.ordemServico = :cod')
				->andWhere('os.codigoFirpa = :firpa')
				->setParameter('cod', $id)
				->setParameter('firpa', $codigoFirpa)
				->getQuery();
			

			$passagens = $queryPass->getResult();
			
			
			
			foreach ($passagens as $passagem) {
					$arrayPassagens[] =  array(
						'data_viagem' => $passagem->getDataViagem(),
						'hora' => $passagem->getHorarioViagem(),
						'valor_passagem' => $passagem->getValorPassagem(),
						'origem' => $passagem->getAerodromoOrigem()->getIata(),
						'destino' => $passagem->getAerodromoDestino()->getIata(),
						'observacoes' => $passagem->getObservacoes(),
						'obsCenipa' => $passagem->getObsDpg(),
			
				);
		 
			}
		
		
		
			$data_viagem = $arrayPassagens[0]['data_viagem'];
			$hora = $arrayPassagens[0]['hora'];
			$origem = $arrayPassagens[0]['origem'];
			$destino = $arrayPassagens[0]['destino'];

		  $html = $this->renderView('firpa.html.twig', array(
			'ordemServico' => $arrayOrdemServico,
			'users' => $relacaoGrupoFirpa,
			'roteiro' => $roteiroPorCodigo,
			'pass' => $arrayPassagens,
			'codigo' => $codigoFirpa,
			'data_viagem' => $data_viagem,
			'hora' => $hora,
			'origem' => $origem,
			'destino' => $destino,

            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
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
		
		$valorAuxilio = $ordemServico[0]->getTbUsuario()->getAuxilioAlimentacao();
		
		$valorTransporte = $ordemServico[0]->getTbUsuario()->getAuxilioTransporte();
		
		$valorUnitarioTransporte = $valorTransporte/22;
		
		$valorUnitarioAlimentacao = $valorAuxilio/22;
		
		$subCentroCusto = $ordemServico[0]->getSubCentroCusto();
		
		$diariasCompletas = $ordemServico[0]->getTotalDiarias() >= 0.5 ? $ordemServico[0]->getTotalDiarias()-0.5 : 0.0;
		
		$arrayOrdemServico[] =  array(
				'numOs' => $ordemServico[0]->getNumeroOrdemServico(),
				'inicioMissao' => $ordemServico[0]->getInicioMissao(),
				'retornoMissao' => $ordemServico[0]->getRetornoMissao(),
				'horarioInicioMissao' => $ordemServico[0]->getHoraInicioMissao(),
				'horarioRetornoMissao' => $ordemServico[0]->getHoraRetornoMissao(),
				'observacoes' => $ordemServico[0]->getObservacoes(),
				'descricaoMissao' => $ordemServico[0]->getDescricaoMissao(),
				'tipoVooUtilizado' => $ordemServico[0]->getTipoAeronaveUtilizada(),
				'despesaContaPropria' => $ordemServico[0]->getDespesasContaPropria(),
				'contaUniao' => $ordemServico[0]->getContaUniao(),
				'pernoiteMissao' => $ordemServico[0]->getPernoiteMissao(),
				'acrescimoDeslocamento' => $ordemServico[0]->getAcrescimentoDeslocamento(),
				'quantidadeAcrescimoDeslocamento' => $ordemServico[0]->getQuantidadeAcrescimo(),
				'disponibildadeFinanceira' => $ordemServico[0]->getDisponibilidadeFinanceira(),
				'quantidadeAcrescimo' => $ordemServico[0]->getQuantidadeAcrescimo(),
				'quantidadeDiarias' => $ordemServico[0]->getQuantidadeDiarias(),
				'quantidadeDiariaCompleta' =>  $diariasCompletas,
				'quantidadeMeiaDiaria' =>  $ordemServico[0]->getMeiaDiaria(),
				'totalDiarias' =>  $ordemServico[0]->getTotalDiarias(),
				'valorMensalAlimentacao' => $valorAuxilio,
				'valorMensalTransporte' => $valorTransporte,
				'auxilioAlimentacao' => $ordemServico[0]->getAuxilioAlimentacao(),
				'auxilioTransporte' => $ordemServico[0]->getAuxilioTransporte(),
				'diariaAlimentacao' => $valorUnitarioAlimentacao,
				'diariaTransporte' => $valorUnitarioTransporte,
				'diasAlimentacao' => $ordemServico[0]->getDiasAlimentacao(),
				'diasTransporte' => $ordemServico[0]->getDiasTransporte(),
				'custoEstimado' => $ordemServico[0]->getCustoEstimado(),
				'custoLiquido' => $ordemServico[0]->getCustoLiquido(),
				'naturezaMissao' => $ordemServico[0]->getNaturezaMissao(),
				'modificaoDiarias' => $ordemServico[0]->getModificacaoDiarias(),
				'cidadeMissao' => '***',
				'nomeUsuario' => $ordemServico[0]->getTbUsuario()->getNome(),
				'saram' => $ordemServico[0]->getTbUsuario()->getSaram(),
				'postoGraduacao' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getNomePosto(),
				'especialidade' => $ordemServico[0]->getTbUsuario()->getTbPostoGraduacao()->getEspecialidade(),
				'militarAtivaReserva' => $ordemServico[0]->getTbUsuario()->getTipoAtividade(),
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
				'idUser' => $ordemServico[0]->getTbUsuario()->getId(),
				'cpfUsuario' =>   $ordemServico[0]->getTbUsuario()->getCpf(),
				'agenciaUsuario' =>   $ordemServico[0]->getTbUsuario()->getAgencia(),
				'bancoUsuario' =>   $ordemServico[0]->getTbUsuario()->getBanco(),
				'contaCorrenteUsuario' =>   $ordemServico[0]->getTbUsuario()->getContaCorrente(),
				'chefeCenipa' => $chefeCenipa[0]->getNome(),
				'postoChefeCenipa' => $chefeCenipa[0]->getTbPostoGraduacao(),
				'postoChefe' => $ordemServico[0]->getOmPagadora()->getChefe()->getTbPostoGraduacao()->getNomePosto(),
				'especialidadeChefe' => $ordemServico[0]->getOmPagadora()->getChefe()->getQuadro(),
                'chefeUnidade' => $ordemServico[0]->getOmPagadora()->getChefe()->getNome(),
                'unidade' => $ordemServico[0]->getOmPagadora(),
				'unidadeId' => $ordemServico[0]->getOmPagadora()->getId(),
				'missaoSemCusto' => $ordemServico[0]->getMissaoCusto(),
				'subCentroCusto' => $subCentroCusto,
				
				
				
				


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
			
			return $arrayPassagens[0];
		}else{
			
			 $arrayPassagens1[] =  array(
				'data_viagem' => 'Sem transporte aéreo',
				'horario_viagem' => 'Sem transporte aéreo',
				'valor_passagem' => 'Sem transporte aéreo',
				'aeroporto_origem' => 'Sem transporte aéreo',
				'aeroporto_destino' => 'Sem transporte aéreo',
				
				);
				
			return $arrayPassagens1[0];
		}
		
		
		
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
	
	
	public function getRequisitantesOs($id){
		 
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
			
	function dias_uteis($mes,$ano){
  
			  $uteis = 0;
			  // Obtém o número de dias no mês 
			  // (http://php.net/manual/en/function.cal-days-in-month.php)
			  $dias_no_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano); 

			  for($dia = 1; $dia <= $dias_no_mes; $dia++){

				// Aqui você pode verifica se tem feriado
				// ----------------------------------------
				// Obtém o timestamp
				// (http://php.net/manual/pt_BR/function.mktime.php)
				$timestamp = mktime(0, 0, 0, $mes, $dia, $ano);
				$semana    = date("N", $timestamp);

				if($semana < 6) $uteis++;

			  }

		return $uteis;

	}
	
	public function calculoAuxilio($idUser){
		
		
		
		
		
			$auxilioTransporteMensal = $usuario[0]->getAuxilioTransporte();
			
			$auxilioAlimentacaoMensal = $usuario[0]->getAuxilioAlimentacao();
			
			$valorTransporteDiario = $auxilioTransporteMensal/22;
			
			$valorAlimentacaoDiario = $auxilioAlimentacaoMensal/22;
			
			return array($valorTransporteDiario, $valorAlimentacaoDiario);

	}
	
	public function dias_feriados($ano = null)
    {
        if ($ano === null)
        {
            $ano = intval(date('Y'));
        }

        $pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
        $dia_pascoa = date('j', $pascoa);
        $mes_pascoa = date('n', $pascoa);
        $ano_pascoa = date('Y', $pascoa);

        $feriados = array(
            // Tatas Fixas dos feriados Nacionail Basileiras
            mktime(0, 0, 0, 1,  1,   $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independência - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 10,  12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
            mktime(0, 0, 0, 11,  2,  $ano), // Todos os santos - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 11, 15,  $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
            mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei nº 662, de 06/04/49

            // These days have a date depending on easter
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa),//2ºferia Carnaval
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa),//3ºferia Carnaval 
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa),//6ºfeira Santa  
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa),//Pascoa
            mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa),//Corpus Cirist
        );

        sort($feriados);

        return $feriados;
    }
	
	
			
			//CALCULANDO DIAS NORMAIS
		/*Abaixo vamos calcular a diferença entre duas datas. Fazemos uma reversão da maior sobre a menor
		para não termos um resultado negativo. */
		public function CalculaDias($xDataInicial, $xDataFinal){
		   $time1 = $this->dataToTimestamp($xDataInicial);  
		   $time2 = $this->dataToTimestamp($xDataFinal);  

		   $tMaior = $time1>$time2 ? $time1 : $time2;  
		   $tMenor = $time1<$time2 ? $time1 : $time2;  

		   $diff = $tMaior-$tMenor;  
		   $numDias = $diff/86400; //86400 é o número de segundos que 1 dia possui  
		   return $numDias;
		}

		//LISTA DE FERIADOS NO ANO
		/*Abaixo criamos um array para registrar todos os feriados existentes durante o ano.*/
		public function Feriados($ano){
		   $dia = 86400;
		   $datas = array();
		   $datas['pascoa'] = easter_date($ano);
		   $datas['sexta_santa'] = $datas['pascoa'] - (2 * $dia);
		   $datas['carnaval'] = $datas['pascoa'] - (47 * $dia);
		   $datas['corpus_cristi'] = $datas['pascoa'] + (60 * $dia);
		   $feriados = array (
			  '01/01',
			  '02/02', // Navegantes
			  date('d/m',$datas['carnaval']),
			  date('d/m',$datas['sexta_santa']),
			  date('d/m',$datas['pascoa']),
			  '21/04',
			  '01/05',
			  date('d/m',$datas['corpus_cristi']),
			  '20/09', // Revolução Farroupilha \m/
			  '12/10',
			  '02/11',
			  '15/11',
			  '25/12',
		   );
		  
		return $feriados;
		}      

		//FORMATA COMO TIMESTAMP
		/*Esta função é bem simples, e foi criada somente para nos ajudar a formatar a data já em formato  TimeStamp facilitando nossa soma de dias para uma data qualquer.*/
		public function dataToTimestamp($data){
		   $ano = substr($data, 6,4);
		   $mes = substr($data, 3,2);
		   $dia = substr($data, 0,2);
				return mktime(0, 0, 0, $mes, $dia, $ano);  
		}

		//SOMA 01 DIA  
		public function Soma1dia($data){  
			   $ano = substr($data, 6,4);
			   $mes = substr($data, 3,2);
			   $dia = substr($data, 0,2);
					return   date("d/m/Y", mktime(0, 0, 0, $mes, $dia+1, $ano));
		}

		
		function getWorkingDays($startDate, $endDate) {
			
			$ano = date("Y");
			
			$begin = strtotime($startDate);
			$end   = strtotime($endDate);
			if ($begin > $end) {
				echo "startdate is in the future! <br />";
				return 0;
			}
			//array('01/01', '21/04', '01/05', '07/09', '12/10', '02/11', '15/11', '25/12');
			else {
				
				
				$holidays = $this->Feriados(date("Y"));
				$weekends = 0;
				$no_days = 0;
				$holidayCount = 0;
				while ($begin <= $end) {
					$no_days++; // no of days in the given interval
					if (in_array(date("d/m", $begin), $holidays)) {
						$holidayCount++;
					}
					$what_day = date("N", $begin);
					if ($what_day > 5) { // 6 and 7 are weekend days
						$weekends++;
					};
					$begin += 86400; // +1 day
				};
        $working_days = $no_days - $weekends - $holidayCount;

        return $working_days;
    }
}

		//CALCULA DIAS UTEIS
		/*É nesta função que faremos o calculo. Abaixo podemos ver que faremos o cálculo normal de dias ($calculoDias), após este cálculo, faremos a comparação de dia a dia, verificando se este dia é um sábado, domingo ou feriado e em qualquer destas condições iremos incrementar 1*/

		public function DiasUteis($yDataInicial,$yDataFinal){

		   $diaFDS = 0; //dias não úteis(Sábado=6 Domingo=0)
		   $calculoDias = $this->CalculaDias($yDataInicial, $yDataFinal); //número de dias entre a data inicial e a final
		   $diasUteis = 0;
		  
		  $diaTimestamp = $this->dataToTimestamp($yDataInicial);
		  
		   while($yDataInicial!=$yDataFinal){
			  $diaSemana = date("w", $diaTimestamp);
			  if($diaSemana==0 || $diaSemana==6){
				 //se SABADO OU DOMINGO, SOMA 01
				 $diaFDS++;
			  }else{
			  //senão vemos se este dia é FERIADO
				 for($i=0; $i<=12; $i++){
					if($yDataInicial==$this->Feriados(date("Y"),$i)){
					   $diaFDS++;  
					}
				 }
			  }
			  $yDataInicial = $this->Soma1dia($yDataInicial); //dia + 1
		   }
			return $calculoDias - $diaFDS;
		}
		
		
	
		
		

   
		
		

}