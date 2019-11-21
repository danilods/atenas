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

use Knp\Menu\ItemInterface as MenuItemInterface;
/**
 * Description of AerodromoAdmin
 *
 * @author danilodesouza
 */
class AeronaveOperadorAdmin extends AbstractAdmin{
    //put your code here
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nomeOperador')
            ->add('nomeCodigo')
            ->add('cpfCnpj')
            ->add('endereco')
            ->add('cep')
            ->add('telefone1')
            ->add('telefone2')
                ->add('cidade', 'entity', array('class' => 'AppBundle\Entity\GeografiaCidade'))
                       
                          

       ;         
        
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nomeOperador')
            ->add('nomeCodigo')
            ->add('cpfCnpj')
            ->add('endereco')
            ->add('cep')
            ->add('telefone1')
            ->add('telefone2')
            ->add('cidade', 'entity', array('class' => 'AppBundle\Entity\GeografiaCidade'))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
           ->add('nomeOperador')
              
               
        ;
    }
}



