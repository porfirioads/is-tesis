Feature: Insert feedback
    As an admin user
    I want to add feedback for a report
    So that the interested people can know the report status

    Scenario: Successful feedback insertion
        Given I am logged in the system
        And there are items in the reports list
        When I insert feedback for a report
        Then I get the inserted feedback details

    Scenario: Feedback insertion with missing data
        Given I am logged in the system
        When I insert feedback with missing data
        Then I get an error feedback insertion error message

    Scenario: Feedback insertion for a non existent report
        Given I am logged in the system
        When I insert feedback for a non existent report
        Then I get an error feedback insertion error message
