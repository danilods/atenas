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




class MovimentacaoDespesaOsAdmin extends AbstractAdmin{
	
	protected $baseRouteName = 'despesa-os1';
    protected $baseRoutePattern = 'page-movimentacao-despesa-os';


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->add('tipoOperacao')
            ->add('naturezaDespesaId')
          //  ->add('ordemServico')
			
            ->add('valorDespesa')
           // ->add('registroEm')







        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
              ->add('tipoOperacao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_despesa_passagem.html.twig', 'label' => 'Operação'))
           // ->add('valorDespesa')
          ->add('ordemServico', 'entity', [
                     'class'         => 'AppBundle\Entity\TbOrdemServico',
                     ], ['admin_code'    => 'admin_ordem_servico'])
            ->add('registroEm', 'date', array('format' => 'd/m/Y'))




        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('tipoOperacao')
            ->add('naturezaDespesaId')
         //   ->add('ordemServico')
            ->add('valorDespesa')
            ->add('registroEm')


        ;
    }



}
