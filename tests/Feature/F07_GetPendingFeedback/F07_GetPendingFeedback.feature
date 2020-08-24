Feature: Get pending feedback
    As an admin user
    I want to get the reports pending feedback
    So that I can notify the users that made the reports

    Scenario: Pending feedback with items
        Given I am logged in the system
        And there are items in the pending feedback list
        When the pending feedback list is returned
        Then i get the ones that have not been notified to the users
