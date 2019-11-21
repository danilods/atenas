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
use AppBundle\Entity\TbMovimentacaoDespesaOs as Despesa;
use AppBundle\Entity\TbMovimentacaoDespesaPassagem as DespesaPassagem;


use Knp\Menu\ItemInterface as MenuItemInterface;




class OrdemServicoAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
   
    protected $baseRouteName = 'os_admin_default';
    protected $baseRoutePattern = 'page-os-default';
   
     public function createQuery($context = 'list')
{
    $query = parent::createQuery($context);
    $query->andWhere(
        $query->expr()->eq($query->getRootAliases()[0]. '.setorId', ':my_param')
		
   );
   $query->andWhere(
        $query->expr()->eq($query->getRootAliases()[0]. '.statusOs', ':my_param2')
		
   );
    $query->setParameter('my_param', 1);
	    $query->setParameter('my_param2', 'PENDENTE');

    return $query;
}

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
		  ->tab('DADOS DA ORDEM DE SERVIÇO')
                        ->with('ORDEM DE SERVIÇO', array(
                        'class' => 'col-md-5',
                            'box_class' => 'box box-solid box-primary',
                        'description' => 'Relatório ao Cenipa para Segurança de Voo',
                            // ...
                    ))
							->add('numeroOrdemServico', null, array(
								'label' => 'Número OS',
								'read_only' => true,
								'disabled' => true
							)			
							)
					  ->add('tbUsuario')
					  
					  ->add('setorId', 'text', array(
								'label' => 'Divisão',
								'read_only' => true,
								'disabled' => true
							)			
							)
				
				->add('cidade', 'sonata_type_model_autocomplete', array(
                                    'property' => array('nome', 'latitude', 'longitude'),
                                    //'class' => 'col-md-9',
                                    'placeholder' => 'Clique e selecione um município',
                                    'minimum_input_length' => 1,
                                    'to_string_callback' => function($enitity, $property) {
                                return $enitity->getNome() . ' - ' . $enitity->getUf()->getNome() . ' - ' . $enitity->getPais()->getNome();
                            },
                                ))
                    ->add('inicioMissao', 'sonata_type_date_picker',
                        array('label'=>'Selecione a data','dp_language'=>'pt','format'=>'dd/MM/yyyy',
                            'dp_use_current' => true,
                            ))
                    ->add('retornoMissao', 'sonata_type_date_picker',
                        array('label'=>'Selecione a data','dp_language'=>'pt','format'=>'dd/MM/yyyy',
                            'dp_use_current' => true,
                            ))
			  
					->add('despesasContaPropria', 'choice', array(
                                    'choices' => array(
                                       
                                        
                                        'SIM' => 'SIM',
                                        'NAO' => 'NAO',
									    
                            ),			
										'label' => 'Despesas por conta própria?',
										'required'=>true,
										'expanded' => true, 
										'multiple' => false
							))
					->add('contaUniao', 'choice', array(
                                    'choices' => array(
                                       
                                        
                                        'SIM' => 'SIM',
                                        'NAO' => 'NAO',
									    
                            ),			
										'label' => 'Conta da União?',
										'required'=>true,
										'expanded' => true, 
										'multiple' => false
							))
					->add('pernoiteMissao', 'choice', array(
                                    'choices' => array(
                                       
                                        
                                        'SIM' => 'SIM',
                                        'NAO' => 'NAO',
									    
                            ),			
										'label' => 'Pernoite missão?',
										'required'=>true,
										'expanded' => true, 
										'multiple' => false
							))
					->add('acrescimentoDeslocamento')
					->add('disponibilidadeFinanceira', 'choice', array(
                                    'choices' => array(
                                       
                                        
                                        'SIM' => 'SIM',
                                        'NAO' => 'NAO',
									    
                            ),			
										'label' => 'Disponibilidade financeira?',
										'required'=>true,
										'expanded' => true, 
										'multiple' => false
							))
				->add('quantidadeAcrescimo')
					->add('observacoes')
					->add('quantidadeDiarias', null ,array(
						 
						  'attr' => array(
							  'class' => 'col-md-2 quantidade_diarias '
						  )))
					->add('totalDiarias')
					->add('custoEstimado')
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
					->add('justificativaAntecipacao')
					 
					->add('naturezaMissao')
					->add('tbNaturezaDespesa')


					
                             
                       
							
                        ->end()
						
				
               		->with('APROVAÇÃO DA ORDEM DE SERVIÇO', array(
                                    'class' => 'col-md-7',
                                    'box_class' => 'box box-solid box-warning',
                                        // ...

                    ))
                                        ->add('statusOs', 'choice', array(
                                            'choices' => array(


                                                'APROVADA' => 'SIM',
                                                'NÃO APROVADA' => 'NAO',

                                            ),
                                            'label' => 'Aprovar Ordem de Serviço?',
                                            'required'=>true,
                                            'expanded' => true,
                                            'multiple' => false
                                        ))

								
								
	
							

				
			
				->end()
        
						   
							
                                    
                                                    ->with('Controle e acompanhamento', array(
                                    'class' => 'col-md-7',
                                    'box_class' => 'box box-solid box-primary',
                                    'description' => 'Informações sobre o andamento do relato.',
                                        // ...
                                ))
								
					
							
							
							
                            ->end()
							
                ->end()

            ->tab('PASSAGEM AÉREA')
            ->with('REQUISIÇÃO DE PASSAGEM', array(
                'class' => 'col-md-12',
                'box_class' => 'box box-solid box-primary',
                'description' => '',
                // ...
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
		
		
		
		
				   
			
	

					
					 
							
					


                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('numeroOrdemServico', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_numero_os.html.twig', 'label' => 'Número da OS'))
                   
                    ->add('inicioMissao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_periodo_missao.html.twig', 'label' => 'Período e localidade da missão'))
					
					->add('naturezaMissao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_missao.html.twig', 'label' => 'Tipo de missão'))
                    ->add('tbNaturezaDespesa', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_natureza.html.twig', 'label' => 'Custo e natureza de despesa'))

            ->add('_action', 'actions', array(
                        'actions' => array(
						
                        'edit' => array(),
						'delete' => array(),
					                     
                    )
                ))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('numeroOrdemServico')
                    ->add('inicioMissao')
                    ->add('retornoMissao')
					->add('despesasContaPropria')
					->add('contaUniao')
					->add('pernoiteMissao')
					->add('acrescimentoDeslocamento')
					->add('disponibilidadeFinanceira')
				->add('quantidadeAcrescimo')
					->add('observacoes')
					->add('quantidadeDiarias')
					->add('totalDiarias')
					->add('custoEstimado')
					->add('modificacaoDiarias')
					->add('justificativaAntecipacao')
					->add('cidade')
					->add('naturezaMissao')
               
        ;
    }
	
	
	 public function prePersist($object) {

         foreach ($object->getAeroporto() as $aeroporto) {

            $aeroporto->setOrdemServico($object);



        }



    }
	
	
	public function preUpdate($object) {

        $status_os = $object->getStatusOs();

        $emPassagem = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

        $emNaturezaDespesa = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbNaturezaDespesa');

      //  $repositoryNatureza = $emNaturezaDespesa->getRepository('AppBundle\Entity\TbNaturezaDespesa');

        $repositoryPassagem = $emPassagem->getRepository('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

        $valorSaldoNatureza = 0;

     //   $totalDespesaPassagens = 0;


        foreach ($object->getAeroporto() as $aeroporto) {

            $aeroporto->setOrdemServico($object);



        }

        foreach ($object->getAeroporto() as $aeroporto) {

            $valorSaldoNatureza += $aeroporto->getValorPassagem();

           //obter todas despesas da tabela movimentacao para debitar do total do orçamento da natureza de despesa
           // $objPassagens = $repositoryPassagem->findAll();


            $movimentacaoPassagem = $repositoryPassagem->findBy(
                array('passagem' => $aeroporto->getId())
            );






           $valorPassagem = $aeroporto->getValorPassagem();

            if (!$movimentacaoPassagem) {

                if ($status_os == 'APROVADA') {

                    $this->objReg = new DespesaPassagem();
                    $this->objReg->setTipoOperacao('DEBITO');
                    $this->objReg->setValorDespesa($valorPassagem);
                    $this->objReg->setNaturezaDespesa($aeroporto->getTbNaturezaDespesa());
                    $this->objReg->setPassagem($aeroporto);


                    $emPassagem->persist($this->objReg);




                }


            } else {




                foreach ($movimentacaoPassagem as $despesa) {

                        $despesa->setValorDespesa($aeroporto->getValorPassagem());

                        $emPassagem->flush();




                    }


            }


        }




        $em = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaOs');

        $repository = $em->getRepository('AppBundle\Entity\TbMovimentacaoDespesaOs');

        $movimentacao = $repository->findBy(
            array('ordemServico' => $object->getId())
        );



        if(!$movimentacao) {

            if($status_os=='APROVADA') {

                $this->objReg = new Despesa();
                $this->objReg->setTipoOperacao('DEBITO');
                $this->objReg->setValorDespesa($object->getCustoEstimado());
                $this->objReg->setNaturezaDespesa($object->getTbNaturezaDespesa());
                $this->objReg->setOrdemServico($object);


                $em->persist($this->objReg);



            }



        }else{
            foreach ($movimentacao as $despesa) {
                $despesa->setValorDespesa($object->getCustoEstimado());
                $em->flush();
            }
        }






       
    }

    public function postUpdate($object)
    {

        $emPassagem = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

        $emNaturezaDespesa = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbNaturezaDespesa');

        $repositoryNatureza = $emNaturezaDespesa->getRepository('AppBundle\Entity\TbNaturezaDespesa');

        $repositoryPassagem = $emPassagem->getRepository('AppBundle\Entity\TbMovimentacaoDespesaPassagem');

        $em = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbMovimentacaoDespesaOs');

        $repository = $em->getRepository('AppBundle\Entity\TbMovimentacaoDespesaOs');

        $totalDespesaMilitar = 0;

        $totalDespesaCivil = 0;

        $valorSaldoNatureza = 0;

        $totalDespesaPassagens = 0;

        $despesasOsCivil = $repository->findBy(array('naturezaDespesa' => 1));

        $despesasOsMilitar = $repository->findBy(array('naturezaDespesa' => 2));


        $naturezaDespesaCivil = $repositoryNatureza->findOneBy(
            array('id' => 1)
        );

        $naturezaDespesaMilitar = $repositoryNatureza->findOneBy(
            array('id' => 2)
        );



            foreach ($despesasOsCivil as $despesas){


                    $totalDespesaCivil += $despesas->getValorDespesa();


            }

            $valorSaldoNaturezaOsCivil = $naturezaDespesaCivil->getValorNatureza() - $totalDespesaCivil;


            $naturezaDespesaCivil->setSubTotal($valorSaldoNaturezaOsCivil);


            foreach ($despesasOsMilitar as $despesa){



                        $totalDespesaMilitar += $despesa->getValorDespesa();


            }

            $valorSaldoNaturezaOsMilitar = $naturezaDespesaMilitar->getValorNatureza() - $totalDespesaMilitar;

            $naturezaDespesaMilitar->setSubTotal($valorSaldoNaturezaOsMilitar);






        foreach ($object->getAeroporto() as $aeroporto) {

            $valorSaldoNatureza += $aeroporto->getValorPassagem();

            //obter todas despesas da tabela movimentacao para debitar do total do orçamento da natureza de despesa
            $objPassagens = $repositoryPassagem->findAll();

        }


        foreach ($objPassagens as $despesasDasPassagens){

            $totalDespesaPassagens += $despesasDasPassagens->getValorDespesa();

        }

        //obter o orçamento disponível
        $naturezaDespesa = $repositoryNatureza->findOneBy(
            array('id' => 5)
        );

        $saldoNatureza = $naturezaDespesa->getValorNatureza() - $totalDespesaPassagens;

        $naturezaDespesa->setSubTotal($saldoNatureza);



        $emNaturezaDespesa->flush();





    }


}
