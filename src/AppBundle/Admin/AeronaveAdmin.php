<?php

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


/**
 * Description of AerodromoAdmin
 *
 * @author danilodesouza
 */
class AeronaveAdmin extends AbstractAdmin{
    
    protected $emName = 'taxonomia';
    
    //put your code here
    
    
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
             ->add('matricula')
            ->add('anoFabricacao')
            ->add('classificacao')
            ->add('equipamento')
            ->add('fabricanteCodigo')
            ->add('fabricanteNome')
            ->add('modelo')
                       ->add('classe')
                            ->add('tipoIcao')
                            ->add('tipoMotor')
                            ->add('quantidadeMotor')
                            ->add('tipoTremPouso')
                            ->add('numeroAssentos')
                            ->add('numeroSerie')
                            ->add('passageirosMaximo')
                            ->add('pesoMaxDecolagem')
                            ->add('fabricanteNome')
                            ->add('tripulacaoMinima')
                            ->add('nacionalidadeFabricacao')
                            ->add('nacionalidadeProjeto')
                            ->add('nacionalidadeRegistro')


                
        ;
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('matricula')
            ->add('anoFabricacao')
            ->add('classificacao')
            ->add('equipamento')
            ->add('fabricanteCodigo')
            ->add('fabricanteNome')
            ->add('modelo')
           ->add('classe')
                ->add('tipoIcao')
                ->add('tipoMotor')
                ->add('quantidadeMotor')
                ->add('tipoTremPouso')
                ->add('numeroAssentos')
                ->add('numeroSerie')
                ->add('passageirosMaximo')
                ->add('pesoMaxDecolagem')
                ->add('fabricanteNome')
            ->add('tripulacaoMinima')
                            ->add('nacionalidadeFabricacao')
                            ->add('nacionalidadeProjeto')
                            ->add('nacionalidadeRegistro')

       ;         
        
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('matricula', 'text')
            ->add('anoFabricacao')
            ->add('classificacao')
            ->add('equipamento')
            ->add('fabricanteCodigo')
            ->add('fabricanteNome')
            ->add('modelo')
                       ->add('classe')
                            ->add('tipoIcao')
                            ->add('tipoMotor')
                            ->add('quantidadeMotor')
                            ->add('tipoTremPouso')
                            ->add('numeroAssentos')
                            ->add('numeroSerie')
                            ->add('passageirosMaximo')
                            ->add('pesoMaxDecolagem')
            ->add('tripulacaoMinima')
                            ->add('nacionalidadeFabricacao')
                            ->add('nacionalidadeProjeto')
                            ->add('nacionalidadeRegistro')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
           ->add('matricula')
              
               
        ;
    }
}


