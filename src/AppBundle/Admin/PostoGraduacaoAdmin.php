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




class PostoGraduacaoAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
					->with('Sigla Posto/Graduação', ['class' => 'col-md-6'])
						->add('nomePosto', null, array(
							'label' => 'Sigla do Posto:',
							'attr' => array('placeholder' => 'Ex: Ten Cel / 1º Ten')
						))
						->end()
						
					   ->with('Circulo Hierárquico', ['class' => 'col-md-6'])
					   ->add('ciruculoHierarquico', null, array(
							'label' => 'Circulo Hierárquico:'
						))
					   
					   ->end()
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
             ->add('nomePosto', null, array(
							'label' => 'Sigla do Posto:',
						))
                   
			  ->add('ciruculoHierarquico', 'text', array(
							'label' => 'Circulo Hierárquico:'
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
        ->add('sigla', null, array(
							'label' => 'Sigla do Posto:',
						))
                   
			  ->add('ciruculoHierarquico', null, array(
							'label' => 'Circulo Hierárquico:'
						))

               
        ;
    }
}
