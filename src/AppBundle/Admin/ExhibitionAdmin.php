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
            ->add('description', 'textarea',
                [
                    'attr' => [
                        'style' => 'height:400px',
                    ],
                    'label' => 'Full description',
                ])
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
            ->add('location', 'text')
            ->add('facebookEvent', 'text')
            ->end()
            ->with('Art Works', ['class' => 'col-md-4'])
            ->add(
                'artWorks',
                'sonata_type_model',
                [
                    'label' => 'Art works',
                    'multiple' => true,
                    'property' => 'title',
                ],
                [
                    'inline' => 'table',
                    'sortable' => 'position',
                ])
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
                        'context' => 'picture',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ])
            ->end()
            ->with('Photos', ['class' => 'col-md-4'])
            ->add(
                'photos',
                'sonata_type_model',
                [
                    'label' => 'Additional images',
                    'multiple' => true,
                ],
                [
                    'inline' => 'table',
                    'sortable' => 'position',
                    'link_parameters' => [
                        'context' => 'foto',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ]
            )
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('translations.title', null, ['label' => 'Title'])
            ->add('translations.location', null, ['label' => 'Location'])
            ->add('openDateTime', null, ['label' => 'Date']);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('poster', 'srting', ['label' => 'Poster', 'template' => '::SonataAdmin/avatar.html.twig'])
            ->add('title', 'srting')
            ->add('location', 'srting')
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
