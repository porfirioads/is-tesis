Feature: Delete report
    As an admin user
    I want to delete a report
    So that I can attend only the correct ones.

    Scenario: Successful report deletion
        Given I am logged in the system
        When I delete a report
        Then I get a success report deletion message

    Scenario: Delete non existent report
        Given I am logged in the system
        When I delete a report that not exists
        Then I get an error report deletion message
