<?php

namespace Tests\SharedKernel\Model\Specification;

use PHPUnit\Framework\TestCase;
use SharedKernel\Sample\Specification\Customer;
use SharedKernel\Sample\Specification\CustomerIsAbleTo;
use SharedKernel\Sample\Specification\CustomerIsGold;
use SharedKernel\Sample\Specification\CustomerHasOverdueInvoices;
use SharedKernel\Sample\Specification\OrderRepository;
use SharedKernel\Model\Specification\AndSpecification;
use SharedKernel\Model\Specification\NotSpecification;
use SharedKernel\Model\Specification\OrSpecification;

class SpecificationTest extends TestCase
{

    public function testShouldSatisfyBySingleCriteria()
    {
        $customer = new Customer();
        $orderRepository = new OrderRepository();

        $specOverDue = new CustomerHasOverdueInvoices($orderRepository);
        $this->assertTrue($specOverDue->isSatisfiedBy($customer));

        $specGold = new CustomerIsGold($orderRepository);
        $this->assertTrue($specGold->isSatisfiedBy($customer));

    }

    public function testShouldSatisfyByBothCriteria()
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

        $spec = new NotSpecification(new CustomerIsAbleTo($orderRepository));

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

        $specAbleTo = new CustomerIsAbleTo($orderRepository);
        $compositeSpec = $spec->orSpecification($specAbleTo);

        $this->assertTrue($compositeSpec->isSatisfiedBy($customer));

    }

}