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

use Knp\Menu\ItemInterface as MenuItemInterface;




class OrcamentoAdmin extends AbstractAdmin{
    //put your code here
    protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            
                   
					
					->with('Unidade', ['class' => 'col-md-3'])
					->add('tbUnidade',null ,array(
						'label' => 'Unidade/OM'))
                   
						->end()
				->with('Diárias', ['class' => 'col-md-3'])
					->add('diarias', 'money', array(
                        'label' => 'Teto diárias:',
                        'currency' => 'BRL',
                        'grouping' =>true))
						
						->add('diariaDescentralizada', 'money', array(
                        'label' => 'Valor descentralizado das diarias:',
                        'currency' => 'BRL',
                        'grouping' =>true))
                
					->end()

			->with('Passagem', ['class' => 'col-md-3'])
					->add('passagem', 'money', array(
                        'label' => 'Teto passagens:',
                        'currency' => 'BRL',
                        'grouping' =>true))
						
						->add('passagemDescentralizada', 'money', array(
                        'label' => 'Valor descentralizado das passagens:',
                        'currency' => 'BRL',
                        'grouping' =>true))
                
					->end()



					
					->with('Investimento', ['class' => 'col-md-3'])
					->add('totalInvestimento', 'money', array(
                        'label' => 'Teto investimento:',
                        'currency' => 'BRL',
                        'grouping' =>true))
						
						->add('investimentoDescentralizado', 'money', array(
                        'label' => 'Valor descentralizado de investimento:',
                        'currency' => 'BRL',
                        'grouping' =>true))
                
					->end()
					
					->with('Custeio', ['class' => 'col-md-3'])
					->add('totalCusteio', 'money', array(
                            'label' => 'Teto Custeio:',
                            'currency' => 'BRL',
                            'grouping' =>true))
							
							->add('custeioDescentralizado', 'money', array(
                        'label' => 'Valor descentralizado de custeio:',
                        'currency' => 'BRL',
                        'grouping' =>true))
                
					->end()
					
					->with('Exercicio', ['class' => 'col-md-3'])
					->add('exercicio',null ,array(
						'label' => 'ExercÃ­cio:'))
                
					->end()
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          
        ->add('tbUnidade', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_unidade_orcamento.html.twig', 'label' => 'Unidade'))
		
		->add('exercicio', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_exercicio.html.twig', 'label' => 'Ano'))
		
		->add('diarias', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_orcamento_total_diarias.html.twig', 'label' => 'Diarias'))
		
		->add('saldoDiarias', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_orcamento_saldo_diarias.html.twig', 'label' => 'Saldo diarias'))

		->add('passagem', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_orcamento_total_passagens.html.twig', 'label' => 'Passagens'))
		
		->add('saldoPassagem', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_orcamento_saldo_passagens.html.twig', 'label' => 'Saldo passagens'))

             	->add('totalInvestimento', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_orcamento_investimento.html.twig', 'label' => 'Investimento'))
				
				->add('saldoInvestimento', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_saldo_investimento.html.twig', 'label' => 'Saldo investimento'))
             	->add('totalCusteio', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_orcamento_custeio.html.twig', 'label' => 'Custeio'))
				
				->add('saldoCusteio', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_saldo_custeio.html.twig', 'label' => 'Saldo custeio'))

		 ->add('_action', 'actions', array(
                        'actions' => array(
						
                        'edit' => array(),
                    )
                ))


                    
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
             ->add('tbUnidade', null, array('label' => 'Unidade'))
                    ->add('totalCusteio', null, array('label' => 'Custeio'))
                    ->add('totalInvestimento', null, array('label' => 'Investimento'))
					->add('exercicio', null, array('label' => 'Exercicio'))
               
        ;
    }
}
