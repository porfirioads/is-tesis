Feature: Update report type
    As an admin user
    I want to change the report type
    So that the relevant department can attend it

    Scenario: Succesful report type updated
        Given I am logged in the system
        When I change the report type with other valid
        Then I get the updated report details

    Scenario Invalid report type updated
        Given I am logged in the system
        When I change the report type with a non existent one
        Then I get an invalid report type error message
