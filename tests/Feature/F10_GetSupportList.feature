Feature: Get support list
    As a system administrator
    I want to get the support list
    So that I can see the information of the people we have helped

    Scenario: Support list with elements
        Given I am logged in the system
        And there are items in the support list
        When the support list is returned
        Then each element has the beneficiary information
        And each element has the support type
        And each element has the support amount
        And each element has the request date
        And each element has the acceptance date
        And each element has the delivery date
        And each element has status attribute

    Scenario: Empty support list
        Given I am logged in the system
        And the support list is empty
        When the support list is returned
        Then I cannot see any support
