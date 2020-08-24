Feature: Update support request status
    As a system administrator
    I want to update the status of a support request
    So that I can plan how to distribute the available support resources

    Scenario: Successful support request approval
        Given I am logged in the system
        And I provide a valid support request
        And I provide a valid approval date
        And I provide the approved status
        When I change the status of the support request
        Then the support request status is set to approved
        And the approval date is set

    Scenario: Missing data in support request status update
        Given I am logged in the system
        And I provide a valid support request
        When I change the status of the support request
        Then the support request data is not changed
        And I get a missing request status error message

    Scenario: Non existent support request
        Given I am logged in the system
        And I provide a support request that not exists in the system
        When I change the status of the support request
        Then I get an invalid support request error message

    Scenario: Approval date missing setting approved status
        Given I am logged in the system
        And I provide the approved status
        When I change the status of the support request
        Then I get a missing approval date error message

    Scenario: Successful support request delivery
        Given I am logged in the system
        And I provide a valid support request
        And I provide the delivered status
        And I provide a valid delivery date
        When I change the status of the support request
        Then the support request status is set to delivered
        And the delivery date is set

    Scenario: Delivery date missing setting delivered status
        Given I am logged in the system
        And I provide the delivered status
        When I change the status of the support request
        Then I get a missing delivery date error message
