<?php

namespace Gedmo\Sortable;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Tool\BaseTestCaseORM;
use Sortable\Fixture\Node;
use Sortable\Fixture\Item;
use Sortable\Fixture\Category;
use Sortable\Fixture\SimpleListItem;
use Sortable\Fixture\Author;
use Sortable\Fixture\Paper;
use Sortable\Fixture\Event;
use Sortable\Fixture\Customer;
use Sortable\Fixture\CustomerType;

/**
 * These are tests for sortable behavior
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @link http://www.gediminasm.org
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class SortableTest extends BaseTestCaseORM
{
    const NODE = 'Sortable\\Fixture\\Node';
    const ITEM = 'Sortable\\Fixture\\Item';
    const CATEGORY = 'Sortable\\Fixture\\Category';
    const SIMPLE_LIST_ITEM = 'Sortable\\Fixture\\SimpleListItem';
    const AUTHOR = 'Sortable\\Fixture\\Author';
    const PAPER = 'Sortable\\Fixture\\Paper';
    const EVENT = 'Sortable\\Fixture\\Event';
    const CUSTOMER = 'Sortable\\Fixture\\Customer';
    const CUSTOMER_TYPE = 'Sortable\\Fixture\\CustomerType';

    private $nodeId;

    protected function setUp()
    {
        parent::setUp();

        $evm = new EventManager();
        $evm->addEventSubscriber(new SortableListener());

        $this->getMockSqliteEntityManager($evm);
        $this->populate();
    }

    protected function tearDown()
    {
        //$this->stopQueryLog();
    }

    /**
     * @test
     */
    public function shouldSetSortPositionToInsertedNode()
    {
        $node = $this->em->find(self::NODE, $this->nodeId);
        $this->assertEquals(0, $node->getPosition());
    }

    /**
     * @test
     */
    public function testMoveLastPosition()
    {
        for ($i = 2; $i <= 10; $i++) {
            $node = new Node();
            $node->setName("Node".$i);
            $node->setPath("/");
            $this->em->persist($node);
        }
        $this->em->flush();  

        $repo = $this->em->getRepository(self::NODE);

        $node = $repo->findOneByPosition(0);
        $node->setPosition(-1);
        $this->em->flush();

        for ($i = 0; $i <= 8; $i++) {
            $node = $repo->findOneByPosition($i);
            $this->assertNotNull($node);
            $this->assertEquals('Node'.($i+2), $node->getName());
        }

        $node = $repo->findOneByPosition(9);
        $this->assertNotNull($node);
        $this->assertEquals('Node1', $node->getName());
    
    }

    /**
     * @test
     */
    public function shouldSortManyNewNodes()
    {
        for ($i = 2; $i <= 10; $i++) {
            $node = new Node();
            $node->setName("Node".$i);
            $node->setPath("/");
            $this->em->persist($node);
        }
        $this->em->flush();

        $dql = 'SELECT node FROM '.self::NODE.' node';
        $dql .= ' WHERE node.path = :path ORDER BY node.position';
        $nodes = $this->em
            ->createQuery($dql)
            ->setParameter('path', '/')
            ->getResult()
        ;

        $this->assertCount(10, $nodes);
        $this->assertEquals('Node1', $nodes[0]->getName());
        $this->assertEquals(2, $nodes[2]->getPosition());
    }

    /**
     * @test
     */
    public function shouldShiftPositionForward()
    {
        $node2 = new Node();
        $node2->setName("Node2");
        $node2->setPath("/");
        $this->em->persist($node2);

        $node = new Node();
        $node->setName("Node3");
        $node->setPath("/");
        $this->em->persist($node);

        $node = new Node();
        $node->setName("Node4");
        $node->setPath("/");
        $this->em->persist($node);

        $node = new Node();
        $node->setName("Node5");
        $node->setPath("/");
        $this->em->persist($node);

        $this->em->flush();

        $this->assertEquals(1, $node2->getPosition());
        $node2->setPosition(3);
        $this->em->persist($node2);
        $this->em->flush();

        $repo = $this->em->getRepository(self::NODE);
        $nodes = $repo->getBySortableGroups(array('path' => '/'));

        $this->assertEquals('Node1', $nodes[0]->getName());
        $this->assertEquals('Node3', $nodes[1]->getName());
        $this->assertEquals('Node4', $nodes[2]->getName());
        $this->assertEquals('Node2', $nodes[3]->getName());
        $this->assertEquals('Node5', $nodes[4]->getName());

        for ($i = 0; $i < count($nodes); $i++) {
            $this->assertSame($i, $nodes[$i]->getPosition());
        }
    }

    /**
     * @test
     */
    public function shouldShiftPositionBackward()
    {
        $node = new Node();
        $node->setName("Node2");
        $node->setPath("/");
        $this->em->persist($node);

        $node = new Node();
        $node->setName("Node3");
        $node->setPath("/");
        $this->em->persist($node);

        $node2 = new Node();
        $node2->setName("Node4");
        $node2->setPath("/");
        $this->em->persist($node2);

        $node = new Node();
        $node->setName("Node5");
        $node->setPath("/");
        $this->em->persist($node);

        $this->em->flush();
        $this->assertEquals(3, $node2->getPosition());

        $node2->setPosition(1);
        $this->em->persist($node2);
        $this->em->flush();
        $this->em->clear(); // to reload from database

        $repo = $this->em->getRepository(self::NODE);
        $nodes = $repo->getBySortableGroups(array('path' => '/'));

        $this->assertEquals('Node1', $nodes[0]->getName());
        $this->assertEquals('Node4', $nodes[1]->getName());
        $this->assertEquals('Node2', $nodes[2]->getName());
        $this->assertEquals('Node3', $nodes[3]->getName());
        $this->assertEquals('Node5', $nodes[4]->getName());

        for ($i = 0; $i < count($nodes); $i++) {
            $this->assertSame($i, $nodes[$i]->getPosition());
        }
    }

    /**
     * @test
     */
    public function shouldSyncPositionAfterDelete()
    {
        $repo = $this->em->getRepository(self::NODE);

        $node2 = new Node();
        $node2->setName("Node2");
        $node2->setPath("/");
        $this->em->persist($node2);

        $node3 = new Node();
        $node3->setName("Node3");
        $node3->setPath("/");
        $this->em->persist($node3);

        $this->em->flush();

        $node1 = $repo->findOneByName('Node1');
        $this->em->remove($node2);
        $this->em->flush();

        // test if synced on objects in memory correctly
        $this->assertEquals(0, $node1->getPosition());
        $this->assertEquals(1, $node3->getPosition());

        // test if persisted correctly
        $this->em->clear();
        $nodes = $repo->findAll();
        $this->assertCount(2, $nodes);
        $this->assertEquals(0, $nodes[0]->getPosition());
        $this->assertEquals(1, $nodes[1]->getPosition());
    }

    /**
     * This is a test case for issue #1209
     * @test
     */
    public function shouldRollbackPositionAfterExceptionOnDelete()
    {
        $repo = $this->em->getRepository(self::CUSTOMER_TYPE);

        $customerType1 = new CustomerType();
        $customerType1->setName("CustomerType1");
        $this->em->persist($customerType1);

        $customerType2 = new CustomerType();
        $customerType2->setName("CustomerType2");
        $this->em->persist($customerType2);

        $customerType3 = new CustomerType();
        $customerType3->setName("CustomerType3");
        $this->em->persist($customerType3);

        $customer = new Customer();
        $customer->setName("Customer");
        $customer->setType($customerType2);
        $this->em->persist($customer);

        $this->em->flush();

        try {
            // now delete the second customer type, which should fail
            // because of the foreign key reference
            $this->em->remove($customerType2);
            $this->em->flush();

            $this->fail('Foreign key constraint violation exception not thrown.');
        } catch (ForeignKeyConstraintViolationException $e) {
            $customerTypes = $repo->findAll();

            $this->assertCount(3, $customerTypes);

            $this->assertEquals(0, $customerTypes[0]->getPosition(), 'The sorting position has not been rolled back.');
            $this->assertEquals(1, $customerTypes[1]->getPosition(), 'The sorting position has not been rolled back.');
            $this->assertEquals(2, $customerTypes[2]->getPosition(), 'The sorting position has not been rolled back.');
        }
    }

    /**
     * @test
     */
    public function shouldGroupByAssociation()
    {
        $category1 = new Category();
        $category1->setName("Category1");
        $this->em->persist($category1);
        $category2 = new Category();
        $category2->setName("Category2");
        $this->em->persist($category2);
        $this->em->flush();

        $item3 = new Item();
        $item3->setName("Item3");
        $item3->setCategory($category1);
        $this->em->persist($item3);

        $item4 = new Item();
        $item4->setName("Item4");
        $item4->setCategory($category1);
        $this->em->persist($item4);

        $this->em->flush();

        $item1 = new Item();
        $item1->setName("Item1");
        $item1->setPosition(0);
        $item1->setCategory($category1);
        $this->em->persist($item1);

        $item2 = new Item();
        $item2->setName("Item2");
        $item2->setPosition(0);
        $item2->setCategory($category1);
        $this->em->persist($item2);

        $item2 = new Item();
        $item2->setName("Item2_2");
        $item2->setPosition(0);
        $item2->setCategory($category2);
        $this->em->persist($item2);
        $this->em->flush();

        $item1 = new Item();
        $item1->setName("Item1_2");
        $item1->setPosition(0);
        $item1->setCategory($category2);
        $this->em->persist($item1);
        $this->em->flush();

        $repo = $this->em->getRepository(self::CATEGORY);
        $category1 = $repo->findOneByName('Category1');
        $category2 = $repo->findOneByName('Category2');

        $repo = $this->em->getRepository(self::ITEM);

        $items = $repo->getBySortableGroups(array('category' => $category1));

        $this->assertEquals("Item1", $items[0]->getName());
        $this->assertEquals("Category1", $items[0]->getCategory()->getName());

        $this->assertEquals("Item2", $items[1]->getName());
        $this->assertEquals("Category1", $items[1]->getCategory()->getName());

        $this->assertEquals("Item3", $items[2]->getName());
        $this->assertEquals("Category1", $items[2]->getCategory()->getName());

        $this->assertEquals("Item4", $items[3]->getName());
        $this->assertEquals("Category1", $items[3]->getCategory()->getName());

        $items = $repo->getBySortableGroups(array('category' => $category2));

        $this->assertEquals("Item1_2", $items[0]->getName());
        $this->assertEquals("Category2", $items[0]->getCategory()->getName());

        $this->assertEquals("Item2_2", $items[1]->getName());
        $this->assertEquals("Category2", $items[1]->getCategory()->getName());
    }

    /**
     * @test
     */
    public function shouldGroupByNewAssociation()
    {
        $category1 = new Category();
        $category1->setName("Category1");

        $item1 = new Item();
        $item1->setName("Item1");
        $item1->setPosition(0);
        $item1->setCategory($category1);
        $this->em->persist($item1);
        $this->em->persist($category1);
        $this->em->flush();

        $repo = $this->em->getRepository(self::CATEGORY);
        $category1 = $repo->findOneByName('Category1');

        $repo = $this->em->getRepository(self::ITEM);

        $items = $repo->getBySortableGroups(array('category' => $category1));

        $this->assertEquals("Item1", $items[0]->getName());
        $this->assertEquals("Category1", $items[0]->getCategory()->getName());
    }

    /**
     * @test
     */
    public function shouldInsertInbetween()
    {
        $this->markTestIncomplete('Currently it is not supported to change the position of a record and insert a new one in front of it in one step.');

        $item1 = new Item();
        $item1->setName("Item1");
        $this->em->persist($item1);

        $item3 = new Item();
        $item3->setName("Item3");
        $this->em->persist($item3);

        $this->em->flush();

        // update $item3's position
        $item3->setPosition(2);

        // and insert a further item between $item1 and $item3
        $item2 = new Item();
        $item2->setName("Item2");
        $item2->setPosition(1);
        $this->em->persist($item2);

        $this->em->flush();

        $repo = $this->em->getRepository(self::ITEM);
        $items = $repo->findBy(array(), array('position' => 'asc'));

        $this->assertEquals("Item1", $items[0]->getName());
        $this->assertEquals(0, $items[0]->getPosition());
        $this->assertEquals("Item2", $items[1]->getName());
        $this->assertEquals(1, $items[1]->getPosition());
        $this->assertEquals("Item3", $items[2]->getName());
        $this->assertEquals(2, $items[2]->getPosition());
    }

    /**
     * @test
     */
    public function shouldGroupByDateTimeValue()
    {
        $event1 = new Event();
        $event1->setDateTime(new \DateTime("2012-09-15 00:00:00"));
        $event1->setName("Event1");
        $this->em->persist($event1);
        $event2 = new Event();
        $event2->setDateTime(new \DateTime("2012-09-15 00:00:00"));
        $event2->setName("Event2");
        $this->em->persist($event2);
        $event3 = new Event();
        $event3->setDateTime(new \DateTime("2012-09-16 00:00:00"));
        $event3->setName("Event3");
        $this->em->persist($event3);

        $this->em->flush();

        $event4 = new Event();
        $event4->setDateTime(new \DateTime("2012-09-15 00:00:00"));
        $event4->setName("Event4");
        $this->em->persist($event4);

        $event5 = new Event();
        $event5->setDateTime(new \DateTime("2012-09-16 00:00:00"));
        $event5->setName("Event5");
        $this->em->persist($event5);

        $this->em->flush();

        $this->assertEquals(0, $event1->getPosition());
        $this->assertEquals(1, $event2->getPosition());
        $this->assertEquals(0, $event3->getPosition());
        $this->assertEquals(2, $event4->getPosition());
        $this->assertEquals(1, $event5->getPosition());
    }

    /**
     * @test
     */
    public function shouldFixIssue219()
    {
        $item1 = new SimpleListItem();
        $item1->setName("Item 1");
        $this->em->persist($item1);

        $this->em->flush();

        $item1->setName("Update...");
        $item1->setPosition(1);
        $this->em->persist($item1);
        $this->em->flush();

        $this->em->remove($item1);
        $this->em->flush();
    }

    /**
     * @test
     */
    public function shouldFixIssue226()
    {
        $paper1 = new Paper();
        $paper1->setName("Paper1");
        $this->em->persist($paper1);

        $paper2 = new Paper();
        $paper2->setName("Paper2");
        $this->em->persist($paper2);

        $author1 = new Author();
        $author1->setName("Author1");
        $author1->setPaper($paper1);

        $author2 = new Author();
        $author2->setName("Author2");
        $author2->setPaper($paper1);

        $author3 = new Author();
        $author3->setName("Author3");
        $author3->setPaper($paper2);

        $this->em->persist($author1);
        $this->em->persist($author2);
        $this->em->persist($author3);
        $this->em->flush();

        $this->assertEquals(0, $author1->getPosition());
        $this->assertEquals(1, $author2->getPosition());
        $this->assertEquals(0, $author3->getPosition());

        //update position
        $author3->setPaper($paper1);
        $author3->setPosition(0); // same as before, no changes
        $this->em->persist($author3);
        $this->em->flush();

        $this->assertEquals(1, $author1->getPosition());
        $this->assertEquals(2, $author2->getPosition());
        $this->assertEquals(0, $author3->getPosition());

        // this is failing for whatever reasons
        $author3->setPosition(0);
        $this->em->persist($author3);
        $this->em->flush();

        $this->em->clear(); // @TODO: this should not be required

        $author1 = $this->em->find(self::AUTHOR, $author1->getId());
        $author2 = $this->em->find(self::AUTHOR, $author2->getId());
        $author3 = $this->em->find(self::AUTHOR, $author3->getId());

        $this->assertEquals(1, $author1->getPosition());
        $this->assertEquals(2, $author2->getPosition());
        $this->assertEquals(0, $author3->getPosition());
    }

    /**
     * @test
     */
    public function shouldFixIssue275()
    {
        $nodes = array();
        for ($i = 2; $i <= 10; $i++) {
            $node = new Node();
            $node->setName("Node".$i);
            $node->setPath("/");
            $this->em->persist($node);
            $nodes[] = $node;
        }
        $this->em->flush();

        $node1 = $this->em->find(self::NODE, $this->nodeId);
        $this->em->remove($node1);
        $this->em->flush();

        for ($i = 1; $i <= 9; $i++) {
            $nodes[$i-1]->setPosition($i);
            $this->em->persist($nodes[$i-1]);
        }
        $this->em->flush();
    }

    /**
     * @test
     */
    public function shouldFixIssue1445()
    {
        $paper1 = new Paper();
        $paper1->setName("Paper1");
        $this->em->persist($paper1);

        $paper2 = new Paper();
        $paper2->setName("Paper2");
        $this->em->persist($paper2);

        $author1 = new Author();
        $author1->setName("Author1");
        $author1->setPaper($paper1);

        $author2 = new Author();
        $author2->setName("Author2");
        $author2->setPaper($paper1);

        $this->em->persist($author1);
        $this->em->persist($author2);
        $this->em->flush();

        $this->assertEquals(0, $author1->getPosition());
        $this->assertEquals(1, $author2->getPosition());

        //update position
        $author2->setPaper($paper2);
        $author2->setPosition(0); // Position has changed author2 was at position 1 in paper1 and now 0 in paper2, so it can be in changeSets
        $this->em->persist($author2);
        $this->em->flush();

        $this->assertEquals(0, $author1->getPosition());
        $this->assertEquals(0, $author2->getPosition());

        $this->em->clear(); // @TODO: this should not be required

        $repo = $this->em->getRepository(self::AUTHOR);
        $author1 = $repo->findOneBy(['id' => $author1->getId()]);
        $author2 = $repo->findOneBy(['id' => $author2->getId()]);

        $this->assertEquals(0, $author1->getPosition());
        $this->assertEquals(0, $author2->getPosition());
    }

    /**
     * @test
     */
    public function shouldFixIssue1462()
    {
        $paper1 = new Paper();
        $paper1->setName("Paper1");
        $this->em->persist($paper1);

        $paper2 = new Paper();
        $paper2->setName("Paper2");
        $this->em->persist($paper2);

        $author1 = new Author();
        $author1->setName("Author1");
        $author1->setPaper($paper1);

        $author2 = new Author();
        $author2->setName("Author2");
        $author2->setPaper($paper1);

        $author3 = new Author();
        $author3->setName("Author3");
        $author3->setPaper($paper2);

        $author4 = new Author();
        $author4->setName("Author4");
        $author4->setPaper($paper2);

        $author5 = new Author();
        $author5->setName("Author5");
        $author5->setPaper($paper1);

        $this->em->persist($author1);
        $this->em->persist($author2);
        $this->em->persist($author3);
        $this->em->persist($author4);
        $this->em->persist($author5);
        $this->em->flush();

        $this->assertEquals(0, $author1->getPosition());
        $this->assertEquals(1, $author2->getPosition());
        $this->assertEquals(2, $author5->getPosition());

        $this->assertEquals(0, $author3->getPosition());
        $this->assertEquals(1, $author4->getPosition());

        // update paper: the position is still 1.
        $author4->setPaper($paper1);
        $this->em->persist($author4);
        $this->em->flush();

        $this->assertEquals(0, $author1->getPosition());
        $this->assertEquals(1, $author4->getPosition());
        $this->assertEquals(2, $author2->getPosition());
        $this->assertEquals(3, $author5->getPosition());

        $this->assertEquals(0, $author3->getPosition());

        $this->em->clear(); // @TODO: this should not be required

        $repo = $this->em->getRepository(self::AUTHOR);
        $author1 = $repo->findOneBy(['id' => $author1->getId()]);
        $author2 = $repo->findOneBy(['id' => $author2->getId()]);
        $author3 = $repo->findOneBy(['id' => $author3->getId()]);
        $author4 = $repo->findOneBy(['id' => $author4->getId()]);
        $author5 = $repo->findOneBy(['id' => $author5->getId()]);

        $this->assertEquals(0, $author1->getPosition());
        $this->assertEquals(1, $author4->getPosition());
        $this->assertEquals(2, $author2->getPosition());
        $this->assertEquals(3, $author5->getPosition());

        $this->assertEquals(0, $author3->getPosition());
    }

    /**
     * @test
     */
    public function positionShouldBeTheSameAfterFlush()
    {
        $nodes = array();
        for ($i = 2; $i <= 10; $i++) {
            $node = new Node();
            $node->setName("Node".$i);
            $node->setPath("/");
            $this->em->persist($node);
            $nodes[] = $node;
        }
        $this->em->flush();

        $node1 = $this->em->find(self::NODE, $this->nodeId);
        $node1->setPosition(5);

        $this->em->flush();

        $this->assertEquals(5, $node1->getPosition());

        $this->em->detach($node1);
        $node1 = $this->em->find(self::NODE, $this->nodeId);
        $this->assertEquals(5, $node1->getPosition());
    }

    /**
     * @test
     */
    public function testIncrementPositionOfLastObjectByOne()
    {
        $node0 = $this->em->find(self::NODE, $this->nodeId);

        $nodes = array($node0);

        for ($i = 2; $i <= 5; $i++) {
            $node = new Node();
            $node->setName("Node".$i);
            $node->setPath("/");
            $this->em->persist($node);
            $nodes[] = $node;
        }
        $this->em->flush();

        $this->assertEquals(4, $nodes[4]->getPosition());

        $node4NewPosition = $nodes[4]->getPosition();
        $node4NewPosition++;

        $nodes[4]->setPosition($node4NewPosition);

        $this->em->persist($nodes[4]);
        $this->em->flush();

        $this->assertEquals(4, $nodes[4]->getPosition());
    }

    /**
     * @test
     */
    public function testSetOutOfBoundsHighPosition()
    {
        $node0 = $this->em->find(self::NODE, $this->nodeId);

        $nodes = array($node0);

        for ($i = 2; $i <= 5; $i++) {
            $node = new Node();
            $node->setName("Node".$i);
            $node->setPath("/");
            $this->em->persist($node);
            $nodes[] = $node;
        }
        $this->em->flush();

        $this->assertEquals(4, $nodes[4]->getPosition());

        $nodes[4]->setPosition(100);

        $this->em->persist($nodes[4]);
        $this->em->flush();

        $this->assertEquals(4, $nodes[4]->getPosition());
    }

    protected function getUsedEntityFixtures()
    {
        return array(
            self::NODE,
            self::ITEM,
            self::CATEGORY,
            self::SIMPLE_LIST_ITEM,
            self::AUTHOR,
            self::PAPER,
            self::EVENT,
            self::CUSTOMER,
            self::CUSTOMER_TYPE,
        );
    }

    private function populate()
    {
        $node = new Node();
        $node->setName("Node1");
        $node->setPath("/");

        $this->em->persist($node);
        $this->em->flush();
        $this->nodeId = $node->getId();
    }
}
