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




class OsControleAdmin extends AbstractAdmin{
    //put your code here
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
					
					->add('observacoes',null ,array(
						'label' => 'Observações:'))
						
                 //  ->add('registradoPor', null, array(
                //    'label' => 'Registrador por:',
             //       'read_only' => true,
              //      'disabled' => true
             //   ))
				   
					
					
           
                   
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          
            ->add('dataRegistro',null ,array(
						'label' => 'Data'))
                   
        ;
    }
   
}
