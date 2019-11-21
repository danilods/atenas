<?php

namespace Cenipa\UserBundle\AbstractAdmin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Cenipa\UserBundle\Entity\OcorrenciaGeral;


use Cenipa\UserBundle\Entity\GeografiaCidade;

use Cenipa\UserBundle\Entity\TaxonomiaTipo;

use Cenipa\UserBundle\Entity\AerodromoGeral;





class OcorrenciaAeronaveAdmin extends AbstractAdmin
{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('origem')
            ->add('destinoObs')
                ->add('alternativaObs')
                ->add('operadorDetalhe')
                ->add('operacao')
                ->add('danos')
                ->add('custoReparo')
                 ->add('observacoes')
                 ->add('aeronave')
                ->add('alternativaVoo')
                ->add('categoria')
                ->add('faseVoo')
            //    ->add('ocorrencia')
                ->add('operador')
                ->add('origemVoo')
              



                
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
               
             //  ->add('ocorrencia', 'sonata_type_admin')
                ->add('origemVoo', 'sonata_type_model_autocomplete', array(
                          'class' => 'Cenipa\UserBundle\Entity\AerodromoGeral',
                          'property' => array('nome','icao', 'iata'),
                          'minimum_input_length' => 1,
                          'to_string_callback' => function($enitity, $property) {
                                return $enitity->getIcao(). ' - '.$enitity->getIata(). ' - '.$enitity->getNome(). ' - '. $enitity->getCidade()->getNome();
                            },
                ))
                ->add('origemObs')
                
                ->add('destinoVoo', 'sonata_type_model_autocomplete', array(
                          'class' => 'Cenipa\UserBundle\Entity\AerodromoGeral',
                          'property' => array('nome','icao', 'iata'),
                          'minimum_input_length' => 1,
                          'to_string_callback' => function($enitity, $property) {
                                return $enitity->getIcao(). ' - '.$enitity->getIata(). ' - '.$enitity->getNome(). ' - '. $enitity->getCidade()->getNome();
                            },
                ))

                
                ->add('destinoObs')
                
                ->add('alternativaVoo', 'sonata_type_model_autocomplete', array(
                          'class' => 'Cenipa\UserBundle\Entity\AerodromoGeral',
                          'property' => array('nome','icao', 'iata'),
                          'minimum_input_length' => 1,
                          'to_string_callback' => function($enitity, $property) {
                                return $enitity->getIcao(). ' - '.$enitity->getIata(). ' - '.$enitity->getNome(). ' - '. $enitity->getCidade()->getNome();
                            },
                ))
                
                ->add('alternativaObs')
                
                ->add('operador', 'sonata_type_model_autocomplete', array(
                          'class' => 'Cenipa\UserBundle\Entity\AeronaveOperador',
                          'property' => 'nomeOperador',
                          'minimum_input_length' => 1
                ))
                ->add('operadorDetalhe')
                
                ->add('operacao')
                
                
                ->add('danos')
                
                ->add('custoReparo')
                
                ->add('observacoes')          
    
                //->add('cidade', 'entity', array('attr'=>array('data-sonata-select2-allow-clear'=>'true'),'class' => 'Cenipa\UserBundle\Entity\GeografiaCidade'))               
                

               /* ->add('aeronave', 'sonata_type_model_autocomplete', array(
                          'class' => 'Cenipa\UserBundle\Entity\AeronaveGeral',
                          'property' => 'matricula',
                          'minimum_input_length' => 2
                ))*/

                 ->add('aeronave', 'sonata_type_model_autocomplete', array(
                          'class' => 'Cenipa\UserBundle\Entity\AeronaveGeral',
                          'property' => 'matricula',
                          'minimum_input_length' => 1,
                          'to_string_callback' => function($enitity, $property) {
                                return 'MATRÍCULA: '. $enitity->getMatricula(). ' FABRICANTE: '.$enitity->getFabricanteNome(). ' MODELO: '.$enitity->getModelo(). ' PESO MÁXIMO DECOLAGEM: '.$enitity->getPesoMaxDecolagem(). ' EQUIPAMENTO: '.$enitity->getEquipamento();
                            },
                ))
                //->add('aerodromo', 'entity', array('attr'=>array('data-sonata-select2-allow-clear'=>'true'),'class' => 'Cenipa\UserBundle\Entity\AerodromoGeral'))
                
                

                ->add('categoria', 'sonata_type_model_autocomplete', array(
                          'class' => 'Cenipa\UserBundle\Entity\AeronaveCategoria',
                          'property' => 'nome',
                          'minimum_input_length' => 1
                ))
                
               
                
                ->add('faseVoo', 'sonata_type_model_autocomplete', array(
                          'class' => 'Cenipa\UserBundle\Entity\TaxonomiaFasevoo',
                          'property' => 'nome',
                          'minimum_input_length' => 1
                ))
                                
                
            ->end()
            ->with('Tripulante')
                     ->add('aeronaveTripulante', 'sonata_type_collection',
    array(
        
        'required'      => true,
        'type_options'  => array(
          'cascade_validation' => true,
          'delete' => true),
        'by_reference'  => false,
        'mapped'        => true
    ),
    array(
        'edit'          => 'inline',
        'inline'        => 'inline',
        'sortable'      => 'position',
      //  'targetEntity'  => 'Cenipa\UserBundle\Entity\OcorrenciaTripulante',
      //  'admin_code'    => 'sonata.admin.ocorrencia_tripulante'
    ))
                 
                 ->end()
            
          ->with('Lesao')
                     ->add('aeronaveLesao', 'sonata_type_collection',
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
        //'targetEntity'  => 'Cenipa\UserBundle\Entity\OcorrenciaLesao',
       // 'admin_code'    => 'sonata.admin.ocorrencia_lesao'
    ))
                 
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
            ->add('dia')
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
        $datagridMapper
           
        ;
    }

       public function prePersist($object){

        foreach ($object->getAeronaveTripulante() as $aeronave) {

            $aeronave->setAeronaveOcorrencia($object);
            $aeronave->setOcorrencia($object);
        }
           foreach ($object->getAeronaveLesao() as $aeronave) {
           $aeronave->setAeronaveOcorrencia($object);
            $aeronave->setOcorrencia($object);
        }
    }

    public function preUpdate($object){
        
        foreach ($object->getAeronaveTripulante() as $aeronave) {
            $aeronave->setAeronaveOcorrencia($object);
            $aeronave->setOcorrencia($object);
        }
           foreach ($object->getAeronaveLesao() as $aeronave) {
            $aeronave->setAeronaveOcorrencia($object);
            $aeronave->setOcorrencia($object);
        }
        
    }
}