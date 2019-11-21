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




class DiariasControleAdmin extends AbstractAdmin{
	



    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->add('tbUsuario')
            ->add('quantidade')
            ->add('tbOrdemServico')		
            ->add('data')
           // ->add('registroEm')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //  ->add('tipoOperacao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_despesa_passagem.html.twig', 'label' => 'Operação'))
           // ->add('valorDespesa')
            ->add('tbUsuario', 'text', array(
                'label' => 'Usuário:'
            ))
            ->add('quantidade', null, array(
                'label' => 'Quantidade:'
            ))
            ->add('exercicio', null, array(
                'label' => 'Ano:'
            ))
            ->add('tbOrdemServico', 'text', array(
                'label' => 'Ordem de serviço:'
            ))



        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('tbUsuario', null, array(
                'label' => 'Usuário:'
            ))
            ->add('quantidade', null, array(
                'label' => 'Quantidade:'
            ))
            ->add('tbOrdemServico', null, array(
                'label' => 'Ano:'
            ))
            ->add('exercicio', null, array(
                'label' => 'Ordem de serviço:'
            ))


        ;
    }



}
