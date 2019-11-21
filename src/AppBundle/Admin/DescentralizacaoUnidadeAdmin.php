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




class DescentralizacaoUnidadeAdmin extends AbstractAdmin{





    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tbUnidade', null, array(
                'required' => false,
                'label' => 'Unidade de origem:',
            ))


            ->add('tbNaturezaDespesa', null, array(
                'required' => false,
                'label' => 'Natureza de despesa de origem:',
            ))

            ->add('unidadeDestino', null, array(
                'required' => false,
                'label' => 'Unidade de destino:',
            ))

            ->add('naturezaDespesaDestino', null, array(
                'required' => false,
                'label' => 'Natureza de despesa de destino:',
            ))

            ->add('valorDescentralizado', null, array(
                'required' => false,
                'label' => 'Valor a ser descentralizado:',
            ))






        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('valorDescentralizado', null, array(
                'label' => 'Valor descentralizado'
            ))
            ->add('dataRegistro', null, array(
                'label' => 'Data da descentralização'
            ))
            ->add('tbNaturezaDespesa', null, array(
                'label' => 'Natureza de despesa de origem'
            ))
            ->add('naturezaDespesaDestino', null, array(
                'label' => 'Natureza de despesa de destino'
            ))
            ->add('tbUnidade', null, array(
                'label' => 'Unidade origem'
            ))
            ->add('unidadeDestino', null, array(
                'label' => 'Unidade destino'
            ))


        ;
    }






}
