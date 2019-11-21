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




class DivisaoAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
		->with('Departamento', ['class' => 'col-md-6'])
						->add('nomeDepartamento', null, array(
							'label' => 'Nome Divisão:',
							'attr' => array('placeholder' => 'Ex: Divisão Operacional')
						))
						->add('sigla', null, array(
							'label' => 'Sigla:',
							'attr' => array('placeholder' => 'Ex: DOP')
						))
						->end()
						
						->with('Unidade/OM da divisão', ['class' => 'col-md-6'])
						->add('unidade', null, array(
							'label' => 'Nome da Unidade:',
							'attr' => array('placeholder' => 'Ex: CENIPA')
						))
						
						->end()
           
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nomeDepartamento', null, array(
							'label' => 'Nome Divisão:'
						))
                    ->add('sigla', null, array(
							'label' => 'Nome Divisão:'
						))
                    ->add('unidade', 'text', array(
							'label' => 'Organização:'
							
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
            ->add('nomeDepartamento', null, array(
							'label' => 'Nome Divisão:'
						))
                    ->add('sigla', null, array(
							'label' => 'Nome Divisão:'
						))
                    ->add('unidade', null, array(
							'label' => 'Nome Divisão:'
							
						))
               
        ;
    }
}
