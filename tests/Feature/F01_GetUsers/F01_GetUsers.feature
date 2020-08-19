Feature: Get reports.
    As a superadmin user
    I want to see the list of users
    In order to test the database.

    Scenario: Users list with items.
        Given the users list has items
        When the users list is returned
        Then each user has the "id" attribute
        And each user has the "username" attribute

    Scenario: Users list empty.
        Given the users list is empty
        When the users list is returned
        Then no users are returned
