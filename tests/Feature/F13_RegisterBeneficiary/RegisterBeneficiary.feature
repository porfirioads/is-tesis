Feature: Register beneficiary
    As a system administrator
    I want to register a beneficiary
    So that she or he can ask for a support

    Scenario: Successful beneficiary registration
        Given I am logged in the system
        And I provide a valid curp
        And I provide a valid name
        And I provide a valid lastname
        And I provide a valid second lastname
        And I provide a valid genre
        And I provide a valid phone number
        And I provide a valid street name
        And I provide a valid house number
        And I provide a valid apartment number
        And I provide a valid neighborhood
        When I register the beneficiary
        Then the beneficiary is registered
        And I get the data of the registered beneficiary

    Scenario: Missing required data
        Given I am logged in the system
        And I provide a valid curp
        When I register the beneficiary
        Then the beneficiary is not registered
        And I get a missing name error message
        And I get a missing lastname error message
        And I get a missing genre error message
        And I get a missing phone error message
        And I get a missing street name error message
        And I get a missing house number error message
        And I get a missing neighborhood error message

    Scenario: Existent curp
        Given I am logged in the system
        And I provide an existent curp
        When I register the beneficiary
        Then the beneficiary is not registered
        And I get an existent curp error message
