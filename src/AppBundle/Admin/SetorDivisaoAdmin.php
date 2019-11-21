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




class SetorDivisaoAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		->with('Setor', ['class' => 'col-md-4'])
					->add('nomeSetor',null ,array(
						'label' => 'Setor/Seção'))
                   
					->end()
					
					->with('Sigla do setor', ['class' => 'col-md-4'])
					 ->add('sigla',null ,array(
						'label' => 'Sigla'))
					->end()
					->with('Divisão/Departamento', ['class' => 'col-md-4'])
					->add('tbDivisao',null ,array(
						'label' => 'Divisão/Departamento'))
					->end()
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nomeSetor',null ,array(
						'label' => 'Setor/Seção'))
                    ->add('sigla',null ,array(
						'label' => 'Sigla'))
					->add('tbDivisao',null ,array(
						'label' => 'Divisão/Departamento'))
						
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
          ->add('nomeSetor',null ,array(
						'label' => 'Setor/Seção'))
                    ->add('sigla',null ,array(
						'label' => 'Sigla'))
					->add('tbDivisao',null ,array(
						'label' => 'Divisão/Departamento'))
               
        ;
    }
}
