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




class NaturezaMissaoAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
		->with('Natureza da Missão/Subcentro de Custos', ['class' => 'col-md-4'])
					->add('nomeNaturezaMissao',null ,array(
						'label' => 'Nome:'))
                   ->add('descricaoNatureza',null ,array(
						'label' => 'Descrição:'))
					->end()
                   
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
               ->add('nomeNaturezaMissao',null ,array(
						'label' => 'Nome:'))
                   ->add('descricaoNatureza',null ,array(
						'label' => 'Descrição:'))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
               ->add('nomeNaturezaMissao',null ,array(
						'label' => 'Nome:'))
                   ->add('descricaoNatureza',null ,array(
						'label' => 'Descrição:'))
               
        ;
    }
}
