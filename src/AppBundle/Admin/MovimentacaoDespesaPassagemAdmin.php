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
use AppBundle\Entity\TbOrdemServicoPassagemAereaDespesa as Despesa;
use AppBundle\Entity\TbOrdemServicoAeroporto as Aeroporto;
use AppBundle\Entity\TbNaturezaDespesa as NaturezaDespesa;


use Knp\Menu\ItemInterface as MenuItemInterface;




class MovimentacaoDespesaPassagemAdmin extends AbstractAdmin{

	
	protected $baseRouteName = 'movimentacao-despesa';
    protected $baseRoutePattern = 'page-movimentacao-despesa-passagem';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->add('tipoOperacao')
            ->add('naturezaDespesa')
            ->add('passagem')
            ->add('valorDespesa')
            ->add('registroEm')


        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('tipoOperacao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_despesa_passagem.html.twig', 'label' => 'Operação'))
           // ->add('valorDespesa')
            ->add('naturezaDespesa', 'text')
            ->add('passagem')
            ->add('registroEm', 'date', array('format' => 'd/m/Y'))



        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('tipoOperacao')
            ->add('naturezaDespesa')
            ->add('passagem')
            ->add('valorDespesa')
            ->add('registroEm')


        ;
    }



}
