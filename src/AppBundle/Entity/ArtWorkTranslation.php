<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="art_work_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="lookup_unique_art_work_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class ArtWorkTranslation extends AbstractPersonalTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ArtWork", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}
