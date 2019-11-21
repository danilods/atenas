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




class RoteiroMissaoAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
					->with('Roteiro da missão', ['class' => 'col-md-6'])
						->add('dataInicio', 'sonata_type_date_picker',
                        array('label'=>'Data inicial:','dp_language'=>'pt','format'=>'dd/MM/yyyy',
                            'dp_use_current' => true,
                            ))
							
							->add('dateTermino', 'sonata_type_date_picker',
							array('label'=>'Data final:','dp_language'=>'pt','format'=>'dd/MM/yyyy',
								'dp_use_current' => true,
								))
							
							->add('horaInicio', null, array(
							'label' => 'Horário do início',
						))
							->add('horaFinal', null, array(
							'label' => 'Horário do término'
						))
						
						->add('pernoite', null, array(
							'label' => 'Pernoite?'
						))
						
						->add('adicionalDeslocamento', null, array(
							'label' => 'Adicional deslocamento?'
						))

						

						
						
						->add('geografiaCidade', 'sonata_type_model_autocomplete', array(
                                    'property' => array('nome', 'latitude', 'longitude'),
                                    'label' => 'Cidade da missão:',
                                    'placeholder' => 'Clique e selecione um município',
                                    'minimum_input_length' => 1,
                                    'to_string_callback' => function($enitity, $property) {
                                return $enitity->getNome() . ' - ' . $enitity->getUf()->getNome() . ' - ' . $enitity->getPais()->getNome();
                            },
                                ))
								
								->add('transporteUtilizado', 'choice', array(
									'choices' => array(

										'***' => '***',
										'AEREO' => 'AÉREO',
										'FERROVIARIO' => 'FERROVIÁRIO',
										'FLUVIAL' => 'FLUVIAL',
										'MARITIMO' => 'MARÍTIMO',
										'RODOVIARIO' => 'RODOVIÁRIO',
										'VEICULO OFICIAL' => 'VEÍCULO OFICIAL',
										'VEICULO PRÓPRIO' => 'VEÍCULO PRÓPRIO',


									),
									'label' => 'Tipo de transporte utilizado:',
									'required'=>true,
									'expanded' => false,
									'multiple' => false
								))
								->add('quantidadeDiarias', null, array(
									'label' => 'Quantidade de diárias',
									'disabled' => true,
									'read_only' => true
									))
								->add('valorDiaria', 'money', array(
								'currency' => 'BRL',
								'grouping' =>true))
								
							
						->end()
						
					  
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
             ->add('geografiaCidade', null, array(
							'label' => 'Sigla do Posto:',
						))
                   
			  

        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
       
    }
}
