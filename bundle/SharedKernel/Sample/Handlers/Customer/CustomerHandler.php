<?php

namespace SharedKernel\Sample\Handlers\Customer;

use Ramsey\Uuid\Uuid;
use SharedKernel\Model\Commands\CommandResult;
use SharedKernel\Model\Commands\ICommandResult;
use SharedKernel\Model\ValueObjects\Identity\Email;
use SharedKernel\Model\ValueObjects\Identity\Guid;
use SharedKernel\Sample\Commands\Customer\Inputs\RegisterCustomerCommand;
use SharedKernel\Sample\Entity\Customer;
use SharedKernel\Sample\Entity\Entity;

class CustomerHandler
{

    private $customerRepository;

    private $emailService;

    public function __construct(ICustomerRepository $customerRepository, IEmailService $emailService)
    {
        $this->customerRepository = $customerRepository;
        $this->emailService = $emailService;
    }

    public function handle(RegisterCustomerCommand $command): ICommandResult
    {

        if ($this->customerRepository->checkEmail($command->email)) {
            return new CommandResult(false, 'Este E-mail já está em uso', $command->asArray());
        }

        //VOS here
        $email = new Email($command->email);

        //
        $customer = new Customer(Guid::fromString(Uuid::uuid4()->toString()), $command->name, $command->age, $email);

        if (!$command->isValid()) {
            return new CommandResult(false, 'Por favor corrija os campos abaixo', $command->inputErrors());
        }

        $this->customerRepository->save($customer);

        $this->emailService->send($customer->getEmail(), "hello@picpay.com", "Bem vindo", "Seja bem vindo ao DDD experiment!");

        return new CommandResult(true, 'Bem vindo ao DDD experiment', [
            'name' => $customer->getName(),
            'age' => $customer->getAge(),
            'email' => $customer->getEmail()
                                ->value()
        ]);

    }


}