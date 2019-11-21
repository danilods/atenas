<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Admin;

/**
 * Description of GeografiaCidadeAdmin
 *
 * @author danilodesouza
 */

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Entity\TbMovimentacaoDespesaOs as DespesaOs;
use AppBundle\Entity\TbOsControle as OsControle;
use AppBundle\Entity\TbDiariasControle as DiariasControle;
use AppBundle\Controller\GestorSeripaAdminController as GestorController;

use AppBundle\Entity\TbNaturezaDespesa as NaturezaDespesa;

use AppBundle\Entity\TbCalculoDespesaOs as CalculoDespesaOs;
use AppBundle\Entity\TbMovimentacaoDespesaPassagem as DespesaPassagem;
use Whyte624\SonataAdminExtraExportBundle\Admin\AdminExtraExportTrait;
use Sonata\AdminBundle\Route\RouteCollection;


use Knp\Menu\ItemInterface as MenuItemInterface;




class GestorSeripa6Admin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
   protected $baseRouteName = 'ordem_missao_seripa6';
   protected $baseRoutePattern = 'page-gestor-seripa6';
   
   	 protected $datagridValues = [

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'dataCadastro',
    ];
	
	
	
	 /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('pdf', $this->getRouterIdParameter().'/pdf');
		$collection->add('os', $this->getRouterIdParameter().'/os');
        $collection->add('sad', $this->getRouterIdParameter().'/sad');

    }

     public function createQuery($context = 'list') {
    $query = parent::createQuery($context);

    $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

   
        $query->where('o.omPagadora = :unidade')
			  ->andWhere($query->getRootAliases()[0]. '.statusOs = :status or o.statusOs = :status2')

			  ->setParameter('unidade', 7)
			  ->setParameter('status', 'PENDENTE')
			  ->setParameter('status2', 'CONFIRMADA')

			  
			  ;

    return $query;
}


  protected function configureFormFields(FormMapper $formMapper)
    {
     $formMapper

            ->tab('DADOS DA ORDEM DE SERVIÇO')
            ->with('ORDEM DE SERVIÇO', array(
                'class' => 'col-md-5',
                'box_class' => 'box box-solid box-primary',
                // ...
            ))
            ->add('tipoMissao', 'choice', array(
                'choices' => array(

                    'NACIONAL' => 'MISSÃO NACIONAL',
                    'PLAMTAX' => 'MISSÃO PLAMTAX',
                    'EXTRAPLAMTAX' => 'MISSÃO EXTRA PLAMTAX'

                ),
                'label' => 'Tipo de missão:',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))
			
			->add('missaoCusto', null, array(
							'label' => 'Missão sem custo?'
						))
						
			->add('missaoPagaOutraOm', null, array(
							'label' => 'Custeada por outra OM?'
						))
            ->add('numeroOrdemServico', null, array(
                    'label' => 'Número OS',
                  
                )
            )
			->add('subCentroCusto', null, array(
                    'label' => 'Subcentro de custo:',
                    'read_only' => false,
                    'disabled' => false
                )
            )
            ->add('tbUsuario', 'text', array(
                    'label' => 'Requisitante:',
                    'read_only' => true,
                    'disabled' => true
                )
            )

            ->add('setorId', 'text', array(
                    'label' => 'Divisão',
                    'read_only' => true,
                    'disabled' => true
                )
            )

            ->add('descricaoMissao', null, array(
                    'label' => 'Descrição da missão:',
                    'read_only' => false,
                    'disabled' => false
                )
            )

            

            
            ->add('observacoes', null, array(
                'label' => 'Observações:'
            ))
            ->add('quantidadeDiarias')
                
            ->add('diariasCompletas')
                    
            ->add('meiaDiaria')
                    
                    
                    
            ->add('totalDiarias')

            ->add('auxilioAlimentacao', 'money', array(
                'label' => 'Desconto auxílio alimentação:',
                'currency' => 'BRL',
                'grouping' =>true))

            ->add('auxilioTransporte', 'money', array(
                'label' => 'Desconto auxílio transporte:',
                'currency' => 'BRL',
                'grouping' =>true))

            ->add('custoEstimado', 'money', array(
                'currency' => 'BRL',
                'grouping' =>true))
			->add('pagamentoAntecipado', null, array(
							'label' => 'Pagamento antecipado?'
						))	
				
            ->add('modificacaoDiarias', 'choice', array(
                'choices' => array(


                    'SIM' => 'SIM',
                    'NAO' => 'NAO',

                ),
                'label' => 'Houve modificação de diárias?',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))
            ->add('justificativaAntecipacao', null, array(
                'label' => 'Justificativa antecipação:'
            ))

            ->add('naturezaMissao', null, array(
                'label' => 'Natureza da Missão:'
            ))
            ->add('tbTaxonomiaNaturezaDespesa', null, array(
                'label' => 'Natureza de Despesa:'
            ))
            
            ->add('omPagadora', null, array(
                'label' => 'OM requisitante da missão:'
            ))





            ->end()


            ->with('APROVAÇÃO DA ORDEM DE SERVIÇO', array(
                'class' => 'col-md-7',
                'box_class' => 'box box-solid box-warning',
                // ...

            ))
           ->add('statusOs', 'choice', array(
                'choices' => array(
                    'PENDENTE' => 'ORDEM DE SERVIÇO PENDENTE DE APROVAÇÃO',
					'CONFIRMADA' => 'ORDEM DE SERVIÇO CONFIRMADA',

					'ANALISADA' => 'APROVAR O.S E ENCAMINHAR AO CHEFE DO SERIPA',
                    'CANCELADA' => 'CANCELAR ORDEM DE SERVIÇO',




                ),
                'label' => 'Definir status da ORDEM de SERVIÇO',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))








            ->end()
            ->with('EMISSÃO DE PASSAGENS', array(
                'class' => 'col-md-7',
                'box_class' => 'box box-solid box-success',
                // ...

            ))
            ->add('statusPassagem', 'choice', array(
                'choices' => array(

                    '0' => 'PASSAGEM NÃO EMITIDA OU CANCELADA',
                    '1' => 'EMISSÃO DE PASSAGEM SOLICITADA',
                   



                ),
                'label' => 'Definir status da passagem',
                'required'=>false,
                'expanded' => true,
                'multiple' => false
            ))
            ->end()



    /*
            ->with('Controle e acompanhanmento', array(
                'class' => 'col-md-7',
                'box_class' => 'box box-solid box-primary',
                'description' => '',
                // ...
            ))

            ->add('controle', 'sonata_type_collection',
                array(

                    'required'      => true,
                    'type_options'  => array(
                        'delete' => true,
                        'cascade_validation' => true
                    ),
                    'by_reference'  => true,
                    'mapped'        => true
                ),
                array(
                    'edit'          => 'inline',
                    'inline'        => 'inline',
                    'sortable'      => 'standard',

                ))





            ->end()*/

            ->end()

            
            
            ->tab('ROTEIRO MISSÃO')
            ->with('TRECHOS', array(
                'class' => 'col-md-12',
                'box_class' => 'box box-solid box-primary',
                'description' => '',
            ))

            ->add('roteiro', 'sonata_type_collection',
                array(

                    'required'      => true,
                    'type_options'  => array(
                        'delete' => true,
                        'cascade_validation' => true
                    ),
                    'by_reference'  => true,
                    'mapped'        => true
                ),
                array(
                    'edit'          => 'inline',
                    'inline'        => 'inline',
                    'sortable'      => 'standard',

                ))

            ->end()
            
            ->end()
            ->tab('PASSAGEM AÉREA')
            ->with('REQUISIÇÃO DE PASSAGEM', array(
                'class' => 'col-md-12',
                'box_class' => 'box box-solid box-primary',
                'description' => '',
            ))

            ->add('aeroporto', 'sonata_type_collection',
                array(

                    'required'      => true,
                    'type_options'  => array(
                        'delete' => true,
                        'cascade_validation' => true
                    ),
                    'by_reference'  => true,
                    'mapped'        => true
                ),
                array(
                    'edit'          => 'inline',
                    'inline'        => 'inline',
                    'sortable'      => 'standard',

                ))

            ->end()
            
            ->end()




        ;
    }



    

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            
        ->add('numeroOrdemServico', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_numero_os.html.twig', 'label' => 'Número da OS'))

            ->add('roteiro',null, array('associated_tostring' => 'getSaida'))
            ->add('naturezaMissao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_missao.html.twig', 'label' => 'Tipo de missão'))
            ->add('tbNaturezaDespesa', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_natureza.html.twig', 'label' => 'Custo e natureza de despesa'))

            ->add('statusOs', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_status_os.html.twig', 'label' => 'Status'))

            ->add('_action', 'actions', array(
                'actions' => array(

                    'edit' => array(),
                   
					'delete' => array(),
                    'Gerar Ficha de Apresentação' => array('template' => 'button.html.twig'),
                    'Gerar OS' => array('template' => 'button_os.html.twig'),
                    'Solicitar autorização ao GABAER' => array('template' => 'button_teste.html.twig'),


                )
            ))
        ;
    }




    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('numeroOrdemServico', null, array(
                'label' => 'Número OS:'
            ))
            ->add('descricaoMissao', null, array(
                'label' => 'Descricao da missão:'
            ))

            ->add('observacoes', null, array(
                'label' => 'Observacoes:'
            ))

            ->add('justificativaAntecipacao', null, array(
                'label:' => 'Justificativa'
            ))
            ->add('naturezaMissao', null, array(
                'Atividade:'
            ))
            ->add('tbUsuario.nome', null, array(
                'label' => 'Nome do participante'
            ))
            ->add('roteiro.geografiaCidade.nome', null, array(
                'label' => 'Cidade:'
            ))

        ;
    }

  public function prePersist($object) {

        foreach ($object->getAeroporto() as $aeroporto) {

            $aeroporto->setOrdemServico($object);



        }
        
        
        
        
        foreach ($object->getRoteiro() as $roteiro) {

            $roteiro->setOrdemServico($object);
            
                    
        }



    }

  public function preUpdate($object) {

        $exercicio = date('Y');

        $unidade = $object->getOmPagadora()->getId();

				

				  foreach ($object->getAeroporto() as $aeroporto) {

						$aeroporto->setOrdemServico($object);



					}


					foreach ($object->getRoteiro() as $roteiro) {

						$roteiro->setOrdemServico($object);
						
						$dataInicio = $roteiro->getDataInicio();
						
						$arrayDatas[] =  $dataInicio->format('Y-m-d');


					}
				
			

			foreach ($object->getAeroporto() as $aeroporto) {

            $aeroporto->setOrdemServico($object);



            $emPassagem = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

            $repositoryPassagem = $emPassagem->getRepository('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

            $movimentacaoPassagem = $repositoryPassagem->findBy(
                array('ordemServico' => $object->getId(), 'passagem' => $aeroporto->getId(), 'naturezaDespesa' => 3, 'exercicio' => $exercicio, 'unidade' => $unidade)
            );


            if(count($movimentacaoPassagem)>0){

                foreach ($movimentacaoPassagem as $movPassagem) {

                    $movPassagem->setOrdemServico($object->getId());

                    $movPassagem->setPassagem($aeroporto);


                    if ($object->getStatusOs() == 'CANCELADA') {

                        $movPassagem->setValorDespesa(0.00);

                    } else {
                        $movPassagem->setValorDespesa($aeroporto->getValorPassagem());

                    }
                }

                $emPassagem->flush();

            } else{

                $passagem = new DespesaPassagem();

                $passagem->setOrdemServico($object->getId());

                $passagem->setNaturezaDespesa(3);

                $passagem->setExercicio($exercicio);

                $passagem->setNaturezaMissao($object->getNaturezaMissao()->getId());

                $passagem->setPassagem($aeroporto);

                $passagem->setUnidade($unidade);

                $passagem->setValorDespesa($aeroporto->getValorPassagem());

                $emPassagem->persist($passagem);

                $emPassagem->flush();


            }

        }

		 //$roteirosPernoite = $this->getRoteirosComPernoite($object->getId());
		 
		 $roteirosMesmaData = $this->pesquisarDatasIguais($arrayDatas[0],$object->getId());
		 
		 $usuario = $object->getTbUsuario();
		 
		 	$emRoteiro = $this->getModelManager()->getEntityManager('AppBundle\Entity\RoteiroMissao');

			$repositoryRoteiro = $emRoteiro->getRepository('AppBundle\Entity\RoteiroMissao');
			
		 
		 if($roteirosMesmaData[0] == count($object->getRoteiro())){
					
					 $roteirosMissao = $roteirosMesmaData[1];
					 
					 $horasMissao = $roteirosMesmaData[1];
					 
					 $cidade = $roteirosMesmaData[2];
					 
					 $dataIda = $roteirosMesmaData[3];
					 
					 $dataVolta = $roteirosMesmaData[4];
					 
					 $objMaiorRoteiro = $roteirosMesmaData[5];
					 
					 $demaisRoteiros = $roteirosMesmaData[6];
					
					 $count = count($demaisRoteiros);
					
					 $meiaDiaria = $horasMissao > 8 ? 0.5:0.0;
					
					//array(count($roteirosId),$diff, $maiorCidade, $arrDataIda[0],$arrDataVolta[0], 1);
			 
					 $datasIguais = 1;
				
					//$dataIda,  $dataRetorno, $usuario, $cidade, $deslocamento, $meia, $datasIguais
					
					//count($roteirosId),$diff, $maiorCidade, $arrDataIda[0],$arrDataVolta[0], $roteiroMaior[0],  $demaisRoteirosIguais

					
					//calculo do roteiro de maior cidade
					$saida = $this->calcularDiariasTrecho($dataIda, $dataVolta, $usuario, $cidade, $objMaiorRoteiro->getAdicionalDeslocamento(), $meiaDiaria, $datasIguais);
					
					//calculo dos demais roteiros do mesmo dia - vverificar adicional deslocamento
					
					$objMaiorRoteiro->setQuantidadeDiarias($saida[1]);
					$objMaiorRoteiro->setValorDiaria($saida[0]);
					
										$emRoteiro->flush();

					
			

					
					if($count > 0){
						
						foreach($demaisRoteiros as $rota){
							
							
							
							$data1 = $rota->getDataInicio()->format('Y-m-d');
							$data2 = $rota->getDateTermino()->format('Y-m-d');
							
							
							
					//$dataIda,  $dataRetorno, $usuario, $cidade, $deslocamento, $meia, $datasIguais
							$saidaOutros = $this->calcularDiariasTrecho($data1,$data2, $usuario, $rota->getGeografiaCidade()->getDiaria(),$rota->getAdicionalDeslocamento(), $meia=0, $datasIguais=1);
							
							$rota->setQuantidadeDiarias($saidaOutros[1]);
							$rota->setValorDiaria($saidaOutros[0]);
							
										$emRoteiro->flush();

						}
						


					}
					

					

		 }else{
			 
					 //datas diferentes
					 //pesquisar roteiro com pernoite
			 
					 $roteiroPernoite = $this->getRoteirosComPernoite($object->getId());
			 
					 $cidade = $roteiroPernoite[0]->getGeografiaCidade()->getDiaria();
					 
					 $dataIda = $roteiroPernoite[0]->getDataInicio()->format('Y-m-d');
					
					 $dataRetorno = $roteiroPernoite[0]->getDateTermino()->format('Y-m-d');
		
					 $roteirosRestantes = $roteiroPernoite[1];
					 
					 $count = count($roteirosRestantes);
					
					 //$meiaDiaria = $horasMissao > 8 ? 0.5:0.0;
					 
					 $saidaPernoite = $this->calcularDiariasTrecho($dataIda,$dataRetorno, $usuario, $cidade,$roteiroPernoite[0]->getAdicionalDeslocamento(), $meia=0.5, $datasIguais=0);
					 
					 
					 $roteiroPernoite[0]->setQuantidadeDiarias($saidaPernoite[1]);
					 $roteiroPernoite[0]->setValorDiaria($saidaPernoite[0]);
							
					 $emRoteiro->flush();
					
					 if($count > 0){
						 
							 $cidade = $roteirosRestantes->getGeografiaCidade()->getDiaria();
					 
							 $dataIda = $roteirosRestantes->getDataInicio()->format('Y-m-d');
							
							 $dataRetorno = $roteirosRestantes->getDateTermino()->format('Y-m-d');
						 
						  $saidaPernoite = $this->calcularDiariasTrecho($dataIda,$dataRetorno, $usuario, $cidade,$roteirosRestantes->getAdicionalDeslocamento(), $meia=0.0, $datasIguais=0);
						 
						  $roteirosRestantes->setQuantidadeDiarias($saidaPernoite[1]);
						  $roteirosRestantes->setValorDiaria($saidaPernoite[0]);
								
						  $emRoteiro->flush();
						 
					 }
					
					 $object->setObservacoes('roteiro:'.$saidaPernoite[0].' - percentual cidade: '.$saidaPernoite[1]);
			 
		 }
		 
		 $quantidade__diarias =0;
		 $custo__estimado = 0;
				foreach ($object->getRoteiro() as $roteiro) {

						$quantidade__diarias += $roteiro->getQuantidadeDiarias();
						$custo__estimado += $roteiro->getValorDiaria();


					}
      
			$object->setDiariasCompletas($quantidade__diarias-0.5);
			
            //$custo_total = $custoDiariasRoteiro - $totalDescontos;

            $object->setTotalDiarias($quantidade__diarias);

            $object->setCustoEstimado($custo__estimado);

            $object->setQuantidadeDiarias($quantidade__diarias);
	  
         $status_os = $object->getStatusOs();


		

        $emNaturezaDespesa = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbNaturezaDespesa');

        //$repositoryNatureza = $emNaturezaDespesa->getRepository('AppBundle\Entity\TbNaturezaDespesa');


        $valorSaldoNatureza = 0;

        //  $totalDespesaPassagens = 0;


        
        
       
        
        $em = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaOs');

        $repository = $em->getRepository('AppBundle\Entity\TbMovimentacaoDespesaOs');

        $movimentacao = $repository->findBy(
            array('ordemServico' => $object->getId())
        );

        if(!$movimentacao) {

            if($status_os=='PROCESSADA') {


            $repositoryOs = $emOs->getRepository('AppBundle\Entity\TbOrdemServico');


            $query = $repositoryOs->createQueryBuilder('os')
            ->innerJoin(' os.setorId', 'setor')
            ->innerJoin('setor.tbDivisao', 'divisao')
            ->innerJoin('divisao.unidade', 'u')
            ->where('setor.id = :setor')    
            ->setParameter('setor', $object->getSetorId())
            ->getQuery();
            

            $OsPorSetor = $query->getResult();
            



            $unidadeOs = $OsPorSetor[0]->getOmPagadora()->getId();
            

            
            
            $numeroOs = $object->getNumeroOrdemServico();
            

            
            $arrayNumeroOs = explode('/', $numeroOs);
            

            
            $anoOrdemServico = $arrayNumeroOs[2];
            




                $this->objReg = new DespesaOs();
                
                $this->objReg->setTipoOperacao('DEBITO');
                
                $this->objReg->setValorDespesa($object->getCustoEstimado());

                $this->objReg->setNaturezaDespesaId($object->getTbTaxonomiaNaturezaDespesa()->getId());

                $this->objReg->setNaturezaMissao($object->getNaturezaMissao()->getId());

                $this->objReg->setOrdemServico($object);

                $this->objReg->setUnidade($unidadeOs);

                $this->objReg->setExercicio($anoOrdemServico);

                $em->persist($this->objReg);
                

                $em->flush();


            } 

        }
                else{
                    
                    
                        
                    foreach ($movimentacao as $despesa) {
                        
                        
                        if($status_os=='PROCESSADA') {

                    
                        $despesa->setValorDespesa($object->getCustoEstimado());
                        $despesa->setNaturezaMissao($object->getNaturezaMissao()->getId());
						$despesa->setUnidade($unidade);                        
                        
                            $em->flush();
                        }
                        else if($status_os =='CANCELADA'){
                            $despesa->setValorDespesa(0.00);
                            $despesa->setNaturezaMissao($object->getNaturezaMissao()->getId());

                            $em->flush();
                        }
                    }
                }
                    
        
        
        //fim pre-update
    }


		public function calcularAuxilio($idUsuario, $diasUteis, $descontoAuxilio){
			
			    $emUser = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbUsuario');

				$repositoryUser = $emUser->getRepository('AppBundle\Entity\TbUsuario');

				$objUsuario = $repositoryUser->findBy(
					array('id' => $idUsuario)
				);
				$diarioAlimentacao = 0;
				
				$diarioTransporte = 0;
				
				foreach($objUsuario as $user){
				
				$valorMensalAlimentacaoUsuario = $user->getAuxilioAlimentacao();
				
				$valorMensalTransporteUsuario = $user->getAuxilioTransporte();
				
				$diarioAlimentacao = $valorMensalAlimentacaoUsuario/22;
				
				$diarioTransporte = $valorMensalTransporteUsuario/22;
				
				$diasUteisAlimentacao = $diasUteis-$descontoAuxilio;
				
				$diasUteisTransporte = $diasUteis-$descontoAuxilio;
				
				$valorAlimentacaoRoteiro = $diarioAlimentacao * $diasUteis;
				
				$valorTransporteRoteiro = $diarioTransporte * $diasUteisTransporte;
				
				
				}
				
				return array($valorAlimentacaoRoteiro, $valorTransporteRoteiro,$diasUteisAlimentacao, $diasUteis);
		}
		
		
		public function getRoteirosComPernoite($idOs){
			
				$emRoteiro = $this->getModelManager()->getEntityManager('AppBundle\Entity\RoteiroMissao');

				$repositoryRoteiro = $emRoteiro->getRepository('AppBundle\Entity\RoteiroMissao');
				
				
				 $queryRot = $repositoryRoteiro->createQueryBuilder('rot')
				 ->where('rot.ordemServico = :osId and rot.pernoite = :pernoite order by rot.id DESC')
				 ->setParameter('osId', $idOs)
				 ->setParameter('pernoite', 1)
				 ->getQuery();

				$roteirosComPernoite = $queryRot->getResult();

				//demais roteiros
				$queryRot2 = $repositoryRoteiro->createQueryBuilder('rot')
				 ->where('rot.ordemServico = :osId and rot.id != :id order by rot.id DESC')
				 ->setParameter('osId', $idOs)
				 ->setParameter('id', $roteirosComPernoite[0]->getId())
				 ->getQuery();

				$demaisRoteiros = $queryRot2->getResult();				
				
				return array($roteirosComPernoite[0], $demaisRoteiros[0]);
	
		}
		
		
		public function getRoteirosSemPernoite($idOs){
			
				$emRoteiro = $this->getModelManager()->getEntityManager('AppBundle\Entity\RoteiroMissao');

				$repositoryRoteiro = $emRoteiro->getRepository('AppBundle\Entity\RoteiroMissao');
				
				
				 $queryRot = $repositoryRoteiro->createQueryBuilder('rot')
				 ->where('rot.ordemServico != :osId order by rot.id DESC')
				 ->setParameter('osId', $idOs)
				 ->setParameter('pernoite', 1)
				

				 ->getQuery();
				
				
		
				$roteiros = $queryRot->getResult();      
				
				if(count($roteiros) > 0){
					
					foreach($roteiros[0] as $roteiro){
						//$dataIda,  $dataRetorno, $usuario, $cidade, $deslocamento, $meia, $datasIguais,  $horasRoteiro
				
						return $this->calcularDiariasTrecho($roteiro->getDataIda(), $roteiro->getDateTermino(), 0, $usuario, $roteiro->getGeografiaCidade()->getDiaria(), $roteiro->getAdicionalDeslocamento(), $meiaDiaria, $datasIguais,  $horasRoteiro);
					}
					
					
				}else{
					return 0;
				}	
		
			
		}
		
		
		public function getRoteirosIguais($idOs){
			
			$emRoteiro = $this->getModelManager()->getEntityManager('AppBundle\Entity\RoteiroMissao');

            $repositoryRoteiro = $emRoteiro->getRepository('AppBundle\Entity\RoteiroMissao');
			
			
			 $queryRot = $repositoryRoteiro->createQueryBuilder('rot')
			
					->select('rot.id,rot.dataInicio as dataInicio, count(rot.id) as counter')
					->groupby('rot.dataInicio')
					->having('count(rot.id) > 1')
					->where('rot.ordemServico = :osId')
					->setParameter('osId', $idOs)

					->getQuery();
	
				$roteiros = $queryRot->getResult(); 

						
			
			if(count($roteiros) >= 1){
					
					
					
					$emRoteiro = $this->getModelManager()->getEntityManager('AppBundle\Entity\RoteiroMissao');

						$repositoryRoteiro = $emRoteiro->getRepository('AppBundle\Entity\RoteiroMissao');
						
						
						 $queryRot1 = $repositoryRoteiro->createQueryBuilder('rot')
						
								->where('rot.ordemServico = :osId')
								->setParameter('osId', $idOs)

								->getQuery();
				
							$roteiros1 = $queryRot1->getResult();
					
					$arrayDataInicio = $this->pesquisarDatasIdasIguais($roteiros1[0]->getDataInicio(), $idOs);
					$arrayDataRetorno = $this->pesquisarDatasVoltasIguais($dataInicio, $idOs);
			
				
						$maiorCidadePercent = 0;
						
						if(count($arrayDataInicio) == count($arrayDataRetorno)){
							
							//roteiros na mesma data.
							
							$maiorCidadePercent = max($arrayDataInicio);
							
						}
				
							return $maiorCidadePercent;
					}
					else{
						
							return 0;
					}
			
		
			
		}
		
		public function pesquisarDatasIguais($dataIda,$idOs){
			
			$emRoteiro = $this->getModelManager()->getEntityManager('AppBundle\Entity\RoteiroMissao');

            $repositoryRoteiro = $emRoteiro->getRepository('AppBundle\Entity\RoteiroMissao');
			
			
			 $queryRot = $repositoryRoteiro->createQueryBuilder('rot')
			
             ->where('rot.ordemServico = :osId and rot.dataInicio = :dataIda and rot.dateTermino = :dataIda')
			 
             ->setParameter('osId', $idOs)
			 ->setParameter('dataIda', $dataIda)

             ->getQuery();
			 
				$roteirosId = $queryRot->getResult(); 
				$diff = 0;
				
				foreach($roteirosId as $roteiro){
					
					$arrCidade[] = $roteiro->getGeografiaCidade()->getDiaria();
					
					$arrDataIda[] = $roteiro->getDataInicio()->format('Y-m-d');
					
					$arrDataVolta[] = $roteiro->getDateTermino()->format('Y-m-d');
					
					$arrayIdRotas = array(
						'id' => $roteiro->getId(),
						'cidade' => $roteiro->getGeografiaCidade()->getDiaria(),
						'deslocamento' => $roteiro->getAdicionalDeslocamento()
					);
					
										
					 $hora1 = explode(':',$roteiro->getHoraInicio());
					 $hora2 = explode(':',$roteiro->getHoraFinal());
					 
					 $diff += $hora2[0]-$hora1[0];
										
					
				}
					
					if(count($roteirosId) > 0){
						
							$maiorCidade = max($arrCidade);
							
							
							 $queryRot2 = $repositoryRoteiro->createQueryBuilder('rot')
							 ->innerJoin('rot.geografiaCidade', 'cidade')
							 ->where('rot.ordemServico = :osId and cidade.diaria = :diaria')
							 
							 ->setParameter('osId', $idOs)
							 ->setParameter('diaria', $maiorCidade)

							 ->getQuery();	

							 $roteiroMaior = $queryRot2->getResult();
							 
							 
							  $queryRot3 = $repositoryRoteiro->createQueryBuilder('rot')
							 ->where('rot.ordemServico = :osId and rot.id != :rotMaior')
							 
							 ->setParameter('osId', $idOs)
							 ->setParameter('rotMaior', $roteiroMaior[0]->getId())
							 ->getQuery();	
							 
							  $demaisRoteirosIguais = $queryRot3->getResult();
							  
							  return array(count($roteirosId),$diff, $maiorCidade, $arrDataIda[0],$arrDataVolta[0], $roteiroMaior[0],  $demaisRoteirosIguais);
					
					
					}
							
					
							
			
					
		}
		
		
		public function pesquisarDatasIdasIguais($dataIda,$idOs){
			
			$emRoteiro = $this->getModelManager()->getEntityManager('AppBundle\Entity\RoteiroMissao');

            $repositoryRoteiro = $emRoteiro->getRepository('AppBundle\Entity\RoteiroMissao');
			
			
			 $queryRot = $repositoryRoteiro->createQueryBuilder('rot')
			
             ->where('rot.ordemServico = :osId and rot.dataInicio = :dataIda ')
			 
             ->setParameter('osId', $idOs)
			 ->setParameter('dataIda', $dataIda)

             ->getQuery();
			 
			 $roteirosId = $queryRot->getResult(); 
			
				foreach($roteirosId[0] as $rotas){
					
					
					$arrayIdRotas = array(
						'cidade' => $rotas->getGeografiaCidade->getDiaria()
					);
				}
				
				return $arrayIdRotas;
			
		}
		
		
		public function pesquisarDatasVoltasIguais($dataFim, $idOs){
			
			$emRoteiro = $this->getModelManager()->getEntityManager('AppBundle\Entity\RoteiroMissao');

            $repositoryRoteiro = $emRoteiro->getRepository('AppBundle\Entity\RoteiroMissao');
			
			
			 $queryRot = $repositoryRoteiro->createQueryBuilder('rot')
			
             ->where('rot.ordemServico = :osId and rot.dateTermino = :dataFim')
			 
             ->setParameter('osId', $idOs)
			 ->setParameter('dataFim', $dataFim)

             ->getQuery();
			 
			 $roteirosId = $queryRot->getResult(); 
			
				foreach($roteirosId[0] as $rotas){
					$arrayIdRotas = array(
						'id' => $rotas->getId(),
						'cidade' => $rotas->getGeografiaCidade->getDiaria()
					);
				}
				
				return $arrayIdRotas;
			
		}
		
	public function array_not_unique($raw_array) {
				$dupes = array();
				natcasesort($raw_array);
				reset ($raw_array);

				$old_key    = NULL;
				$old_value    = NULL;
				foreach ($raw_array as $key => $value) {
					if ($value === NULL) { continue; }
					if ($old_value == $value) {
						$dupes[$old_key]    = $old_value;
						$dupes[$key]        = $value;
					}
					$old_value    = $value;
					$old_key    = $key;
				}
			return $dupes;
			}

    public function postUpdate($object)
    {

        $emPassagem = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

        $emNaturezaDespesa = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbNaturezaDespesa');

        $repositoryNatureza = $emNaturezaDespesa->getRepository('AppBundle\Entity\TbNaturezaDespesa');

        $repositoryPassagem = $emPassagem->getRepository('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

        $em = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaOs');

        $repository = $em->getRepository('AppBundle\Entity\TbMovimentacaoDespesaOs');

        /*
        $totalDespesaMilitar = 0;

        $totalDespesaCivil = 0;

        $valorSaldoNatureza = 0;

        $totalDespesaPassagens = 0;

        $somaDespesaCivilInv = 0;

        $somaDespesaCivilPrev = 0;

        $somaDespesaCivilAdm = 0;

        $somaDespesaCivilCap = 0;

        $somaDespesaCivilOperacional = 0;

        $somaDespesaCivilRep = 0;


        $somaDespesaCivilOutros = 0;


        $somaDespesaMilitarInv = 0;

        $somaDespesaMilitarPrev = 0;

        $somaDespesaMilitarAdm = 0;

        $somaDespesaMilitarCap = 0;

        $somaDespesaMilitarOperacional = 0;

        $somaDespesaMilitarRep = 0;

        $somaDespesaMilitarOutros = 0;



        $despesasOsCivil = $repository->findBy(array('naturezaDespesaId' => 1));

        $despesasOsMilitar = $repository->findBy(array('naturezaDespesaId' => 2));


         Natureza despesa
         1 => diária civil
         2 => diária militar
         3 => passagem aérea

         natureza missão
         1 => Investigacao
         2 => Prevenção
         3 => Administrativo
         4 => Capacitação
         5 => Operacional - Tripulante
         6 => Representação
         7 => Outros


        unidade

        1 => Cenipa
        2 => Seripa 1
        3 => Seripa 2
        4 => Seripa 3
        5 => Seripa 4
        6 => Seripa 5
        7 => Seripa 6
        8 => Seripa 7

        */

				$anoExercicio = date('Y');
				
				$unidadeDespesa = $object->getOmPagadora()->getId();

				
				if($unidadeDespesa != 9){
				//$unidade, $naturezaDespesa, $ano
				//função que retorna a soma de despesas por unidade e natureza de despesa
				//as soma de despesas 'civil' do Seripa4
				$totalDespesaCivil = $this->totalDespesaUnidade($unidadeDespesa, 1, $anoExercicio);

				//soma de despesas 'militar' do Seripa4
				$totalDespesaMilitar = $this->totalDespesaUnidade($unidadeDespesa, 2, $anoExercicio);

				//soma de passagens Seripa4
				$totalDespesaPassagem = $this->totalDespesaUnidade($unidadeDespesa, 3, $anoExercicio);


		


        //pegar a natureza de despesa do Seripa4 para o exercício do ano atual
        //tbNaturezaDespesa.tb_orcamento_id.exercicio.unidade = seripa4
                                                                        //($naturezaDespesaId, $unidade, $ano)
				$this->calculoPorNaturezaUnidade(1, $unidadeDespesa, $anoExercicio, $totalDespesaCivil);


				$this->calculoPorNaturezaUnidade(2, $unidadeDespesa, $anoExercicio, $totalDespesaMilitar);


				$this->calculoPorNaturezaUnidade(3, $unidadeDespesa, $anoExercicio, $totalDespesaPassagem);
				
				$somaCustoDiarias = $totalDespesaCivil+$totalDespesaMilitar;
								
				
				
				$this->recalcularOrcamento($unidadeDespesa, $anoExercicio, $somaCustoDiarias, $totalDespesaPassagem);

		}

    }
	
	/*
		public function calculoOrcamento($unidade, $exercicio, $custoDiaria,  $custoPassagem){
			
		   $emOrcamento = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbOrcamento');

		   $repositoryOrcamento = $emOrcamento->getRepository('AppBundle\Entity\TbOrcamento');
		   
		   $orcamento = $repositoryOrcamento->findBy(
                array('tbUnidade' => $unidade, 'exercicio' => $ano)
            );
			
			foreach($orcamento as $orcamentoUnidade){
				
					
						
						$totalRecursoDiarias = $orcamentoUnidade->getDiarias();
											
						$recursoDiariasDescentralizado = $orcamentoUnidade->getDiariaDescentralizada();
						
						$saldoRecursoDiarias = $totalRecursoDiarias - $custoDiaria;
						
						$orcamentoUnidade->setCustoDiarias($custoDiaria);
						
						$orcamentoUnidade->setSaldoDiarias($saldoRecursoDiarias);
						
						
						//passagem
						$totalRecursoPassagem = $orcamentoUnidade->getPassagem();
											
						$recursoPassagemDescentralizado = $orcamentoUnidade->getPassagemDescentralizada();
						
						$saldoRecursoPassagem = $totalRecursoPassagem - $custoPassagem;
						
						$orcamentoUnidade->setCustoPassagem($custoPassagem);
						
						$orcamentoUnidade->setSaldoPassagem($saldoRecursoPassagem);
						
						$emOrcamento->flush();
						
					
										
					
					
				}
				
		}*/
		
	


    public function calculoPorNaturezaUnidade($naturezaDespesaId, $unidade, $ano, $totalDespesa){

         $emNaturezaDespesa = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbNaturezaDespesa');

         $repositoryNatureza = $emNaturezaDespesa->getRepository('AppBundle\Entity\TbNaturezaDespesa');


          $query = $repositoryNatureza->createQueryBuilder('natureza')
            ->innerJoin(' natureza.tbOrcamento', 'o')
            ->innerJoin('natureza.tbTaxonomiaNaturezaDespesa', 'taxonomia')
            ->innerJoin('o.tbUnidade', 'u')
            ->where('taxonomia.id = :naturezaDespesaId')
            ->andWhere('u.id = :unidade')
            ->andWhere('o.exercicio = :ano')
            ->setParameter('naturezaDespesaId', $naturezaDespesaId)
            ->setParameter('unidade', $unidade)
            ->setParameter('ano', $ano)
            ->getQuery();
            
           $naturezaDespesa = $query->getResult();

           $valorDescentralizado = $naturezaDespesa[0]->getValorDescentralizado();

           $saldoNatureza = $valorDescentralizado - $totalDespesa;

           $naturezaDespesa[0]->setSubTotal($saldoNatureza);

           $emNaturezaDespesa->flush();
		   
		   //adicionar calculo no orçamento
		   
		   
		   

    }
	
	
	public function recalcularOrcamento($unidade, $ano, $custoDiaria, $custoPassagem){

         $emOrcamento = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbOrcamento');

         $repositoryOrcamento = $emOrcamento->getRepository('AppBundle\Entity\TbOrcamento');


          $query = $repositoryOrcamento->createQueryBuilder('o')
           
            ->innerJoin('o.tbUnidade', 'u')
            ->andWhere('u.id = :unidade')
            ->andWhere('o.exercicio = :ano')
            ->setParameter('unidade', $unidade)
            ->setParameter('ano', $ano)
            ->getQuery();
            
           $orcamento = $query->getResult();

						$saldoRecursoDiarias = 0.00;
						
						$saldoRecursoPassagem = 0.00;
		   
		   
						$totalRecursoDiarias = $orcamento[0]->getDiarias();
											
						$recursoDiariasDescentralizado = $orcamento[0]->getDiariaDescentralizada();
						
						$saldoRecursoDiarias += $totalRecursoDiarias - $custoDiaria;
						
						$orcamento[0]->setCustoDiarias($custoDiaria);
						
						$orcamento[0]->setSaldoDiarias($saldoRecursoDiarias);
						
						
						//passagem
						$totalRecursoPassagem = $orcamento[0]->getPassagem();
											
						$recursoPassagemDescentralizado = $orcamento[0]->getPassagemDescentralizada();
						
						$saldoRecursoPassagem = $totalRecursoPassagem - $custoPassagem;
						
						$orcamento[0]->setCustoPassagem($custoPassagem);
						
						$orcamento[0]->setSaldoPassagem($saldoRecursoPassagem);
						
						$emOrcamento->flush();

           

    }

    
    

	
	

    public function calculoPorMovimentacaoNaturezaUnidade($naturezaDespesaId, $naturezaMissao, $ano, $unidade){

         $emMovimentacaoDespesaOS = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaOs');

         $repositoryMovimentacaoOS = $emMovimentacaoDespesaOS->getRepository('AppBundle\Entity\TbMovimentacaoDespesaOs');


            $movimentacaoDespesa = $repositoryMovimentacaoOS->findBy(array('naturezaDespesaId' => $naturezaDespesaId, 'naturezaMissao' => $naturezaMissao, 'unidade' => $unidade ));

            
            if(count($movimentacaoDespesa > 0)){
                
                $somaMovimentacao = 0;
                foreach ($movimentacaoDespesa as $movimentacao) {
                # code...
                    
                    $somaMovimentacao += $movimentacao->getValorDespesa();

                }
                
                return $somaMovimentacao;
                
            } else{
                
                return 0;
                
            }
            
    
    }
    
    
    public function totalDespesaUnidade($unidade, $naturezaDespesa, $ano){
			$somaMovimentacaoOs = 0;
			
			$somaMovimentacaoPassagem = 0;
			
			if($naturezaDespesa == 3){

                 $emMovimentacaoDespesaPass = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

                 $repositoryMovimentacaoPass = $emMovimentacaoDespesaPass->getRepository('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

                 $movimentacaoDespesa = $repositoryMovimentacaoPass->findBy(array('naturezaDespesa' => $naturezaDespesa, 'exercicio' => $ano, 'unidade' =>$unidade));
                    
            
                    
                    if(count($movimentacaoDespesa > 0)){
                        
                      
                        foreach ($movimentacaoDespesa as $movimentacao) {
                        # code...
                            
                            $somaMovimentacaoPassagem += $movimentacao->getValorDespesa();

                        }
                        
                        return $somaMovimentacaoPassagem;
                        
                    } else{
                        
                        return 0;
                        
                    }


                } else {

                 $emMovimentacaoDespesaOS = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaOs');

                 $repositoryMovimentacaoOS = $emMovimentacaoDespesaOS->getRepository('AppBundle\Entity\TbMovimentacaoDespesaOs');

                 $movimentacaoDespesaOs = $repositoryMovimentacaoOS->findBy(array('naturezaDespesaId' => $naturezaDespesa, 'exercicio' => $ano, 'unidade' =>$unidade));
                    
            
                    
                    if(count($movimentacaoDespesaOs > 0)){
                        
                        
                        foreach ($movimentacaoDespesaOs as $movimentacao) {
                        # code...
                            
                            $somaMovimentacao += $movimentacao->getValorDespesa();

                        }
                        
                        return $somaMovimentacao;
                        
                    } else{
                        
                        return 0;
                        
                    }

                }
        
         
            
        
    }

     public function controleDiarias($object){

        $emDiariasControle = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbDiariasControle');

        $emOs = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbOrdemServico');

        $repositoryDiarias = $emDiariasControle->getRepository('AppBundle\Entity\TbDiariasControle');

        $quantidadeDiariasOs = $object->getTotalDiarias();

        $status_os = $object->getStatusOs();
		
		$naturezaMissao = $object->getNaturezaMissao()->getId();

        $inicioMissao = $object->getInicioMissao();
		
		$missaoSemCusto = $object->getMissaoCusto();
        
        $usuario = $object->getTbUsuario()->getId();
            //obter todas despesas da tabela movimentacao para debitar do total do orçamento da natureza de despesa
            // $objPassagens = $repositoryPassagem->findAll();


                $repositoryOs = $emOs->getRepository('AppBundle\Entity\TbOrdemServico');


                $query = $repositoryOs->createQueryBuilder('os')
                ->innerJoin(' os.setorId', 'setor')
                ->innerJoin('setor.tbDivisao', 'divisao')
                ->innerJoin('divisao.unidade', 'u')
                ->where('setor.id = :setor')    
                ->setParameter('setor', $object->getSetorId())
                ->getQuery();
                
                $OsPorSetor = $query->getResult();


                $unidadeOs = $OsPorSetor[0]->getSetorId()->getTbDivisao()->getUnidade()->getId();
                
                
                $numeroOs = $object->getNumeroOrdemServico();
                
                $arrayNumeroOs = explode('/', $numeroOs);
                
                $anoOrdemServico = $arrayNumeroOs[2];


                 $movimentacaoDiarias = $repositoryDiarias->findBy(
                    array('tbUsuario' => $usuario, 'tbOrdemServico' => $object->getId(), 'exercicio' => $anoOrdemServico)
                 );
                    
                if(count($movimentacaoDiarias)>0){
					
							if($statusOs=='CANCELADA' || $missaoSemCusto == 1){
								
									 $object->setCustoEstimado(0.00);
									 
									 $emOs->flush();
										
									 $movimentacaoDiarias[0]->setQuantidade(0.0);
									 
									 $emDiariasControle->flush();

									 $this->verificaTotalDiarias($object->getTbUsuario(), $anoOrdemServico);
								
							}else{
								
							 $movimentacaoDiarias[0]->setQuantidade($quantidadeDiariasOs);

                             $movimentacaoDiarias[0]->setExercicio($anoOrdemServico);
                             
                             $emDiariasControle->flush();

                             $this->verificaTotalDiarias($object->getTbUsuario(), $anoOrdemServico);
							}

			                



                }else{

								$diarias = new DiariasControle();
								$diarias->setQuantidade($quantidadeDiariasOs);
								$diarias->setTbOrdemServico($object);
								$diarias->setTbUsuario($object->getTbUsuario());
								$diarias->setExercicio($anoOrdemServico);
								$emDiariasControle->persist($diarias);                   
								$emDiariasControle->flush();
								$this->verificaTotalDiarias($object->getTbUsuario(), $anoOrdemServico);
									 

                        } 





                 
    }

    public function verificaTotalDiarias($usuario, $ano){

                $emDiariasControle = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbDiariasControle');

                $repositoryDiarias = $emDiariasControle->getRepository('AppBundle\Entity\TbDiariasControle');

                $emUsuario = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbUsuario');

                $repositoryUser = $emUsuario->getRepository('AppBundle\Entity\TbUsuario');
                 
                $usuario = $repositoryUser->find($usuario);
                
                $totalRegistroDiarias = $repositoryDiarias->findBy(
                    array('tbUsuario' => $usuario, 'exercicio' => $ano)
                 );
                $somaDiarias = 0;
                foreach ($totalRegistroDiarias as $diarias) {
                    $somaDiarias += $diarias->getQuantidade();
                }

                    $usuario->setTotalAno($somaDiarias);

                    $emUsuario->flush();
                    
                  if($somaDiarias > 40){

                        
                        $usuario->setDiariasExcedidas(1);
            
                        $emUsuario->flush();
                  }



    }



    public function salvarCalculoMovimentacao($naturezaDespesa, $totalDespesa, $exercicio, $naturezaMissao, $unidade){
        
        


                $emCalculo = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbCalculoDespesaOs');

                $repositoryCalculo = $emCalculo->getRepository('AppBundle\Entity\TbCalculoDespesaOs');

                    
                    
                $movimentacaoCalculo = $repositoryCalculo->findBy(array('naturezaDespesa' => $naturezaDespesa, 'naturezaMissao' => $naturezaMissao, 'exercicio' => $exercicio, 'unidade' => $unidade ));
                

                    if(count($movimentacaoCalculo) > 0){
                        foreach($movimentacaoCalculo as $movimento){
                        
                        
                             $movimento->setNaturezaDespesa($naturezaDespesa);
                             $movimento->setTotalDepesaMissao($totalDespesa);
                             $movimento->setExercicio($exercicio);
                             $movimento->setNaturezaMissao($naturezaMissao);
                             $movimento->setUnidade($unidade);
                 
                             $emCalculo->flush();
                     
                        }
                        
                    } else {
                        
                              $objCalculo = new CalculoDespesaOs();
                              $objCalculo->setNaturezaDespesa($naturezaDespesa);
                              $objCalculo->setTotalDepesaMissao($totalDespesa);
                              $objCalculo->setExercicio($exercicio);
                              $objCalculo->setNaturezaMissao($naturezaMissao);
                              $objCalculo->setUnidade($unidade);
                        
                              $emCalculo->persist($objCalculo);
            
                    }
   

    }
     public function calcularDiariasTrecho($dataIda,  $dataRetorno, $usuario, $cidade, $deslocamento, $meia, $datasIguais){
        
		//$datasIguais, $maiorCidade, $horasRoteiro
		
        $usu = $usuario;

        $valorDiariaNormalUsuario = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getDiariaNormal();

        $valorDiariaUsuarioNoventa = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getNoventa();

        $valorDiariaUsuarioOitenta = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getOitenta();

        $valorDiariaUsuarioSetenta = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getSetenta();

        $valorDiariaUsuarioCinquenta = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getCinquenta();


		$controller = new GestorController(); 
					

       

       // $ci = $this->getCidade($cidade);


    
        //Calculo da quantidade de dias 
        $dia1=strtotime( $dataIda );
        $dia2=strtotime( $dataRetorno );
        $quantidade_dias = ( $dia2 - $dia1 ) / 86400;
        
        
        $adicional_deslocamento = ($deslocamento==1) ? 95.00 : 0;

        $tipo_diaria = $cidade;  //pega o campo referente ࡣidade.

        $usuarioDiaria = 0;

        switch ($tipo_diaria) {
            case 50:
                $usuarioDiaria = $valorDiariaUsuarioCinquenta;

                break;
             case 70:
                $usuarioDiaria = $valorDiariaUsuarioSetenta;

                break;
             case 80:
                $usuarioDiaria = $valorDiariaUsuarioOitenta;

                break;
             case 90:
                $usuarioDiaria = $valorDiariaUsuarioNoventa;

                break;    
            
            default:
                # code...
                break;
        }

        
        $usu_tipo_diaria_meia = $usuarioDiaria * $meia;

		$somaDiarias = $quantidade_dias+$meia;
		
		
        
        $valor_diaria_total = ($usuarioDiaria * $somaDiarias) + $adicional_deslocamento ; // multiplica o valor do dia pela quantidade de dias mais meia.   
		
        //Se a missão for realizada no mesmo dia, verifica se será pago meia diária.
       
        if($datasIguais==1){
			            return array($usu_tipo_diaria_meia+$adicional_deslocamento,$somaDiarias,$adicional_deslocamento);

			
		}else{
			            return array($valor_diaria_total,$somaDiarias,$adicional_deslocamento);

		}
        
        
            
    
    }

   public function getUser($id){
         
        $os = $this->getDoctrine()
        ->getRepository(Usuario::class);
       
        
       
            $query = $os->createQueryBuilder('us')
            ->innerJoin('us.tbPostoGraduacao', 'posto')
            ->innerJoin('posto.ciruculoHierarquico')
            ->where('us.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
            
            return $query->getResult(); 
            
    }


     public function getCidade($id){
         
        $os = $this->getDoctrine()
        ->getRepository(Cidade::class);
              
        
            $query = $os->createQueryBuilder('cidade')
            ->where('cidade.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
            
            return $query->getResult(); 
            
    }


    function TipoDiaria($diaria){
        switch ($diaria){
            case 50:
                return 'getCinquenta()';
            break;        
            case 70:
                return 'getSetenta()';
            break;
            case 80:
                return 'getOitenta()';
            break;
            case 90:
                return 'getNoventa()';
            break;
        }
    }


    

   

    }