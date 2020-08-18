Feature: Add support request
    As a system administrator
    I want to add a support request for a person
    So that I decide who to support.

    Scenario: Successful support request
        Given I am logged in the system
        And I provide the complete and correct data for a support request
        When I register the support request
        Then the support request is registered

    Scenario: Wrong support request
        Given I am logged in the system
        And I do not provide complete data for a support request
        When I register the support request
        Then the support request is not registered
        And I get an error support request insertion message
