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
use AppBundle\Entity\TbMovimentacaoDespesaOs as DespesaOs;
use AppBundle\Entity\TbOsControle as OsControle;

use AppBundle\Entity\TbNaturezaDespesa as NaturezaDespesa;

use AppBundle\Entity\TbCalculoDespesaOs as CalculoDespesaOs;
use AppBundle\Entity\TbMovimentacaoDespesaPassagem as DespesaPassagem;
use Whyte624\SonataAdminExtraExportBundle\Admin\AdminExtraExportTrait;
use Sonata\AdminBundle\Route\RouteCollection;


use Knp\Menu\ItemInterface as MenuItemInterface;




class GestorAcompanhamentoCenipaAdmin4 extends AbstractAdmin{
    //put your code here
    // protected $emName = 'unidade';
    use AdminExtraExportTrait;

     protected $baseRouteName = 'acompanhamento_cenipa4';
    protected $baseRoutePattern = 'page-gestor-acompanhamento-cenipa4';



    public function getExportFiels(){
        return array('numeroOrdemServico', 'inicioMissao');
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('pdf', $this->getRouterIdParameter().'/pdf');
        $collection->add('firpa', $this->getRouterIdParameter().'/firpa');
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();


        $query->innerJoin($query->getRootAlias().'.setorId','s')
            ->innerJoin('s.tbDivisao','d')

            ->innerJoin('d.unidade','u')
            ->where('u.id = :unidade')
            //  ->andWhere('d.id = :divisao')
            ->setParameter('unidade', 5);


        return $query;
    }


