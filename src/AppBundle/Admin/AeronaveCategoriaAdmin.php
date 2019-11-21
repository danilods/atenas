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
class AeronaveCategoriaAdmin extends AbstractAdmin{
    //put your code here
    
    

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nome')
            ->add('nomeCodigo')
            ->add('regulamento')
            ->add('aviacao')
            
       ;         
        
    }
     protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nome')
            ->add('nomeCodigo')
            ->add('regulamento')
            ->add('aviacao')
           
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
           ->add('nome')
              
               
        ;
    }
}


