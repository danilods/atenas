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




class UnidadeAdmin extends AbstractAdmin{
    //put your code here
    protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
		->with('Unidade', ['class' => 'col-md-4'])
					->add('nomeUnidade',null ,array(
						'label' => 'Nome da Unidade'))

                    ->add('chefe',null ,array(
                        'label' => 'Chefe da Unidade'))
                   
					->end()
					
					->with('Dados', ['class' => 'col-md-4'])
					->add('endereco',null ,array(
						'label' => 'Endereço'))

                   ->add('telefone')


					->end()
					
					
           
                   
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          
            ->add('nomeUnidade',null ,array(
						'label' => 'Nome da Unidade'))
                   ->add('endereco',null ,array(
						'label' => 'Endereço'))
                   ->add('chefe',null ,array(
                        'label' => 'Chefe da Unidade'))
                   ->add('telefone')
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
            ->add('nomeUnidade',null ,array(
						'label' => 'Nome da Unidade'))
                  
               
        ;
    }
}
