<?php

namespace AppBundle\Admin;

use AppBundle\Entity\ArtWork;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArtWorkAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Art work')
                ->add('title', 'text')
                ->add('description', 'text')
                ->add('materials', 'text')
                ->add('slug', 'text')
                ->add('width', 'integer')
                ->add('height', 'integer')
                ->add(
                'date',
                'sonata_type_datetime_picker',
                   [
                    'dp_side_by_side'       => false,
                    'dp_use_current'        => false,
                    'dp_use_seconds'        => false,
                    'dp_use_minutes'        => false,
                    'format' => "dd/MM/yyyy",
                   ]
                )
                ->add('price', 'money', array(
                    'currency' => 'USD',
                    'grouping' => true
                ))
                ->add('inStock', 'choice', array(
                       'choices' => array(
                           'Available' => true,
                           'Sold' => false,
                  ),
                ))
                ->add('picture', 'file')
                ->add('images', 'file', array(
                     'multiple' => true
                 ))
            ->end()
            ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('materials')
            ->add('slug')
            ->add('width')
            ->add('height')
            ->add('date')
            ->add('price')
            ->add('inStock')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('materials')
            ->add('slug')
            ->add('width')
            ->add('height')
            ->add('date')
            ->add('price')
            ->add('inStock')
            ->add('picture')
        ;
    }

    public function toString($object)
    {
        return $object instanceof ArtWork
            ? $object->getTitle()
            : 'ArtWork';
    }
}