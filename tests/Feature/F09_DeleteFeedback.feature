Feature: Delete feedback
    As an admin user
    I want to delete the feedback for a report
    So that the interested people will not see wrong data about the report

    Scenario: Successful feedback deletion
        Given I am logged in the system
        And there are items in the feedback list
        When I delete a feedback
        Then I get a success feedback deletion message

    Scenario: Feedback deletion with missing data
        Given I am logged in the system
        When I delete a feedback with missing data
        Then I get an error feedback deletion message
