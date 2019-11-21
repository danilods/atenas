<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Admin;

/**
 * Description of AeronaveGeralAdmin
 *
 * @author cenipa
 */

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AeronaveGeralAdmin extends AbstractAdmin{
    //put your code here
    
    
    
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
            ->addIdentifier('matricula')
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
