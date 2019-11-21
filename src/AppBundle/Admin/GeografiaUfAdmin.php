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




class GeografiaUfAdmin extends AbstractAdmin{
    //put your code here
    protected $emName = 'taxonomia';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nome')
                    ->add('pais')
                    ->add('nomeCodigo')
                    ->add('regiao')
                    ->add('comar')
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nome')
            ->add('nomeCodigo', 'text', array('label' => 'UF'))
            ->add('regiao', 'text', array('label' => 'Região'))
            ->add('pais')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
           ->add('nome')
               ->add('pais')
                ->add('nomeCodigo')
                ->add('regiao')
                ->add('comar')
               
        ;
    }
}
