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




class QuadroEspecialidadeAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
					->with('Especialidade', ['class' => 'col-md-4'])
					->add('nomeQuadro',null ,array(
						'label' => 'Nome Especialidade'))
                   
					->end()
					
					->with('Setor', ['class' => 'col-md-4'])
					->add('siglaQuadro',null ,array(
						'label' => 'Sigla Especialidade'))
                   
					->end()
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          
                    ->add('nomeQuadro',null ,array(
						'label' => 'Nome Especialidade'))
					->add('siglaQuadro',null ,array(
						'label' => 'Sigla Especialidade'))
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
           
                    ->add('nomeQuadro',null ,array(
						'label' => 'Nome Especialidade'))
					->add('siglaQuadro',null ,array(
						'label' => 'Sigla Especialidade'))
               
        ;
    }
}