    protected function configureFormFields(FormMapper $formMapper)
    {
            $formMapper

            ->tab('DADOS DA ORDEM DE SERVIÇO')
            ->with('ORDEM DE SERVIÇO', array(
                'class' => 'col-md-5',
                'box_class' => 'box box-solid box-primary',
                'description' => 'Relatório ao Cenipa para Segurança de Voo',
                // ...
            ))
            ->add('numeroOrdemServico', null, array(
                    'label' => 'Número OS',
                    'read_only' => true,
                    'disabled' => true
                )
            )
            ->add('tbUsuario', 'text', array(
                    'label' => 'Requisitante:',
                    'read_only' => true,
                    'disabled' => true
                )
            )

            ->add('setorId', 'text', array(
                    'label' => 'Divisão',
                    'read_only' => true,
                    'disabled' => true
                )
            )
            
            
           
            
            ->add('omPagadora', null, array(
                'label' => 'OM pagadora:'
            ))
            
             ->add('naturezaMissao', null, array(
                'label' => 'Natureza da Missão:'
            ))
            ->add('tbTaxonomiaNaturezaDespesa', null, array(
                'label' => 'Natureza de Despesa:'
            ))
            
            ->add('custoEstimado', 'money', array(
                'currency' => 'BRL',
                'grouping' =>true))

            ->add('despesasContaPropria', 'choice', array(
                'choices' => array(


                    'SIM' => 'SIM',
                    'NAO' => 'NAO',

                ),
                'label' => 'Despesas por conta própria?',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))
            ->add('contaUniao', 'choice', array(
                'choices' => array(


                    'SIM' => 'SIM',
                    'NAO' => 'NAO',

                ),
                'label' => 'Conta da União?',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))
           
           
            ->add('disponibilidadeFinanceira', 'choice', array(
                'choices' => array(


                    'SIM' => 'SIM',
                    'NAO' => 'NAO',

                ),
                'label' => 'Disponibilidade financeira?',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))
            ->add('quantidadeAcrescimo', null, array(
                'label' => 'Quantidade de acréscimo:'
            ))
            ->add('observacoes', null, array(
                'label' => 'Observações:'
            ))
            ->add('quantidadeDiarias', null ,array(

                'attr' => array(
                    'class' => 'col-md-2 quantidade_diarias '
                )))
                
            ->add('diariasCompletas')
                    
            ->add('meiaDiaria')
                    
                    
                    
            ->add('totalDiarias')
            
            ->add('modificacaoDiarias', 'choice', array(
                'choices' => array(


                    'SIM' => 'SIM',
                    'NAO' => 'NAO',

                ),
                'label' => 'Houve modificação de diárias?',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))
            ->add('justificativaAntecipacao', null, array(
                'label' => 'Justificativa antecipação:'
            ))

           


            ->end()


            ->with('AUTORIZAÇÃO DE DIÁRIAS', array(
                'class' => 'col-md-7',
                'box_class' => 'box box-solid box-warning',
                // ...

            ))
            ->add('statusOs', 'choice', array(
                'choices' => array(
                    
                    'PENDENTE' => 'ORDEM DE SERVIÇO PENDENTE DE APROVAÇÃO',
                    'ANALISADA' => 'APROVAR ORDEM DE SERVIÇO E ENCAMINHAR AO ORDENADOR DE DESPESAS',
                    'AUTORIZADA' => 'ORDEM DE SERVIÇO AUTORIZADA PELO ORDENADOR DE DESPESAS',
                    'EM PROCESSAMENTO' => 'ORDEM DE SERVIÇO EM PROCESSAMENTO DE DIÁRIAS',
                    'PROCESSADA' => 'ORDEM DE SERVIÇO PROCESSADA E ENCAMINHADA PARA PAGAMENTO',
                    'CANCELADA' => 'CANCELAR ORDEM DE SERVIÇO',




                ),
                'label' => 'Definir status da ORDEM de SERVIÇO',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))

            
             






            ->end()
            
            
            
            ->with('EMISSÃO DE PASSAGENS', array(
                'class' => 'col-md-7',
                'box_class' => 'box box-solid box-success',
                // ...

            ))
            ->add('statusPassagem', 'choice', array(
                'choices' => array(

                    '0' => 'NÃO EMITIR PASSAGEM AÉREA',
                    '1' => 'SOLICITAR EMISSÃO DE PASSAGEM AÉREA',
        

                ),
                'label' => 'Definir status da Passagem Aérea',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
            ))
            ->end()
            



    /*
            ->with('Controle e acompanhanmento', array(
                'class' => 'col-md-7',
                'box_class' => 'box box-solid box-primary',
                'description' => '',
                // ...
            ))

            ->add('controle', 'sonata_type_collection',
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





            ->end()*/

            ->end()

            
            
            ->tab('ROTEIRO MISSÃO')
            ->with('TRECHOS', array(
                'class' => 'col-md-12',
                'box_class' => 'box box-solid box-primary',
                'description' => '',
            ))

            ->add('roteiro', 'sonata_type_collection',
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
            
            ->end()
            ->tab('PASSAGEM AÉREA')
            ->with('REQUISIÇÃO DE PASSAGEM', array(
                'class' => 'col-md-12',
                'box_class' => 'box box-solid box-primary',
                'description' => '',
            ))

            ->add('aeroporto', 'sonata_type_collection',
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
            
            ->end()




        ;

           }





    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('numeroOrdemServico', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_numero_os.html.twig', 'label' => 'Número da OS'))

            ->add('inicioMissao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_periodo_missao.html.twig', 'label' => 'Período e localidade da missão'))

            ->add('naturezaMissao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_missao.html.twig', 'label' => 'Tipo de missão'))
            ->add('tbNaturezaDespesa', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_natureza.html.twig', 'label' => 'Custo e natureza de despesa'))

            ->add('statusOs', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_status_os.html.twig', 'label' => 'Status'))

                    ;
    }




    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('numeroOrdemServico')
            ->add('inicioMissao')
            ->add('retornoMissao')
            ->add('despesasContaPropria')
            ->add('contaUniao')
            ->add('pernoiteMissao')
            ->add('acrescimentoDeslocamento')
            ->add('disponibilidadeFinanceira')
            ->add('quantidadeAcrescimo')
            ->add('observacoes')
            ->add('quantidadeDiarias')
            ->add('totalDiarias')
            ->add('custoEstimado')
            ->add('modificacaoDiarias')
            ->add('justificativaAntecipacao')
            ->add('cidade')
            ->add('naturezaMissao')

        ;
    }


    

}
