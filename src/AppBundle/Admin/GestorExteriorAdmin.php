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




class GestorExteriorAdmin extends AbstractAdmin{
    //put your code here
    // protected $emName = 'unidade';
    use AdminExtraExportTrait;

    protected $baseRouteName = 'os_cenipa_exterior';
    protected $baseRoutePattern = 'page-gestor-exterior-cenipa';
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
        $collection->add('fpp', $this->getRouterIdParameter().'/fpp');
		$collection->add('fpm', $this->getRouterIdParameter().'/fpm');
		$collection->add('rfm', $this->getRouterIdParameter().'/rfm');
		$collection->add('firpaext', $this->getRouterIdParameter().'/firpaext');




    }

    public function getExportFiels(){
        return array('numeroOrdemServico', 'inicioMissao');
    }



    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);




        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();




        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0]. '.tipoMissao !', ':my_param2')

        );
        $query->setParameter('my_param2', 'NACIONAL');



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
			
			->add('missaoCusto', null, array(
							'label' => 'Missão sem custo?'
						))
						
			->add('missaoPagaOutraOm', null, array(
							'label' => 'Custeada por outra OM?'
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
            ->add('numeroOrdemServico', null, array(
                    'label' => 'Número OS',
                    'read_only' => false,
                    'disabled' => false
                )
            )
            ->add('tbUsuario')
			
			->add('setorId', 'sonata_type_model_hidden')

 
            ->add('descricaoMissao', null, array(
                    'label' => 'Descrição da missão:',
                    'read_only' => false,
                    'disabled' => false
                )
            )

       
            ->add('observacoes', null, array(
                'label' => 'Observações:'
            ))
														
				
            ->add('totalDiarias')

            ->add('custoEstimado', 'money', array(
				'label' => 'Custo estimado em reais:',
                'currency' => 'BRL',
                'grouping' =>true))
				
				
				
				
		
           
            ->add('justificativaAntecipacao', null, array(
                'label' => 'Justificativa:'
            ))

            ->add('naturezaMissao', null, array(
                'label' => 'Natureza da Missão:'
            ))
            ->add('tbTaxonomiaNaturezaDespesa', null, array(
                'label' => 'Natureza de Despesa:'
            ))
			
			->add('omPagadora', null, array(
                'label' => 'OM pagadora:'
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
                    'CONFIRMADA' => 'ORDEM DE SERVIÇO CONFIRMADA PELO SETOR REQUISITANTE',
                    'AUTORIZADA' => 'ORDEM DE SERVIÇO AUTORIZADA PELO CH/VCH DO CENIPA',
                    'EM PROCESSAMENTO' => 'ORDEM DE SERVIÇO EM PROCESSAMENTO',
                    'PROCESSADA' => 'ORDEM DE SERVIÇO PROCESSADA E ENCAMINHADA PARA PAGAMENTO',
					'CANCELADA' => 'CANCELAR ORDEM DE SERVIÇO',
					'NAO AUTORIZADA' => 'O.S NAO AUTORIZADA PELO ORDENADOR DE DESPESAS'




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

                    '0' => 'CANCELAR EMISSÃO DE PASSAGEM',
                    '1' => 'SOLICITADA EMISSÃO DE PASSAGEM',
                    '3' => 'EMISSÃO DE PASSAGEM AUTORIZADA PELO ORDENADOR DE DESPESAS',
                    '4' => 'PASSAGEM EM EMISSÃO JUNTO À EMPRESA CONTRATADA',
                    '5' => 'PASSAGEM EMITIDA AO MILITAR/CIVIL'



                ),
                'label' => 'Definir status da Passagem Aérea',
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

            ->add('roteiroExterior', 'sonata_type_collection',
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

            ->add('aeroportoExt', 'sonata_type_collection',
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

            ->add('roteiroExterior',null, array('associated_tostring' => 'getSaida'))
            ->add('naturezaMissao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_missao.html.twig', 'label' => 'Tipo de missão'))
            ->add('tbNaturezaDespesa', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_natureza_ext.html.twig', 'label' => 'Custo e natureza de despesa'))

            ->add('statusOs', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_status_os.html.twig', 'label' => 'Status'))
			->add('statusPassagem', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_status_passagem.html.twig', 'label' => 'Status da passagem'))
			
			
            ->add('_action', 'actions', array(
                'actions' => array(

                    'edit' => array(),
                    'delete' => array(),

                    'Gerar FPP' => array('template' => 'button_fpp.html.twig'),
                    'Gerar FPM' => array('template' => 'button_fpm.html.twig'),
                    'Gerar RFM' => array('template' => 'button_rfm.html.twig'),
					'Gerar FIRPA' => array('template' => 'button_firpa_ext.html.twig'),



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

        $exercicio = date('Y');
		
		
			$emSetor = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbSetorDivisao');

            $repositorySetor = $emSetor->getRepository('AppBundle\Entity\TbSetorDivisao');

            $movimentacaoSetor = $repositorySetor->findBy(
                array('id' => $object->getTbUsuario()->getSetorDivisao()->getId())
            );
			
			foreach($movimentacaoSetor as $setor){
				
				$object->setSetorId($setor);
			}

        $unidade = $object->getOmPagadora()->getId();
		
		

		

				  foreach ($object->getAeroporto() as $aeroporto) {

						$aeroporto->setOrdemServico($object);



					}


					foreach ($object->getRoteiroExterior() as $roteiro) {

						$roteiro->setOrdemServico($object);


					}
				
				//$percentual = array(50,70,80)
				
				//max(percentual) // 80

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

		
         $totalDiariasRoteiro = 0.00;

        $custoDiariasRoteiro = 0.00;
		
		$custoEstimaDolarRoteiro = 0.00;
		
		$quantidadeDiarias = 0.5;
        
		$qntRoteiros = count($object->getRoteiroExterior());
		
		$i = 1;
		
		$horasRoteiro = 0;
		
		$idUser = $object->getTbUsuario()->getId();
		
		$controller = new GestorController();
        
		$desconto = 0;
		
		$voltaPeriodo = '';
		
		$idaPeriodo = '';
		
		$horaInicioPeriodo = 0;
		
		$horaTerminoPeriodo = 0;
		
			
		
        foreach ($object->getRoteiroExterior() as $roteiro) {
			
			$dataInicio = $roteiro->getDataInicio();

            $dataTermino = $roteiro->getDateTermino();

            $horaInicio = $roteiro->getHoraInicio();

            $horaFimRot = $roteiro->getHoraFinal();
			
			$idaTrecho[] = array_push(strtotime($dataInicio));
			
            $voltaTrecho[] = array_push(strtotime($dataTermino));
			
			//$percentualCidade[] = array_push($roteiro->getGeografiaCidade()->getDiaria());
			
			$grupoPais = $roteiro->getPaisMissao()->getGrupo();
			
			$horaInicial = explode( ':', $horaInicio );
			
			$horaFinal = explode( ':', $horaFimRot );

			$horaIni = mktime( $horaInicial[0], $horaInicial[1]);
			
			$horaFim = mktime( $horaFinal [0], $horaFinal [1]);
			
			$diasTransitoIda = $roteiro->getDiasTransitoIda();
			
			$diasTransitoVolta = $roteiro->getDiasTransitoVolta();

            $usuario = $object->getTbUsuario();

            $dataInicio = $dataInicio->format('Y-m-d');

            $dataTermino = $dataTermino->format('Y-m-d');
			
				
			
			if($i == $qntRoteiros){
				
				$voltaPeriodo = $dataTermino;
				$horaTerminoPeriodo =  $horaFim;
							
				
					
					
				//$dataIda, $dataRetorno, $usuario, $pais, $diasTransitoIda, $diasTransitoVolta
					
					$diariasRoteiroMissao = $this->calcularDiariasExterior($dataInicio, $dataTermino, $usuario,		
					$grupoPais, $diasTransitoIda, $diasTransitoVolta);
					
					
					
				
				
				
				
				
			}else {
				
					
					$diariasRoteiroMissao = $this->calcularDiariasExterior($dataInicio, $dataTermino, $usuario,		
					$grupoPais, $diasTransitoIda, $diasTransitoVolta);
				
			}

            $diariasRoteiroMissao = $this->calcularDiariasExterior($dataInicio, $dataTermino, $usuario,		
					$grupoPais, $diasTransitoIda, $diasTransitoVolta);
        
            $roteiro->setDateInicioTxt($dataInicio);

            $roteiro->setDataFimTxt($dataTermino);


            $__quantidade_diarias = $diariasRoteiroMissao[1];

            $__total_diarias = $diariasRoteiroMissao[1];

            $__custo_estimado = $diariasRoteiroMissao[0];
			
			$__custo_estimado_dolar = $diariasRoteiroMissao[2];

			
			
								
								$totalDiariasRoteiro +=$__total_diarias;
								
								$quantidadeDiarias =$__quantidade_diarias;
			
                                $custoDiariasRoteiro += $__custo_estimado;
								
								$custoEstimaDolarRoteiro += $__custo_estimado_dolar;

     

                    $roteiro->setValorDiaria($__custo_estimado);
					$roteiro->setQuantidadeDiarias($__quantidade_diarias);
					$roteiro->setValorDiariaDolar($__custo_estimado_dolar);

					
					$i++;
					
					
                    
        }			
					


            $emOs = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbOrdemServico');

			
			$object->setDiariasCompletas($quantidadeDiarias);
			
            $object->setTotalDiarias($totalDiariasRoteiro);

            $object->setCustoEstimado($custoDiariasRoteiro);
			
			$object->custoLiquido($custoEstimaDolarRoteiro);

            $object->setQuantidadeDiarias($quantidadeDiarias);



            $emOs->flush();



    }
    
   public function preUpdate($object) {

        $exercicio = date('Y');

        $unidade = $object->getOmPagadora()->getId();

				

				  foreach ($object->getAeroportoExt() as $aeroporto) {

						$aeroporto->setOrdemServico($object);



					}


					foreach ($object->getRoteiroExterior() as $roteiro) {

						$roteiro->setOrdemServico($object);


					}
				
				//$percentual = array(50,70,80)
				
				//max(percentual) // 80

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

		
        $totalDiariasRoteiro = 0.00;

        $custoDiariasRoteiro = 0.00;
		
		$custoEstimaDolarRoteiro = 0.00;
		
		$quantidadeDiarias = 0.5;
        
		$qntRoteiros = count($object->getRoteiroExterior());
		
		$i = 1;
		
		$horasRoteiro = 0;
		
		$idUser = $object->getTbUsuario()->getId();
		
		$controller = new GestorController();
        
		$desconto = 0;
		
		$voltaPeriodo = '';
		
		$idaPeriodo = '';
		
		$horaInicioPeriodo = 0;
		
		$horaTerminoPeriodo = 0;
		
			
		
        foreach ($object->getRoteiroExterior() as $roteiro) {
			
			$dataInicio = $roteiro->getDataInicio();

            $dataTermino = $roteiro->getDateTermino();

            $horaInicio = $roteiro->getHoraInicio();

            $horaFimRot = $roteiro->getHoraFinal();
			
			$idaTrecho[] = array_push(strtotime($dataInicio));
			
            $voltaTrecho[] = array_push(strtotime($dataTermino));
			
			//$percentualCidade[] = array_push($roteiro->getGeografiaCidade()->getDiaria());
			
			$grupoPais = $roteiro->getPaisMissao()->getGrupo();
			
			$horaInicial = explode( ':', $horaInicio );
			
			$horaFinal = explode( ':', $horaFimRot );

			$horaIni = mktime( $horaInicial[0], $horaInicial[1]);
			
			$horaFim = mktime( $horaFinal [0], $horaFinal [1]);
			
			$diasTransitoIda = $roteiro->getDiasTransitoIda();
			
			$diasTransitoVolta = $roteiro->getDiasTransitoVolta();

            $usuario = $object->getTbUsuario();

            $dataInicio = $dataInicio->format('Y-m-d');

            $dataTermino = $dataTermino->format('Y-m-d');
			
			$cotacaoDolar = $roteiro->getCotacaoDolar();	
			
			if($i == $qntRoteiros){
				
				$voltaPeriodo = $dataTermino;
				$horaTerminoPeriodo =  $horaFim;
							
				
					
					
				//$dataIda, $dataRetorno, $usuario, $grupoPais, $diasTransitoIda, $diasTransitoVolta, $cotacaoDolar					
					$diariasRoteiroMissao = $this->calcularDiariasExterior($dataInicio, $dataTermino, $usuario,		
					$grupoPais, $diasTransitoIda, $diasTransitoVolta, $cotacaoDolar);
					
					
					
				
				
				
				
				
			}else {
				
					
					$diariasRoteiroMissao = $this->calcularDiariasExterior($dataInicio, $dataTermino, $usuario,		
					$grupoPais, $diasTransitoIda, $diasTransitoVolta,$cotacaoDolar);
				
			}

           
        
            $roteiro->setDateInicioTxt($dataInicio);

            $roteiro->setDataFimTxt($dataTermino);


            $__quantidade_diarias = $diariasRoteiroMissao[1];

            $__total_diarias = $diariasRoteiroMissao[1];

            $__custo_estimado = $diariasRoteiroMissao[0];
			
			$__custo_estimado_dolar = $diariasRoteiroMissao[2];

			
			
								
								$totalDiariasRoteiro +=$__total_diarias;
								
								$quantidadeDiarias =$__quantidade_diarias;
			
                                $custoDiariasRoteiro += $__custo_estimado;
								
								$custoEstimaDolarRoteiro += $__custo_estimado_dolar;

     

                    $roteiro->setValorDiaria($__custo_estimado);
					$roteiro->setQuantidadeDias($__quantidade_diarias);
					$roteiro->setValorDiariaDolar($__custo_estimado_dolar);

					
					$i++;
					
					
                    
        }			
					


            $emOs = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbOrdemServico');

			
			$object->setDiariasCompletas($quantidadeDiarias);
			
            $object->setTotalDiarias($totalDiariasRoteiro);

            $object->setCustoEstimado($custoDiariasRoteiro);
			
			$object->setCustoLiquido($custoEstimaDolarRoteiro);

            $object->setQuantidadeDiarias($quantidadeDiarias);



            $emOs->flush();

           // $this->controleDiarias($object);
        
		/*
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
                    
        */
        
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
     public function calcularDiariasExterior($dataIda, $dataRetorno, $usuario, $grupoPais, $diasTransitoIda, $diasTransitoVolta, $cotacaoDolar){
        
		//$datasIguais, $maiorCidade, $horasRoteiro
		
        $usu = $usuario;

        $valorDiariaGrupoA = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getAlfa();

        $valorDiariaGrupoB = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getBravo();

        $valorDiariaGrupoC = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getCharlie();

        $valorDiariaGrupoD = $usu->getTbPostoGraduacao()->getCiruculoHierarquico()->getDelta();



		$controller = new GestorController(); 
					

        

       // $ci = $this->getCidade($cidade);


    
        //Calculo da quantidade de dias 
        $dia1=strtotime( $dataIda );
        $dia2=strtotime( $dataRetorno );
        $quantidade_dias = ( $dia2 - $dia1 ) / 86400;
        

        $usuarioDiaria = 0;

        switch ($grupoPais) {
            case 'A':
                $usuarioDiaria = $valorDiariaGrupoA;

                break;
             case 'B':
                $usuarioDiaria = $valorDiariaGrupoB;

                break;
             case 'C':
                $usuarioDiaria = $valorDiariaGrupoC;

                break;
             case 'D':
                $usuarioDiaria = $valorDiariaGrupoD;

                break;    
            
            default:
                # code...
                break;
        }

       
		$somaDiarias = $quantidade_dias+$diasTransitoIda+$diasTransitoVolta-1;
        
        $valor_diaria_total = ($usuarioDiaria * $somaDiarias) * $cotacaoDolar; // multiplica o valor do dia pela quantidade de dias mais meia.  

		$valorDiariaDolar = $somaDiarias*$usuarioDiaria;
		
     
         return array($valor_diaria_total,$quantidade_dias, $valorDiariaDolar);
        
        
            
    
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

