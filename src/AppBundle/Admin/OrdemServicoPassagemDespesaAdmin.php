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
use AppBundle\Entity\TbOrdemServicoPassagemAereaDespesa as Despesa;
use AppBundle\Entity\TbOrdemServicoAeroporto as Aeroporto;
use AppBundle\Entity\TbNaturezaDespesa as NaturezaDespesa;


use Knp\Menu\ItemInterface as MenuItemInterface;




class OrdemServicoPassagemDespesaAdmin extends AbstractAdmin{
    //put your code here
   // protected $emName = 'unidade';
   protected $objDespesa;
      protected $objAeroporto;

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            
			    ->add('dataRegistro', 'sonata_type_date_picker',
                        array('label'=>'Selecione a data','dp_language'=>'pt','format'=>'dd/MM/yyyy',
                            'dp_use_current' => true,
                            ))
					  ->add('tbNaturezaDespesa')
				     ->add('ordemAeroporto')

					  
                  
					  ->add('valorAlocado')

				
	

					

					

					


                  
        ;
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('dataRegistro')
					  ->add('tbNaturezaDespesa', 'text')
				     ->add('ordemAeroporto', 'text')

					  
                  
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
          
					  ->add('tbNaturezaDespesa')
				     ->add('ordemAeroporto')

					  
                  
               
        ;
    }
	
	/* public function prePersist($object) {
			$this->objDespesa = new Despesa();
			
			$this->objAeroporto = new Aeroporto();
			$this->objDespesa->setValorAlocado($object->getValorPassagem());
			$this->objDespesa->setOrdemAeroporto($objAeroporto->getId());
			$this->objDespesa->setTbNaturezaDespesa(5);
			$em = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbOrdemServicoPassagemAereaDespesa');
			$em->persist($this->objDespesa);
    }
	
	
	
	public function preUpdate($object) {
			
			$this->objDespesa = new Despesa();
			$this->objAeroporto = new Aeroporto();
			$this->objNaturezaDespesa = new NaturezaDespesa();
			

			
			
			$this->objDespesa->setValorAlocado($object->getValorPassagem());
			var_dump($this->objDespesa->setOrdemAeroporto($this->objAeroporto->getId()));
			$this->objNaturezaDespesa->getTbNaturezaDespesa();
			$em = $this->getModelManager()->getEntityManager('AppBundle\Entity\TbOrdemServicoPassagemAereaDespesa');
			$em->persist($this->objDespesa);
          
    }
	*/
	
}
