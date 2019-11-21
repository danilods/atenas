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
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Knp\Menu\ItemInterface as MenuItemInterface;




class ControleNaturezaDespesaAdmin extends AbstractAdmin{
    //put your code here
    protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
          

            ->add('tipoOperacao', 'choice', array(
                                    'choices' => array(
                                       
                                        
                                         1 => 'DÉBITO',
                                        -1 => 'CRÉDITO',
                                        
                            ),          
                                        'label' => 'Tipo de operação',
                                        'required'=>true,
                                        'expanded' => true, 
                                        'multiple' => false
                            ))

            ->add('notaEmpenho', null, array(
                'label' => 'Nota de empenho:'

            ))


            ->add('valor', 'money', array(
                'label' => 'Valor do empenho:',
                'currency' => 'BRL',
                'precision' => 2,

                'grouping' =>true,
                'attr' => array('placeholder' => 'Ex: 100,00')
            ))

             ->add('imageFile', 'vich_file', array(
                        'label' => 'Anexo',
                        'required'      => false,
                        'allow_delete'  => false, // not mandatory, default is true
                        'download_link' => true, // not mandatory, default is true
                              
        ))


        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                    ->add('tbNaturezaDespesa', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_natureza_unidade.html.twig', 'label' => 'Natureza de Despesa'))
                    ->add('valor', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_natureza_unidade.html.twig', 'label' => 'Teto orçamentário'))
                    ->add('tipoOperacao')
                    ->add('notaEmpenho')

					 ->add('_action', 'actions', array(
                        'actions' => array(
						
                        'edit' => array(),
						'delete' => array()
					                     
                    )
                ))
					
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
             ->add('tbNaturezaDespesa')


        ;
    }

   

}
