<?php

namespace Tool;

// common
use Doctrine\Common\EventManager;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriver;
// orm specific
use Doctrine\ORM\Mapping\DefaultQuoteStrategy;
use Doctrine\ORM\Mapping\DefaultNamingStrategy;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver as AnnotationDriverORM;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
// odm specific
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver as AnnotationDriverODM;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\MongoDB\Connection;
// listeners
use Gedmo\Translatable\TranslatableListener;
use Gedmo\Sluggable\SluggableListener;
use Gedmo\Tree\TreeListener;
use Gedmo\Timestampable\TimestampableListener;
use Gedmo\Loggable\LoggableListener;
use Doctrine\ORM\Repository\DefaultRepositoryFactory as DefaultRepositoryFactoryORM;
use Doctrine\ODM\MongoDB\Repository\DefaultRepositoryFactory as DefaultRepositoryFactoryODM;

/**
 * Base test case contains common mock objects
 * generation methods for multi object manager
 * test cases
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @link http://www.gediminasm.org
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
abstract class BaseTestCaseOM extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EventManager
     */
    protected $evm;

    /**
     * Initialized document managers
     *
     * @var DocumentManager[]
     */
    private $dms = array();

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        foreach ($this->dms as $dm) {
            if ($dm) {
                foreach ($dm->getDocumentDatabases() as $db) {
                    foreach ($db->listCollections() as $collection) {
                        $collection->drop();
                    }
                }
                $dm->getConnection()->close();
                $dm = null;
            }
        }
    }

    /**
     * DocumentManager mock object together with
     * annotation mapping driver and database
     *
     * @param string        $dbName
     * @param MappingDriver $mappingDriver
     *
     * @return DocumentManager
     */
    protected function getMockDocumentManager($dbName, MappingDriver $mappingDriver = null)
    {
        if (!class_exists('Mongo')) {
            $this->markTestSkipped('Missing Mongo extension.');
        }
        $conn = new Connection();
        $config = $this->getMockAnnotatedODMMongoDBConfig($dbName, $mappingDriver);

        $dm = null;
        try {
            $dm = DocumentManager::create($conn, $config, $this->getEventManager());
            $dm->getConnection()->connect();
        } catch (\MongoException $e) {
            $this->markTestSkipped('Doctrine MongoDB ODM failed to connect');
        }

        return $dm;
    }

    /**
     * DocumentManager mock object with
     * annotation mapping driver
     *
     * @param string        $dbName
     * @param MappingDriver $mappingDriver
     *
     * @return DocumentManager
     */
    protected function getMockMappedDocumentManager($dbName, MappingDriver $mappingDriver = null)
    {
        $conn = $this->getMockBuilder('Doctrine\\MongoDB\\Connection')->getMock();
        $config = $this->getMockAnnotatedODMMongoDBConfig($dbName, $mappingDriver);

        $dm = DocumentManager::create($conn, $config, $this->getEventManager());

        return $dm;
    }

    /**
     * EntityManager mock object together with
     * annotation mapping driver and pdo_sqlite
     * database in memory
     *
     * @param array         $fixtures
     * @param MappingDriver $mappingDriver
     *
     * @return EntityManager
     */
    protected function getMockSqliteEntityManager(array $fixtures, MappingDriver $mappingDriver = null)
    {
        $conn = array(
            'driver' => 'pdo_sqlite',
            'memory' => true,
        );

        $config = $this->getMockAnnotatedORMConfig($mappingDriver);
        $em = EntityManager::create($conn, $config, $this->getEventManager());

        $schema = array_map(function ($class) use ($em) {
            return $em->getClassMetadata($class);
        }, $fixtures);

        $schemaTool = new SchemaTool($em);
        $schemaTool->dropSchema(array());
        $schemaTool->createSchema($schema);

        return $em;
    }

    /**
     * EntityManager mock object with
     * annotation mapping driver
     *
     * @param MappingDriver $mappingDriver
     *
     * @return EntityManager
     */
    protected function getMockMappedEntityManager(MappingDriver $mappingDriver = null)
    {
        $driver = $this->getMockBuilder('Doctrine\DBAL\Driver')->getMock();
        $driver->expects($this->once())
            ->method('getDatabasePlatform')
            ->will($this->returnValue($this->getMockBuilder('Doctrine\DBAL\Platforms\MySqlPlatform')->getMock()));

        $conn = $this->getMockBuilder('Doctrine\DBAL\Connection')
            ->setConstructorArgs(array(), $driver)
            ->getMock();

        $conn->expects($this->once())
            ->method('getEventManager')
            ->will($this->returnValue($evm ?: $this->getEventManager()));

        $config = $this->getMockAnnotatedConfig();
        return EntityManager::create($conn, $config);
    }

    /**
     * Creates default mapping driver
     *
     * @return MappingDriver
     */
    protected function getDefaultORMMetadataDriverImplementation()
    {
        return new AnnotationDriverORM($_ENV['annotation_reader']);
    }

    /**
     * Creates default mapping driver
     *
     * @return MappingDriver
     */
    protected function getDefaultMongoODMMetadataDriverImplementation()
    {
        return new AnnotationDriverODM($_ENV['annotation_reader']);
    }

    /**
     * Build event manager
     *
     * @return EventManager
     */
    private function getEventManager()
    {
        if (null === $this->evm) {
            $this->evm = new EventManager();
            $this->evm->addEventSubscriber(new TreeListener());
            $this->evm->addEventSubscriber(new SluggableListener());
            $this->evm->addEventSubscriber(new LoggableListener());
            $this->evm->addEventSubscriber(new TranslatableListener());
            $this->evm->addEventSubscriber(new TimestampableListener());
        }

        return $this->evm;
    }

    /**
     * Get annotation mapping configuration
     *
     * @param string                                     $dbName
     * @param MappingDriver $mappingDriver
     *
     * @return \Doctrine\ORM\Configuration
     */
    private function getMockAnnotatedODMMongoDBConfig($dbName, MappingDriver $mappingDriver = null)
    {
        if (null === $mappingDriver) {
            $mappingDriver = $this->getDefaultMongoODMMetadataDriverImplementation();
        }
        $config = new \Doctrine\ODM\MongoDB\Configuration();
        $config->addFilter("softdeleteable", 'Gedmo\\SoftDeleteable\\Filter\\ODM\\SoftDeleteableFilter');
        $config->setProxyDir(__DIR__."/../../temp");
        $config->setHydratorDir(__DIR__."/../../temp");
        $config->setProxyNamespace("Proxy");
        $config->setHydratorNamespace("Hydrator");
        $config->setDefaultDB("gedmo_extensions_test");
        $config->setAutoGenerateProxyClasses(true);
        $config->setAutoGenerateHydratorClasses(true);
        $config->setMetadataDriverImpl($mappingDriver);
        return $config;
    }

    /**
     * Get annotation mapping configuration for ORM
     *
     * @param MappingDriver $mappingDriver
     *
     * @return \Doctrine\ORM\Configuration
     */
    private function getMockAnnotatedORMConfig(MappingDriver $mappingDriver = null)
    {
        $config = $this->getMockBuilder('Doctrine\ORM\Configuration')->getMock();
        $config->expects($this->once())
            ->method('getProxyDir')
            ->will($this->returnValue(__DIR__.'/../../temp'));

        $config->expects($this->once())
            ->method('getProxyNamespace')
            ->will($this->returnValue('Proxy'));

        $config->expects($this->any())
            ->method('getDefaultQueryHints')
            ->will($this->returnValue(array()));

        $config->expects($this->once())
            ->method('getAutoGenerateProxyClasses')
            ->will($this->returnValue(true));

        $config->expects($this->once())
            ->method('getClassMetadataFactoryName')
            ->will($this->returnValue('Doctrine\\ORM\\Mapping\\ClassMetadataFactory'));

        $config
            ->expects($this->any())
            ->method('getDefaultRepositoryClassName')
            ->will($this->returnValue('Doctrine\\ORM\\EntityRepository'))
        ;

        $config
            ->expects($this->any())
            ->method('getQuoteStrategy')
            ->will($this->returnValue(new DefaultQuoteStrategy()))
        ;

        $config
            ->expects($this->any())
            ->method('getNamingStrategy')
            ->will($this->returnValue(new DefaultNamingStrategy()))
        ;
        if (null === $mappingDriver) {
            $mappingDriver = $this->getDefaultORMMetadataDriverImplementation();
        }

        $config->expects($this->any())
            ->method('getMetadataDriverImpl')
            ->will($this->returnValue($mappingDriver));

        $config
            ->expects($this->once())
            ->method('getRepositoryFactory')
            ->will($this->returnValue(new DefaultRepositoryFactoryORM()));

        return $config;
    }
}
