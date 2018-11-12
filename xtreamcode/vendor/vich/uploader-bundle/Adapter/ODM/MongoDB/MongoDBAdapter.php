<?php

namespace Vich\UploaderBundle\Adapter\ODM\MongoDB;

use Vich\UploaderBundle\Adapter\AdapterInterface;

/**
 * MongoDBAdapter.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class MongoDBAdapter implements AdapterInterface
{
    /**
     * {@inheritDoc}
     */
    public function getObjectFromArgs($event)
    {
        return $event->getDocument();
    }

    /**
     * {@inheritDoc}
     */
    public function recomputeChangeSet($event)
    {
        $object = $this->getObjectFromArgs($event);

        $dm = $event->getDocumentManager();
        $uow = $dm->getUnitOfWork();
        $metadata = $dm->getClassMetadata(get_class($object));
        $uow->recomputeSingleDocumentChangeSet($metadata, $object);
    }
}
