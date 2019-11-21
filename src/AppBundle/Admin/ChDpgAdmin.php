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
use AppBundle\Entity\TbMovimentacaoDespesaOs as Despesa;
use AppBundle\Entity\TbMovimentacaoDespesaPassagem as DespesaPassagem;

use AppBundle\Controller\GestorSeripaAdminController as GestorController;



use Knp\Menu\ItemInterface as MenuItemInterface;




class ChDpgAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
   protected $baseRouteName = 'os_cenipa_dpg';
     protected $baseRoutePattern = 'page-dpg-cenipa';
	 
	 
  	public function createQuery($context = 'list') {
    $query = parent::createQuery($context);

    $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

   
        $query->innerJoin($query->getRootAlias().'.setorId','s')
              ->innerJoin('s.tbDivisao','d')
			  ->innerJoin('d.unidade','u')
              ->where('u.id = :unidade')
			  ->andWhere('d.id = :divisao ')
			  ->andWhere($query->getRootAliases()[0]. '.tipoMissao = :status')

			  ->setParameter('unidade', 1)
			  			  ->setParameter('status', 'NACIONAL')

			  ->setParameter('divisao', 1);
			  
		
   
		$query->andWhere(
				$query->expr()->eq($query->getRootAliases()[0]. '.statusOs', ':my_param2')
		
   );
	    $query->setParameter('my_param2', 'PENDENTE');
              
    

    return $query;
}

    protected function configureFormFields(FormMapper $formMapper)
    {
       $formMapper

            ->tab('DADOS DA ORDEM DE SERVIÇO')
            ->with('ORDEM DE SERVIÇO', array(
                'class' => 'col-md-5',
                'box_class' => 'box box-solid box-primary',
                // ...
            ))
			
			->add('missaoCusto', null, array(
							'label' => 'Missão sem custo?'
						))
						
			->add('missaoPagaOutraOm', null, array(
							'label' => 'Custeada por outra OM?'
						))
			
            ->add('tipoMissao', 'choice', array(
                'choices' => array(

                    'NACIONAL' => 'MISSÃO NACIONAL',
                    'PLAMTAX' => 'MISSÃO PLAMTAX',
                    'EXTRAPLAMTAX' => 'MISSÃO EXTRA PLAMTAX'

                ),
                'label' => 'Tipo de missão:',
                'required'=>true,
                'expanded' => true,
                'multiple' => false
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

            ->add('descricaoMissao', null, array(
                    'label' => 'Descrição da missão:',
                    'read_only' => false,
                    'disabled' => false
                )
            )

            

            
            ->add('observacoes', null, array(
                'label' => 'Observações:'
            ))
            ->add('quantidadeDiarias')
				
			->add('diariasCompletas')
					
			->add('meiaDiaria')
					
					
					
            ->add('totalDiarias')

            ->add('auxilioAlimentacao', 'money', array(
                'label' => 'Auxílio alimentação:',
                'currency' => 'BRL',
                'grouping' =>true))

            ->add('auxilioTransporte', 'money', array(
                'label' => 'Auxílio transporte:',
                'currency' => 'BRL',
                'grouping' =>true))

            ->add('custoEstimado', 'money', array(
                'currency' => 'BRL',
                'grouping' =>true))
				
			->add('pagamentoAntecipado', null, array(
							'label' => 'Pagamento antecipado?'
						))
			
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

            ->add('naturezaMissao', null, array(
                'label' => 'Natureza da Missão:'
            ))
            ->add('tbTaxonomiaNaturezaDespesa', null, array(
                'label' => 'Natureza de Despesa:'
            ))
			
			->add('omPagadora', null, array(
                'label' => 'OM pagadora:'
            ))





            ->end()


            ->with('APROVAÇÃO DA ORDEM DE SERVIÇO', array(
                'class' => 'col-md-7',
                'box_class' => 'box box-solid box-warning',
                // ...

            ))
            ->add('statusOs', 'choice', array(
                'choices' => array(
                    'PENDENTE' => 'ORDEM DE SERVIÇO PENDENTE DE APROVAÇÃO',
                    'CONFIRMADA' => 'CONFIRMAR O.S E ENCAMINHAR AO ORDENADOR DE DESPESAS',
             		'CANCELADA' => 'CANCELAR ORDEM DE SERVIÇO',
					'NAO AUTORIZADA' => 'NAO AUTORIZAR ORDEM DE SERVIÇO'




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

                    '0' => 'CANCELAR EMISSÃO DE PASSAGEM',
                    '1' => 'EMISSÃO DE PASSAGEM SOLICITADA',
                 


                ),
                'label' => 'Definir status da Passagem Aérea',
                'required'=>false,
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
                       ->add('roteiro',null, array('associated_tostring' => 'getSaida'))
            ->add('naturezaMissao', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_missao.html.twig', 'label' => 'Tipo de missão'))
            ->add('tbNaturezaDespesa', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_tipo_natureza.html.twig', 'label' => 'Custo e natureza de despesa'))

            ->add('statusOs', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_status_os.html.twig', 'label' => 'Status'))

            ->add('_action', 'actions', array(
                'actions' => array(

                    'edit' => array(),


                )
            ))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('numeroOrdemServico', null, array(
                'label' => 'Número OS:'
            ))
            ->add('descricaoMissao', null, array(
                'label' => 'Descricao da missão:'
            ))

            ->add('observacoes', null, array(
                'label' => 'Observacoes:'
            ))

            ->add('justificativaAntecipacao', null, array(
                'label:' => 'Justificativa'
            ))
            ->add('naturezaMissao', null, array(
                'Atividade:'
            ))
            ->add('tbUsuario.nome', null, array(
                'label' => 'Nome do participante'
            ))
            ->add('roteiro.geografiaCidade.nome', null, array(
                'label' => 'Cidade:'
            ))

        ;
    }
	
	
	 public function prePersist($object) {

         foreach ($object->getAeroporto() as $aeroporto) {

            $aeroporto->setOrdemServico($object);



        }
		
		foreach ($object->getRoteiro() as $roteiro) {

            $roteiro->setOrdemServico($object);

	}



    }
	
	
	public function preUpdate($object) {

       


        foreach ($object->getAeroporto() as $aeroporto) {

            $aeroporto->setOrdemServico($object);



        }
		
		foreach ($object->getRoteiro() as $roteiro) {

            $roteiro->setOrdemServico($object);

	}
		
		

     
    }

  
}
