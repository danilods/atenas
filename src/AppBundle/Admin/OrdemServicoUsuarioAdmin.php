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




class OrdemServicoUsuarioAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            
			
						->add('tbUsuario', 'sonata_type_model')
						->add('tbOrdemServico', 'sonata_type_admin');

                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          ->add('tbOrdemServico')
						->add('tbUsuario')
           
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
          ->add('tbOrdemServico')
						->add('tbUsuario')
		
               
        ;
    }
}
