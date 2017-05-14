<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\Validator\Constraints as Assert;
use Sonata\TranslationBundle\Model\TranslatableInterface;
use Application\Sonata\MediaBundle\Entity\Media;
use Symfony\Component\Validator\Tests\Fixtures\Entity;

/**
 * Exhibition.
 *
 * @ORM\Table(name="exhibition")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExhibitionRepository")
 */
class Exhibition implements TranslatableInterface
{
    use ORMBehaviors\Timestampable\Timestampable;
    use ORMBehaviors\Translatable\Translatable;

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
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

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

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->photos = new ArrayCollection();
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
     * @return Entity
     */
    public function setTitle($title)
    {
        $this->translate(null, false)->setTitle($title);

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->translate(null, false)->getTitle();
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
        $this->translate(null, false)->setDescription($description);

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->translate(null, false)->getDescription();
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Exhibition
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Set location.
     *
     * @param string $location
     *
     * @return Exhibition
     */
    public function setLocation($location)
    {
        $this->translate(null, false)->setLocation($location);

        return $this;
    }

    /**
     * Get location.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->translate(null, false)->getLocation();
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

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->setCurrentLocale($locale);

        return $this;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getCurrentLocale();
    }
}
