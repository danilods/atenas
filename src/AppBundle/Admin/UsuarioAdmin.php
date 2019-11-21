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




class UsuarioAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
		
		 
        $formMapper
		
		
				 ->with('Adicionar usuário', ['class' => 'col-md-9'])
						->add('nome', null, array(
						'label' => 'Nome COMPLETO:'
						))
						->add('nomeGuerra', null, array(
							'label' => 'Nome de Guerra:'
						))
						->add('tipoAtividade', 'choice', array(
								'choices' => array(

									'R1' => 'SIM',
									'' => 'NÃO'

								),
								'label' => 'Militar da reserva?',
								'required'=>true,
								'expanded' => true,
								'multiple' => false
							))
						
						->add('setorDivisao', null, array(
						'label' => 'Função:'
					))
						->add('tbPostoGraduacao', null, array(
							'label' => 'Posto/Graduação:'
						))
						
						->add('quadro', null, array(
							'label' => 'Quadro/especialidade:'
						))
						
						->add('ativo', null, array(
							'label' => 'Usuário ativo?'
						))
						
					
					
						
						->add('telefone', 'text', array(
							'label' => 'Celular:'
						))
						->add('cpf','text' , array(
							'label' => 'CPF:'
						))
						->add('identidade', 'text', array(
							'label' => 'Identidade:'
						))
						->add('saram','text', array(
							'label' => 'SARAM:'
						))
					
				 
				->end()
				->with('Dados financeiros', ['class' => 'col-md-3'])
				
					->add('auxilioAlimentacao', 'money', array(
							'label' => 'Auxílio alimentação:',
							'currency' => 'BRL',
							'grouping' =>true))
					->add('auxilioTransporte', 'money', array(
							'label' => 'Auxílio transporte:',
							'currency' => 'BRL',
							'grouping' =>true))
					->add('banco', null, array(
						'label' => 'Banco:'
					))
					->add('agencia', null, array(
						'label' => 'Agência:'
					))
					->add('contaCorrente', null, array(
						'label' => 'Conta Corrente:'
					))
					
                    ->add('email', null, array(
						'label' => 'email:'
					))
				
				
				->end()
		
				
		
		
                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
             ->add('nome', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_usuario.html.twig', 'label' => 'Dados do usuário'))
                    
					
					
						
					->add('banco', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_dados_bancarios.html.twig', 'label' => 'Dados bancários'))
					
         

					->add('diariasExcedidas', null, array('template' => 'SonataAdminBundle:CRUD:custom_list_user_diarias.html.twig', 'label' => 'Execução de diárias'))

					
					->add('ativo', null, 
					array('editable' => true))
					
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
           ->add('nome', null, array(
						'label' => 'Nome:'
					))
                    ->add('nomeGuerra', null, array(
						'label' => 'Nome de Guerra:'
					))
					->add('tbPostoGraduacao', null, array(
						'label' => 'Função:'
					))
					
					->add('telefone', null, array(
						'label' => 'Telefone:'
					))
					->add('cpf', null, array(
						'label' => 'CPF:'
					))
					->add('pcdp', null, array(
						'label' => 'PCDP:'
					))
					->add('banco', null, array(
						'label' => 'Banco:'
					))
					->add('agencia', null, array(
						'label' => 'Agência:'
					))
					->add('contaCorrente', null, array(
						'label' => 'Conta Corrente:'
					))
					->add('setorDivisao', null, array(
						'label' => 'Função:'
					))
					
					
                    ->add('email', null, array(
						'label' => 'mail:'
					))
               
        ;
    }
}
