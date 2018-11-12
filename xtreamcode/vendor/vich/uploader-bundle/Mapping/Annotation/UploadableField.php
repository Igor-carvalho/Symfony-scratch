<?php

namespace Vich\UploaderBundle\Mapping\Annotation;

/**
 * UploadableField.
 *
 * @Annotation
 * @Target({"PROPERTY"})
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class UploadableField
{
    /**
     * @var string $mapping
     */
    protected $mapping;

    /**
     * @var string $fileNameProperty
     */
    protected $fileNameProperty;

    /**
     * Constructs a new instance of UploadableField.
     *
     * @param  array                     $options The options.
     * @throws \InvalidArgumentException
     */
    public function __construct(array $options)
    {
        if (isset($options['mapping'])) {
            $this->mapping = $options['mapping'];
        } else {
            throw new \InvalidArgumentException('The "mapping" attribute of UploadableField is required.');
        }

        if (isset($options['fileNameProperty'])) {
            $this->fileNameProperty = $options['fileNameProperty'];
        }
    }

    /**
     * Gets the mapping name.
     *
     * @return string The mapping name.
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Gets the file name property.
     *
     * @return string The file name property.
     */
    public function getFileNameProperty()
    {
        return $this->fileNameProperty;
    }
}
