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




class CirculoHierarquicoAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
		->with('Hierarquia', ['class' => 'col-md-4'])
					->add('nomeCirculoHierarquico',null ,array(
						'label' => 'Nome do Círculo hierárquico'))
                   ->add('sigla',null ,array(
						'label' => 'Nome do Círculo hierárquico'))
					->end()
					
					->with('Valores das diárias', ['class' => 'col-md-4'])
						
						->add('diariaNormal',null ,array(
						'label' => 'Diária normal'))
						
						->add('meiaDiaria',null ,array(
						'label' => 'Meia diária'))
						
						->add('noventa',null ,array(
						'label' => '90%'))
						
						->add('oitenta',null ,array(
						'label' => '80%'))
						
						->add('setenta',null ,array(
						'label' => '70%'))
						
						->add('cinquenta',null ,array(
						'label' => '50%'))
						
						->add('alfa',null ,array(
						'label' => 'Grupo A'))
						
						->add('bravo',null ,array(
						'label' => 'Grupo B'))
						
						->add('charlie',null ,array(
						'label' => 'Grupo C'))
						
						->add('delta',null ,array(
						'label' => 'Grupo D'))
						
						
                  
					->end()
					
					
		

                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
		$listMapper
       ->add('nomeCirculoHierarquico')
                    ->add('sigla')
					
					->add('diariaNormal', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => 'Diária normal'
							))
					
				    ->add('meiaDiaria', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => 'Meia diária'
							))

					->add('noventa', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => '	90%'
							))
					->add('oitenta', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => '	80%'
							))
					->add('setenta', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => '	70%'
							))
					->add('cinquenta', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => '	50%'
							))
							
							->add('alfa', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => 'Grupo A U$S'
							))
							
							->add('bravo', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => 'Grupo B U$S'
							))
							
							->add('charlie', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => 'Grupo C U$S'
							))
							
							->add('delta', 'currency', array(
							'currency' => 'R$',
							'locale' => 'pt_BR',
							'label' => 'Grupo D U$S'
							))
					
					
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
            ->add('sigla')
               
        ;
    }
	
	
}
