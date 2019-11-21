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




class TaxonomiaNaturezaDespesaAdmin extends AbstractAdmin{
    //put your code here
    protected $emName = 'unidade';
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
		
						->with('Tipo de Natureza de Despesa', ['class' => 'col-md-6'])
						->add('tipoNatureza', null, array(
							'label' => 'Sigla do Posto:',
							'attr' => array('placeholder' => 'Ex: 33.000.00')
						))
						->end()
						
					   ->with('Descrição', ['class' => 'col-md-6'])
					   ->add('descricaoNatureza', null, array(
							'label' => 'Detalhes Natureza de despesa:'
						))
					   
					   ->end()
          
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->add('tipoNatureza')
            ->add('descricaoNatureza');
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('tipoNatureza')
            ->add('descricaoNatureza')
               
        ;
    }
}
