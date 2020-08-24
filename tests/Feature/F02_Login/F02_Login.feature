Feature: Login.
    As a system user
    I want to enter the system using my credentials
    In order to use the features of the system.

    Scenario: Login correct.
        Given there are valid users in the system
        When I login using valid credentials
        Then I get a token and the user data.

    Scenario: Login incorrect.
        Given there are valid users in the system
        When I login using invalid credentials
        Then I get an authentication error.

    Scenario: Login with missing fields.
        Given there are valid users in the system
        When I login without specify a password
        Then I get a validation error

    Scenario: Validate correct token.
        Given there are valid users in the system
        And I login using valid credentials
        When I verify the token
        Then I get a success token validation message.

    Scenario: Validate incorrect token.
        Given I have an invalid token
        When I verify the token
        Then I get an error token validation message.

