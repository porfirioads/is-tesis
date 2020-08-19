Feature: Add support request
    As a system administrator
    I want to add a support request for a person
    So that I decide who to support.

    Scenario: Successful support request insertion
        Given I am logged in the system
        And I provide the complete and correct data for a support request
        When I register the support request
        Then the support request is registered
        And I get the information of the created support request

    Scenario: Error missing data
        Given I am logged in the system
        And I do not provide complete data for a support request
        When I register the support request
        Then the support request is not registered
        And I get an error support request insertion message


    Scenario: Non existent beneficiary
        Given I am logged in the system
        And I provide a beneficiary that not exists in the system
        When I register the support request
        Then the support request is not registered
        And I get an invalid beneficiary error message
