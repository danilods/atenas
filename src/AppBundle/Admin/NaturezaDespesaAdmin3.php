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

use Knp\Menu\ItemInterface as MenuItemInterface;




class NaturezaDespesaAdmin3 extends AbstractAdmin{
    //put your code here
    protected $emName = 'unidade';
    protected $baseRouteName = 'natureza-admin3';
    protected $baseRoutePattern = 'page-natureza-admin3';


   public function createQuery($context = 'list') {
    $query = parent::createQuery($context);
    
    


    $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

   
          $query->innerJoin($query->getRootAlias().'.tbOrcamento','oc')
              ->innerJoin('oc.tbUnidade','u')
              ->where('u.id = :unidade')
              ->setParameter('unidade', 4);

              return $query;            
    }


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

            ->with('Natureza de despesa', array(
                'class' => 'col-md-6',
                'box_class' => 'box box-solid box-primary',
                'description' => '',
                // ...
            ))
            ->add('tbTaxonomiaNaturezaDespesa', null, array(
							'label' => 'Natureza de Despesa:'
					))

            ->add('naturezaMissao', null, array(
                            'label' => 'Atividade:'
                    ))

                    ->add('valorNatureza', 'money', array(
						  'label' => 'Teto orçamentário:',
					      'currency' => 'BRL',
					      'precision' => 2,
						  
						  'grouping' =>true,
						  'attr' => array('placeholder' => 'Ex: 100,00')
						  ))

                        ->add('valorDescentralizado', 'money', array(
                            'label' => 'Valor descentralizado:',
                            'currency' => 'BRL',
                            'precision' => 2,
                            'grouping' =>true

                        ))


                    ->add('subTotal', 'money', array(
						  'label' => 'Saldo:',
					      'currency' => 'BRL',
					      'precision' => 2,
						  'grouping' =>true

						  ))
						  
					->add('tbOrcamento', null, array(
							'label' => 'Orçamento referente à Unidade/OM:'
					))
            ->end()

            ->with('Movimentações financeiras', array(
                'class' => 'col-md-6',
                'box_class' => 'box box-solid box-success',
                'description' => '',
                // ...
            ))

                   ->add('despesas', 'sonata_type_collection',
                        array(

                            'required'      => true,
                            'type_options'  => array(
                                'delete' => true,
                                'cascade_validation' => true
                            ),
                            'by_reference'  => true,
                            'mapped'        => true
                        ),
                        array(
                            'edit'          => 'inline',
                            'inline'        => 'inline',
                            'sortable'      => 'standard',

                        ))

            ->end()
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                    ->add('tbOrcamento', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_unidade.html.twig', 'label' => 'Unidade'))
                    ->add('tbTaxonomiaNaturezaDespesa', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_natureza_unidade.html.twig', 'label' => 'Natureza de Despesa'))
                    ->add('valorNatureza', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_natureza_unidade.html.twig', 'label' => 'Teto orçamentário'))
                    ->add('valorDescentralizado', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_valor_descentralizado.html.twig', 'label' => 'Teto orçamentário'))

                     ->add('subTotal', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_natureza_unidade_saldo.html.twig', 'label' => 'Saldo'))
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
             ->add('tbTaxonomiaNaturezaDespesa')
                    ->add('valorNatureza')
                    ->add('subTotal')
					->add('tbOrcamento')
               
        ;
    }


     public function prePersist($object) {

         foreach ($object->getDespesas() as $despesa) {


            
            $despesa->setTbNaturezaDespesa($object);



        }
    }

         public function preUpdate($object) {

              $somaDespesas = 0;

              
                
                foreach ($object->getDespesas() as $despesa) {

                $despesa->setTbNaturezaDespesa($object);

                

                $somaDespesas = $somaDespesas + ($despesa->getValor()*$despesa->getTipoOperacao());

        }

         $valorDescentralizado = $object->getValorDescentralizado();

         $valorSaldoNatureza = $valorDescentralizado - $somaDespesas;

         $object->setSubTotal($valorSaldoNatureza);
    }
}
