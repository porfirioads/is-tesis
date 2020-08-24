Feature: Get reports.
    As public services deparment admin
    I want to see the list of reports
    In order to schedule their review.

    Scenario: Reports list with items.
        Given the reports list has items
        And I am logged as an admin
        When the reports list is returned
        Then each element has the "id" attribute
        And each element has the "tipo" attribute
