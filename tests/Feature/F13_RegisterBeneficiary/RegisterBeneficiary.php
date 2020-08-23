<?php

namespace Tests\Feature\F13_RegisterBeneficiary;

use App\Models\BenBeneficiario;
use Behat\Behat\Tester\Exception\PendingException;
use Log;
use Tests\Feature\F00_GeneralSteps;

class RegisterBeneficiary extends F00_GeneralSteps
{
    private static $originalBeneficiary;
    private static $beneficiariCount;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        F00_GeneralSteps::$requestData = [];
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        F00_GeneralSteps::$requestData = [];
    }

    /**
     * @Given /^I provide a valid curp$/
     */
    public function iProvideAValidCurp()
    {
        $curp = 'SAAL680101FGTHYJ16';
        F00_GeneralSteps::$requestData['curp'] = $curp;
        $this->assertDatabaseMissing('ben_beneficiarios', ['curp' => $curp]);
    }

    /**
     * @Given /^I provide a valid name$/
     */
    public function iProvideAValidName()
    {
        F00_GeneralSteps::$requestData['nombre'] = 'Leticia';
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid lastname$/
     */
    public function iProvideAValidLastname()
    {
        F00_GeneralSteps::$requestData['primer_apellido'] = 'Sánchez';
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid second lastname$/
     */
    public function iProvideAValidSecondLastname()
    {
        F00_GeneralSteps::$requestData['segundo_apellido'] = 'Acevedo';
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid genre$/
     */
    public function iProvideAValidGenre()
    {
        F00_GeneralSteps::$requestData['sexo'] = 'F';
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid phone number$/
     */
    public function iProvideAValidPhoneNumber()
    {
        F00_GeneralSteps::$requestData['telefono'] = '4941001232';
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid street name$/
     */
    public function iProvideAValidStreetName()
    {
        F00_GeneralSteps::$requestData['nombre_vialidad'] = 'Galeana';
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid house number$/
     */
    public function iProvideAValidHouseNumber()
    {
        F00_GeneralSteps::$requestData['numero_exterior'] = '51B';
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid apartment number$/
     */
    public function iProvideAValidApartmentNumber()
    {
        F00_GeneralSteps::$requestData['numero_interior'] = '4';
        $this->assertTrue(true);
    }

    /**
     * @Given /^I provide a valid neighborhood$/
     */
    public function iProvideAValidNeighborhood()
    {
        F00_GeneralSteps::$requestData['colonia'] = 'Guadalupe';
        $this->assertTrue(true);
    }

    /**
     * @When /^I register the beneficiary$/
     */
    public function iRegisterTheBeneficiary()
    {
        $token = F00_GeneralSteps::$authToken;
        RegisterBeneficiary::$beneficiariCount = BenBeneficiario::count();

        $this->httpPost(
            '/api/beneficiarios',
            F00_GeneralSteps::$requestData,
            ['Authorization' => "Bearer $token"]
        );

        $this->assertNotNull(F00_GeneralSteps::$responseData);
    }

    /**
     * @Then /^the beneficiary is registered$/
     */
    public function theBeneficiaryIsRegistered()
    {
        $newCount = BenBeneficiario::count();
        $this->assertEquals(
            RegisterBeneficiary::$beneficiariCount + 1,
            $newCount
        );
    }

    /**
     * @Given /^I get the data of the registered beneficiary$/
     */
    public function iGetTheDataOfTheRegisteredBeneficiary()
    {
        $requestData = F00_GeneralSteps::$requestData;
        $responseData = F00_GeneralSteps::$responseData;

        $keys = [
            'id',
            'nombre',
            'primer_apellido',
            'segundo_apellido',
            'sexo',
            'curp',
            'telefono',
            'nombre_vialidad',
            'numero_exterior',
            'numero_interior',
            'colonia'
        ];

        $this->assertArrayHasKeys($keys, $responseData);
        $keys = array_diff($keys, ['id']);

        foreach ($keys as $key) {
            $this->assertEquals($requestData[$key], $responseData[$key]);
        }
    }

    /**
     * @Then /^the beneficiary is not registered$/
     */
    public function theBeneficiaryIsNotRegistered()
    {
        $newCount = BenBeneficiario::count();
        $this->assertEquals(RegisterBeneficiary::$beneficiariCount, $newCount);
    }

    /**
     * @Given /^I get a missing name error message$/
     */
    public function iGetAMissingNameErrorMessage()
    {
        $this->assertErrorResponseHasValue(
            'El nombre es requerido',
            'nombre'
        );
    }

    /**
     * @Given /^I get a missing lastname error message$/
     */
    public function iGetAMissingLastnameErrorMessage()
    {
        $this->assertErrorResponseHasValue(
            'El primer apellido es requerido',
            'primer_apellido'
        );
    }

    /**
     * @Given /^I get a missing genre error message$/
     */
    public function iGetAMissingGenreErrorMessage()
    {
        $this->assertErrorResponseHasValue('El sexo es requerido', 'sexo');
    }

    /**
     * @Given /^I get a missing phone error message$/
     */
    public function iGetAMissingPhoneErrorMessage()
    {
        $this->assertErrorResponseHasValue(
            'El telefono es requerido',
            'telefono'
        );
    }

    /**
     * @Given /^I get a missing street name error message$/
     */
    public function iGetAMissingStreetNameErrorMessage()
    {
        $this->assertErrorResponseHasValue(
            'El nombre de la vialidad es requerido',
            'nombre_vialidad'
        );
    }

    /**
     * @Given /^I get a missing house number error message$/
     */
    public function iGetAMissingHouseNumberErrorMessage()
    {
        $this->assertErrorResponseHasValue(
            'El número exterior es requerido',
            'numero_exterior'
        );
    }

    /**
     * @Given /^I get a missing neighborhood error message$/
     */
    public function iGetAMissingNeighborhoodErrorMessage()
    {
        $this->assertErrorResponseHasValue(
            'La colonia es requerida',
            'colonia'
        );
    }

    /**
     * @Given /^I provide an existent curp$/
     */
    public function iProvideAnExistentCurp()
    {
        $beneficiario = BenBeneficiario::first();
        F00_GeneralSteps::$requestData['curp'] = $beneficiario->curp;
        $this->assertTrue(true);
    }

    /**
     * @Given /^I get an existent curp error message$/
     */
    public function iGetAnExistentCurpErrorMessage()
    {
        $this->assertErrorResponseHasValue(
            'La curp proporcionada ya existe',
            'curp'
        );
    }
}
