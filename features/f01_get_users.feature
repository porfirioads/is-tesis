Feature: Get users.
    As normal user
    I want to see the users list
    In order to known who can use the system.

    Scenario: Users list with items.
        Given the users list has items
        When the users list is returned
        Then each element has the "id" attribute
        And each element has the "username" attribute
