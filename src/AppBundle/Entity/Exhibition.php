<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;
use Sonata\TranslationBundle\Model\Gedmo\TranslatableInterface;
use Sonata\TranslationBundle\Model\Gedmo\AbstractPersonalTranslatable;
use Application\Sonata\MediaBundle\Entity\Media;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Exhibition.
 *
 * @ORM\Table(name="exhibition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExhibitionRepository")
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ExhibitionTranslation")
 * @UniqueEntity("slug")
 */
class Exhibition extends AbstractPersonalTranslatable implements TranslatableInterface
{
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @Assert\Type("string")
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Gedmo\Translatable
     * @ORM\Column(name="location_place", type="string", length=255)
     */
    private $locationPlace;

    /**
     * @Gedmo\Slug(fields={"title"}, updatable=false)
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(name="open_date_time", type="datetimetz")
     */
    private $openDateTime;

    /**
     * @var \DateTime
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(name="close_date_time", type="datetimetz")
     */
    private $closeDateTime;

    /**
     * @var Media
     * @Assert\Type("object")
     * @ORM\OneToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media")
     */
    private $poster;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ORM\Column(name="facebook_event", type="string", length=255)
     */
    private $facebookEvent;

    /**
     * @var ArrayCollection|ArtWork[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\ArtWork", mappedBy="exhibitions", cascade={"persist"})
     */
    private $artWorks;

    /**
     * @var ArrayCollection|Media[]
     * @ORM\ManyToMany(targetEntity="\Application\Sonata\MediaBundle\Entity\Media", inversedBy="exhibitions")
     */
    private $photos;

    /**
     * @var ArrayCollection|ExhibitionTranslation[]
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\ExhibitionTranslation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    public function __construct()
    {
        parent::__construct();
        $this->images = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Exhibition
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Exhibition
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set location.
     *
     * @param string $location
     *
     * @return Exhibition
     */
    public function setLocationPlace($location)
    {
        $this->locationPlace = $location;

        return $this;
    }

    /**
     * Get location.
     *
     * @return string
     */
    public function getLocationPlace()
    {
        return $this->locationPlace;
    }
    /**
     * Get slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return ArtWork
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Set open date.
     *
     * @param \DateTime $date
     *
     * @return Exhibition
     */
    public function setOpenDateTime($date)
    {
        $this->openDateTime = $date;

        return $this;
    }

    /**
     * Get open date.
     *
     * @return \DateTime
     */
    public function getOpenDateTime()
    {
        return $this->openDateTime;
    }

    /**
     * Set close date.
     *
     * @param \DateTime $date
     *
     * @return Exhibition
     */
    public function setCloseDateTime($date)
    {
        $this->closeDateTime = $date;

        return $this;
    }

    /**
     * Get close date.
     *
     * @return \DateTime
     */
    public function getCloseDateTime()
    {
        return $this->closeDateTime;
    }

    /**
     * Set fb event link.
     *
     * @param string $link
     *
     * @return Exhibition
     */
    public function setFacebookEvent($link)
    {
        $this->facebookEvent = $link;

        return $this;
    }

    /**
     * Get fb event link.
     *
     * @return string
     */
    public function getFacebookEvent()
    {
        return $this->facebookEvent;
    }

    /**
     * Set poster.
     *
     * @param Media $poster
     *
     * @return Exhibition
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * Get poster.
     *
     * @return Media
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Add art work.
     *
     * @param ArtWork $artWork
     *
     * @return Exhibition
     */
    public function addArtWork($artWork)
    {
        if (!$artWork) {
            $this->artWorks = new ArrayCollection();
        }

        if (!$this->artWorks->contains($artWork)) {
            $this->artWorks->add($artWork);
            $artWork->addExhibition($this);
        }

        return $this;
    }

    /**
     * Remove art work.
     *
     * @param Media $artWork
     *
     * @return Exhibition
     */
    public function removeArtWork($artWork)
    {
        $this->getArtWorks()->removeElement($artWork);

        return $this;
    }

    /**
     * Get art works.
     *
     * @return ArrayCollection
     */
    public function getArtWorks()
    {
        return $this->artWorks;
    }

    /**
     * Add photos.
     *
     * @param Media $photo
     *
     * @return Exhibition
     */
    public function addPhoto($photo)
    {
        if (!$photo) {
            $this->photos = new ArrayCollection();
        }

        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->addExhibition($this);
        }

        return $this;
    }

    /**
     * Remove photo.
     *
     * @param Media $photo
     *
     * @return Exhibition
     */
    public function removePhoto($photo)
    {
        $this->getPhotos()->removeElement($photo);

        return $this;
    }

    /**
     * Get photos.
     *
     * @return ArrayCollection
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
