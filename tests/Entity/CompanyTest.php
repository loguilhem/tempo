<?php


namespace Tests\Entity;

use App\Entity\Company;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    protected $company;

    public function setUp(): void
    {
        $this->company = new Company();
        $this->company
            ->setName('name')
            ->setAddress('address')
            ->setCity('city')
            ->setCountry('country')
            ->setTel('0102030405')
            ->setToken('token')
            ->setEmail('email')
            ->setZipCode(1)
        ;
    }

    public function testGettersSetters()
    {
        $this->assertIsString($this->company->getName());
        $this->assertIsString($this->company->getAddress());
        $this->assertIsString($this->company->getCity());
        $this->assertIsString($this->company->getEmail());
        $this->assertIsString($this->company->getCountry());
        $this->assertIsString($this->company->getTel());
        $this->assertIsString($this->company->getToken());
        $this->assertIsInt($this->company->getZipCode());
    }
}