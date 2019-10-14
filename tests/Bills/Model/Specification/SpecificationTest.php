<?php

namespace Tests\Bills\Model\Specification;

use Bills\Model\Bill\Factories\DocumentFactory;
use Bills\Model\Bill\Factories\StatusIdFactory;
use Bills\Model\Bill\Specification\BarCodeUnique;
use SharedKernel\Model\Specification\AndSpecification;
use SharedKernel\Model\Specification\NotSpecification;
use SharedKernel\Model\Specification\OrSpecification;
use Tests\BaseUnitTestCase;

class SpecificationTest extends BaseUnitTestCase
{

    public function testShouldSatisfyByBarCodeUnique()
    {
        $status = StatusIdFactory::create();
        $document = DocumentFactory::create($status, '2022-10-10', $this->faker()->buildingNumber);

        $mockBillsRepository = \Mockery::mock('Bills\Infrastructure\Persistence\Repositories\BillsRepositoryInMemory');
        $mockBillsRepository->shouldReceive('countFor')
        ->once()
        ->andReturn(0);

        $specBarCodeUnique = new BarCodeUnique($mockBillsRepository);
        $this->assertTrue($specBarCodeUnique->isSatisfiedBy($document));

    }

    /*public function testShouldSatisfyByBothCriteria()
    {

        $customer = new Customer();
        $orderRepository = new OrderRepository();

        $spec = new AndSpecification(
            new CustomerIsGold($orderRepository),
            new CustomerHasOverdueInvoices($orderRepository)
        );

        $this->assertTrue($spec->isSatisfiedBy($customer));

    }

    public function testShouldSatisfyByAtLeastOneCriteria()
    {

        $customer = new Customer();
        $orderRepository = new OrderRepository();

        $spec = new OrSpecification(
            new CustomerIsGold($orderRepository),
            new CustomerHasOverdueInvoices($orderRepository)
        );

        $this->assertTrue($spec->isSatisfiedBy($customer));

    }

    public function testShouldSatisfyByNoneOfThemCriteria()
    {

        $customer = new Customer();
        $orderRepository = new OrderRepository();

        $spec = new NotSpecification(new DocumentIsAbleTo($orderRepository));

        $this->assertTrue($spec->isSatisfiedBy($customer));

    }

    public function testShouldSatisfyByCompositeAndCriteria()
    {

        $customer = new Customer();
        $orderRepository = new OrderRepository();

        $spec = new AndSpecification(
            new CustomerIsGold($orderRepository),
            new CustomerHasOverdueInvoices($orderRepository)
        );

        $specOverDue = new CustomerHasOverdueInvoices($orderRepository);
        $compositeSpec = $spec->andSpecification($specOverDue);

        $this->assertTrue($compositeSpec->isSatisfiedBy($customer));

    }

    public function testShouldSatisfyByCompositeOrCriteria()
    {

        $customer = new Customer();
        $orderRepository = new OrderRepository();

        $spec = new AndSpecification(
            new CustomerIsGold($orderRepository),
            new CustomerHasOverdueInvoices($orderRepository)
        );

        $specAbleTo = new DocumentIsAbleTo($orderRepository);
        $compositeSpec = $spec->orSpecification($specAbleTo);

        $this->assertTrue($compositeSpec->isSatisfiedBy($customer));

    }*/

}