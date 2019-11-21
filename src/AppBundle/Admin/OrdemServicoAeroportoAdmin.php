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




class OrdemServicoAeroportoAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
   protected $objDespesa;
      protected $objAeroporto;

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            
			    ->add('dataViagem', 'sonata_type_date_picker',
                        array('label'=>'Selecione a data','dp_language'=>'pt','format'=>'dd/MM/yyyy',
                            'dp_use_current' => true,
                            ))
					->add('horarioViagem')
                   ->add('aerodromoOrigem', 'sonata_type_model_autocomplete', array(
                                    'property' => array('iata'),
                                    //'class' => 'col-md-9',
                                    'placeholder' => 'Aeroporto de origem',
                                    'minimum_input_length' => 1,
                                    'to_string_callback' => function($enitity, $property) {
                                return $enitity->getIata() . ' - ' . $enitity->getNome() . ' - ' . $enitity->getCidade()->getNome();
                            },))
                    ->add('aerodromoDestino', 'sonata_type_model_autocomplete', array(
                                    'property' => array('iata'),
									
                                    //'class' => 'col-md-9',
                                    'placeholder' => 'Aeroporto de destino',
                                    'minimum_input_length' => 1,
                                    'to_string_callback' => function($enitity, $property) {
                                return $enitity->getIata() . ' - ' . $enitity->getNome() . ' - ' . $enitity->getCidade()->getNome();
                            },))
					  ->add('valorPassagem', 'money', array(
					      'currency' => 'BRL',
					      'grouping' =>true))

                    ->add('tbTaxonomiaNaturezaDespesa', null, array('label' => 'Natureza de Despesa'))
					
					->add('observacoes', null, array(
								
								'label' => 'Observações em geral:'
					
							)
					
					)
					
					->add('obsDpg', null, array(
								
								'label' => 'Observações do setor de passagens do CENIPA:'
					
							)
					
					)
					  


				


					

					


                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('dataViagem', 'date', array('format' => 'd/m/Y'))
					->add('horarioViagem')
                    ->add('aerodromoOrigem', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_aerodromo.html.twig', 'label' => 'Itinerário'))
                    //->add('aerodromoDestino')
            ->add('valorPassagem', 'decimal', array(
                'template' => 'SonataAdminBundle:CRUD:custom_list_preco_passagem.html.twig', 'label' => 'Valor da passagem',
                'attributes' => array('fraction_digits' => 2),
                'textAttributes' => array('negative_prefix' => 'MINUS'),
            ))
            ->add('_action', 'actions', array(
                        'actions' => array(
						
                        'edit' => array(),
						'delete' => array(),
					                     
                    )
                ))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
             ->add('dataViagem')
					->add('horarioViagem')
                    ->add('aerodromoOrigem')
                    ->add('aerodromoDestino')
					  ->add('valorPassagem')
               
        ;
    }
	

	

	
	/*public function preUpdate($object) {
			
			$this->objDespesa = new Despesa();
			$this->objAeroporto = new Aeroporto();
			
			$this->objNaturezaDespesa = new NaturezaDespesa();
			

			
			
			$this->objDespesa->setValorAlocado($object->getValorPassagem());
			$this->objDespesa->setOrdemAeroporto($this->objAeroporto);
			$this->objDespesa->setTbNaturezaDespesa($this->objNaturezaDespesa);

			
			//$this->objNaturezaDespesa->getTbNaturezaDespesa();
			$em = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbOrdemServicoPassagemAereaDespesa');
			$em->persist($this->objDespesa);
          
    }*/
	
	
}
