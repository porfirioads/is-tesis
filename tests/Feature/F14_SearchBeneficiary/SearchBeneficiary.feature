Feature: Search beneficiary
    As a system administrator
    I want to register a beneficiary
    So that I can decide if I will give him a support

    Scenario: Search by curp
        Given I am logged in the system
        And I provide an existent curp
        When I search the beneficiary
        Then I get the data of the found beneficiary

    Scenario: Search by non existent curp
        Given I am logged in the system
        And I provide a non existent curp
        When I search the beneficiary
        Then I get a non existent curp error message

    Scenario: Search by neighborhood
        Given I am logged in the system
        And I provide an assigned neighborhood
        When I search the beneficiary
        Then I get the data of the found beneficiary
