<?php

namespace SharedKernel\Sample\Specification;

class Customer
{

    public function getStarRatings(): int
    {
        return 4;
    }

    public function getOverDueInvoices(): array
    {
        return [
            ['invoice_id' => 30, 'due_date' => '2018-01-10'],
            ['invoice_id' => 32, 'due_date' => '2018-01-11']
        ];
    }

}