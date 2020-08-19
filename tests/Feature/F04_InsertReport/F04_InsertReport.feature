Feature: Insert report.
    As a normal user
    I want to make a report
    In order the municipal government solves it

    Scenario: Successful report insertion.
        Given I am logged in the system
        When I make a report with the correct data
        Then I get the information of the report.

    Scenario: Missing data report insertion.
        Given I am logged in the system
        When I make a report with missing data
        Then I get a report insertion error message.
