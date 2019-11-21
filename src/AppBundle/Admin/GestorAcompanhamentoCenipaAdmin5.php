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




class GestorAcompanhamentoCenipaAdmin5 extends AbstractAdmin{
    //put your code here
    // protected $emName = 'unidade';
    use AdminExtraExportTrait;

    protected $baseRouteName = 'acompanhamento_cenipa5';
    protected $baseRoutePattern = 'page-gestor-acompanhamento-cenipa5';



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
            ->setParameter('unidade', 6);


        return $query;
    }


    protected function configureFormFields(FormMapper $formMapper)
    {
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
