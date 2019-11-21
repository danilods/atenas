<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProdutoAdmin
 *
 * @author danilodesouza
 */
namespace Cenipa\UserBundle\AbstractAdmin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Cenipa\UserBundle\Entity\OcorrenciaGeral;


use Cenipa\UserBundle\Entity\GeografiaCidade;
use Cenipa\UserBundle\Entity\GeografiaUf;

use Cenipa\UserBundle\Entity\TaxonomiaTipo;

use Cenipa\UserBundle\Entity\AerodromoGeral;





class OcorrenciaAdmin extends AbstractAdmin
{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper

            ->add('cidade')
            ->add('local')
                ->add('aerodromo')
                ->add('latitude')
                ->add('longitude')
                ->add('latitude_decimal')
                ->add('longitude_decimal')
                ->add('numero_processo')
                ->add('classificacao')
                ->add('tipo')
                ->add('dia')
                ->add('horario')
                ->add('hora_utc')
                ->add('danos_terceiros')
                ->add('historico')
                ->add('cadastrado_por')
                ->add('cadastro_em')



                
        ;
    }

   /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {



        $formMapper
            ->with('Informações Gerais da Ocorrência', 
                array(
                        'class'       => 'col-lg-12',
                        'box_class'   => 'box box-solid box-primary'
                        ))
                ->add('cidade', 'sonata_type_model_autocomplete', array(
                          'property' => array('nome', 'latitude','longitude'),
                          'minimum_input_length' => 1,
                          'to_string_callback' => function($enitity, $property) {
                                return $enitity->getNome(). ' - '. $enitity->getUf()->getNome(). ' - '. $enitity->getPais()->getNome();
                            },
                ))             
                //->add('cidade', 'entity', array('attr'=>array('data-sonata-select2-allow-clear'=>'true'),'class' => 'Cenipa\UserBundle\Entity\GeografiaCidade'))               
                ->add('local')

                ->add('aerodromo', 'sonata_type_model_autocomplete', array(
                          'property' => array('nome','icao', 'iata'),
                          'minimum_input_length' => 1,
                          'to_string_callback' => function($enitity, $property) {
                                return $enitity->getIcao(). ' - '.$enitity->getIata(). ' - '.$enitity->getNome(). ' - '. $enitity->getCidade()->getNome();
                            },
                ))
                //->add('aerodromo', 'entity', array('attr'=>array('data-sonata-select2-allow-clear'=>'true'),'class' => 'Cenipa\UserBundle\Entity\AerodromoGeral'))
                ->add('latitude')
                ->add('longitude')
                ->add('latitudeDecimal')
                ->add('longitudeDecimal')
                ->add('numeroProcesso')
                ->add('classificacao')
                
            ->end()
            
 ->with('Aeronave')
                     //->add('id', 'sonata_type_model_hidden')
                     ->add('aeronaveOcorrencia', 'sonata_type_collection',
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
        'sortable'      => 'position',
     //   'targetEntity'  => 'Cenipa\UserBundle\Entity\OcorrenciaAeronave',
     //   'admin_code'    => 'sonata.admin.ocorrencia_aeronave'
    ))
                 
 

                 ->end()

                 


                 /*
  ->with('Tripulante')
                     ->add('ocorrenciaTripulante', 'sonata_type_collection',
    array(
        
        'required'      => true,
        'type_options'  => array(
            'delete' => true),
        'by_reference'  => false,
        'mapped'        => true
    ),
    array(
        'edit'          => 'inline',
        'inline'        => 'inline',
        'sortable'      => 'position',
        'targetEntity'  => 'Cenipa\UserBundle\Entity\OcorrenciaTripulante',
        'admin_code'    => 'sonata.admin.ocorrencia_tripulante'
    ))
                 
                 ->end()
       /*                       
    ->with('Lesao')
                     ->add('ocorrenciaLesao', 'sonata_type_collection',
    array(
        
        'required'      => true,
        'type_options'  => array(
            'delete' => true),
        'by_reference'  => false,
        'mapped'        => true
    ),
    array(
        'edit'          => 'inline',
        'inline'        => 'table',
        'sortable'      => 'position',
        'targetEntity'  => 'Cenipa\UserBundle\Entity\OcorrenciaLesao',
        'admin_code'    => 'sonata.admin.ocorrencia_lesao'
    ))
                 
                 ->end()*/
                              
                              
            ->with('Tipo', 
                array(
                        'class'       => 'col-lg-12',
                        'box_class'   => 'box box-solid box-primary'
                        ))
                ->add('tipo', 'entity', array('attr'=>array('data-sonata-select2-allow-clear'=>'true'),'class' => 'Cenipa\UserBundle\Entity\TaxonomiaTipo'))
            

            ->end()
                
                

                ->with('Gerais', 
                array(
                        'class'       => 'col-lg-4',
                        'box_class'   => 'box box-solid box-primary'
                        ))
                ->add('dia', 'sonata_type_date_picker', 
                            array( 'format' => 'dd/MM/yyyy',
                                   'dp_language' => 'pt',
                                   'attr' => array('class' => 'col-sm-3')))


                ->add('horario', 'sonata_type_datetime_picker', 
                            array('format' => 'hh:mm'))

                ->add('horarioUtc', 'sonata_type_datetime_picker', 
                            array('format' => 'hh:mm'))

                ->add('danosTerceiros')
                ->add('historico')
                ->add('cadastradoPor', 'entity', array('attr'=>array('data-sonata-select2-allow-clear'=>'true'),'class' => 'Cenipa\UserBundle\Entity\FosUserUser'))
                ->add('cadastradoEm', 'sonata_type_date_picker', 
                            array( 'format' => 'dd/MM/yyyy',
                                   'dp_language' => 'pt'))
            ->end()
            
           
        ;
    }


    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('numero_processo')
			->add('tipoReporte')
			->add('situacaoRcsv')
			->add('rcsvAprovado')
            ->add('classificacao')
            ->add('dia')
            ->add('horario')
                ->add('cidade', 'entity', array('class' => 'Cenipa\UserBundle\Entity\GeografiaCidade'))
                ->add('tipo', 'entity', array('class' => 'Cenipa\UserBundle\Entity\TaxonomiaTipo'))
                ->add('aerodromo', 'entity', array('class' => 'Cenipa\UserBundle\Entity\AerodromoGeral'))
                ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('cidade')
           
        ;
    }



    public function prePersist($object){

        foreach ($object->getAeronaveOcorrencia() as $aeronave) {

            $aeronave->setOcorrencia($object);
        }
    }

    public function preUpdate($object){
        
        foreach ($object->getAeronaveOcorrencia() as $aeronave) {
            $aeronave->setOcorrencia($object);
        }
        
    }
    public function postPersist($object){

    }
}