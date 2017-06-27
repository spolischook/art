<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Exhibition;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ExhibitionAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Basic', ['class' => 'col-md-8'])
            ->add('title', 'text', ['label' => 'Title'])
            ->add(
                'description',
                'textarea',
                [
                    'attr' => [
                        'style' => 'height:400px',
                    ],
                    'label' => 'Full description',
                    'required' => false,
                ]
            )
            ->end()
            ->with('Status', ['class' => 'col-md-4'])
            ->add(
                'openDateTime',
                'sonata_type_datetime_picker',
                [
                    'dp_side_by_side' => false,
                    'dp_use_current' => false,
                    'dp_use_seconds' => false,
                    'dp_use_minutes' => false,
                    'format' => 'dd/MM/yyyy HH:mm',
                    'label' => 'Creation date',
                ]
            )
            ->add(
                'closeDateTime',
                'sonata_type_datetime_picker',
                [
                    'dp_side_by_side' => false,
                    'dp_use_current' => false,
                    'dp_use_seconds' => false,
                    'dp_use_minutes' => false,
                    'format' => 'dd/MM/yyyy HH:mm',
                    'label' => 'Creation date',
                ]
            )
            ->add('locationPlace', 'text', ['label' => 'Location'])
            ->add('facebookEvent', 'text')
            ->end()
            ->with('Art Works', ['class' => 'col-md-4'])
            ->add(
                'artWorks',
                'sonata_type_model',
                [
                    'label' => ' ',
                    'multiple' => true,
                    'property' => 'title',
                ],
                [
                    'inline' => 'table',
                    'sortable' => 'position',
                ]
            )
            ->end()
            ->with('Info', ['class' => 'col-md-8'])
            ->add('slug', 'text', ['label' => 'Slug'])
            ->add(
                'poster',
                'sonata_type_model_list',
                [
                    'btn_list' => true,
                ],
                [
                    'link_parameters' => [
                        'context' => 'art work',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ]
            )
            ->end()
            ->with('Photos', ['class' => 'col-md-4'])
            ->add(
                'galleryHasMedia',
                'sonata_type_collection',
                [
                    'required' => false,
                    'label' => ' ',
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'targetEntity' => 'Application\Sonata\MediaBundle\Entity\GalleryHasMedia',
                    'admin_code' => 'sonata.media.admin.gallery_has_media',
                    'link_parameters' => [
                        'context' => 'additional images',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ]
            )
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, ['label' => 'Title'])
            ->add('locationPlace', null, ['label' => 'Location'])
            ->add('openDateTime', null, ['label' => 'Date']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('poster', 'srting', ['label' => 'Poster', 'template' => '::admin/avatar.html.twig'])
            ->add('title', 'srting')
            ->add('locationPlace', 'srting', ['label' => 'Poster'])
            ->add('openDateTime', 'date', ['label' => 'Date'])
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    public function toString($object)
    {
        return $object instanceof Exhibition
            ? $object->getTitle()
            : 'Exhibition';
    }
}
