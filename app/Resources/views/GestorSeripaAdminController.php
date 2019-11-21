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
					    $quantidade1 = $rotas->getQuantidadeDiarias();
					    $subTotal1 = $valor1*$quantidade1;
					}elseif (in_array($cidadeMissao,$arrayCapitais80)){
						$valor2 = $arrayOrdemServico[0]['diaria80'];
					    $quantidade2 = $rotas->getQuantidadeDiarias();
					    $subTotal2 = $valor2*$quantidade2;
					}elseif (in_array($cidadeMissao,$arrayDemaisCapitais)){
						$valor3 = $arrayOrdemServico[0]['diaria70'];
					    $quantidade3 = $rotas->getQuantidadeDiarias();
					    $subTotal3 = $valor3*$quantidade3;
					}else{
						
						$valor4 = $arrayOrdemServico[0]['diaria50'];
					    $quantidade4 = $rotas->getQuantidadeDiarias();
					    $subTotal4 = $valor4*$quantidade4;
					}
				
					$arrayRotas[] =  array(
						'cidade' => $rotas->getGeografiaCidade(),
						'cidadeValor' => $rotas->getGeografiaCidade()->getDiaria(),
						'data_inicio' => $rotas->getDataInicio(),
						'hora_inicio' => $rotas->getHoraInicio(),
						'data_fim' => $rotas->getDateTermino(),
						'hora_fim' => $rotas->getHoraInicio(),
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
				  
				
				  
			
				
				
			
			$numOs = str_replace('/','-',$arrayOrdemServico[0]['numOs']);

					$html = $this->renderView('number.html.twig', array(
					
						'ordemServico' => $arrayOrdemServico,
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
						'somaDeslocamento' => $valorTotalDeslocamento

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

		
		 $html = $this->render('sad.html.twig', array(
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
						'hora_fim' => $rotas->getHoraInicio(),
						'deslocamento' => $rotas->getAdicionalDeslocamento(),
						'pernoite' => $rotas->getPernoite(),
						'transporte' => $rotas->getTransporteUtilizado(),
			
				);
					
				$totalAcrescimos += $rotas->getAdicionalDeslocamento();
				
				if($i == $countRotas){					
					$retornoAutorizado = $rotas->getDateTermino();
					$horaRetorno = $rotas->getHoraTermino();				
				}
				 
			}
			
			$somaAcrescimos = 95.00 * $totalAcrescimos;

			$inicioAutorizado = $arrayRotas[0]['data_inicio'];
			$horaInicio = $arrayRotas[0]['hora_inicio'];



			
		
			
			
		
		 $html = $this->render('ordem-servico.html.twig', array(
			'ordem' => $arrayOrdemServico,
			'passagem' => $arrayPassagens,
			'roteiros' => $arrayRotas,
			'nome' => $userPorOs[0]->getNome(),
			'posto' => $userPorOs[0]->getTbPostoGraduacao()->getNomePosto(),
			'regiao' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getEndereco(),
			'diarias' => $userPorOs[0]->getTotalAno(),
			'banco' => $userPorOs[0]->getBanco(),
			'agencia' => $userPorOs[0]->getAgencia(),
			'conta' => $userPorOs[0]->getContaCorrente(),
			'identidade' => $userPorOs[0]->getIdentidade(),
			'saram' => $userPorOs[0]->getSaram(),
			'nomeChefeUnidade' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getNome(),
			'postoChefe'  => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getChefe()->getTbPostoGraduacao(),
			'somaAcrescimos' => $somaAcrescimos,
			'quantidadeAcrescimo' => $totalAcrescimos,
			'nomeUnidade' => $userPorOs[0]->getSetorDivisao()->getTbDivisao()->getUnidade()->getNomeUnidade(),
			'quadro' => $userPorOs[0]->getQuadro(),
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
						'origem' => $passagem->getAerodromoOrigem(),
						'destino' => $passagem->getAerodromoDestino(),
			
				);
		 
			}
		
		
		
			$data_viagem = $arrayPassagens[0]['data_viagem'];
			$hora = $arrayPassagens[0]['hora'];
			$origem = $arrayPassagens[0]['origem'];
			$destino = $arrayPassagens[0]['destino'];


		  $html = $this->render('firpa.html.twig', array(
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
				'quantidadeDiariaCompleta' =>  $ordemServico[0]->getDiariasCompletas(),
				'quantidadeMeiaDiaria' =>  $ordemServico[0]->getMeiaDiaria(),
				'totalDiarias' =>  $ordemServico[0]->getTotalDiarias(),
				'auxilioAlimentacao' => $ordemServico[0]->getAuxilioAlimentacao(),
				'auxiloTransporte' => $ordemServico[0]->getAuxilioTransporte(),
				'custoEstimado' => $ordemServico[0]->getCustoEstimado(),
				'custoLiquido' => $ordemServico[0]->getCustoLiquido(),
				'naturezaMissao' => $ordemServico[0]->getNaturezaMissao(),
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
                'chefeUnidade' => $ordemServico[0]->getOmPagadora()->getChefe(),
                'unidade' => $ordemServico[0]->getOmPagadora(),


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

}