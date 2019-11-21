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




class GeografiaCidadeAdmin extends AbstractAdmin{
    //put your code here
    protected $emName = 'taxonomia';
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nome')
            ->add('latitude')
            ->add('longitude')
            ->add('uf')
	    ->add('diaria')
		->add('pais')
                
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
             ->addIdentifier('nome')
            ->add('latitude')
            ->add('longitude')
            ->add('uf', 'text')
	    ->add('diaria')
          
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
           ->add('nome')
           ->add('latitude')
           ->add('longitude')
	   ->add('diaria')
              
               
        ;
    }
}
