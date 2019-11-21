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




class RoteiroExteriorAdmin extends AbstractAdmin{
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
							
							->add('diasTransitoIda', null, array(
									'label' => 'Dias de trânsito de ida:',
									'disabled' => false,
									'read_only' => false
									))
							
							->add('dateTermino', 'sonata_type_date_picker',
							array('label'=>'Data final:','dp_language'=>'pt','format'=>'dd/MM/yyyy',
								'dp_use_current' => true,
								))
								
								
									
									->add('diasTransitoVolta', null, array(
									'label' => 'Dias de trânsito de volta:',
									'disabled' => false,
									'read_only' => false
									))
							
							->add('horaInicio', null, array(
							'label' => 'Horário do início',

						))
							->add('horaFinal', null, array(
							'label' => 'Horário do término',
						))
						
					
						
						->add('paisMissao')
								
								->add('detalheCidade', null, array(
									'label' => 'Cidade:',
									'disabled' => false,
									'read_only' => false
									))
									
									->add('endereco', null, array(
									'label' => 'Endereço:',
									'disabled' => false,
									'read_only' => false
									))
									
									->add('estabelecimento', null, array(
									'label' => 'Estabelecimento:',
									'disabled' => false,
									'read_only' => false
									))
									
									
									
									->end()
									
							->with('Dados financeiros', ['class' => 'col-md-6'])

									
									
									->add('cotacaoDolar', 'money', array(
									'currency' => 'BRL',
									'grouping' =>true))
									
									->add('valorDiaria', 'money', array(
									'currency' => 'BRL',
									'grouping' =>true))
									
									->add('valorDiariaDolar', 'money', array(
										'label' => 'Custo estimado em Dolar:',
										'currency' => 'USD',
										'grouping' =>true))
								->add('quantidadeDias', null, array(
									'label' => 'Total de dias',
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
             ->add('paisMissao', null, array(
							'label' => 'País:',
						))
                   
			  

        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
       
    }
}
