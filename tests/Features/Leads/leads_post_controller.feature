 Feature:
    In order to prove that we can create a Lead
    As a user

    Scenario: It receives expected response
        When we make a POST request to "/leads"
        Then the response content should be
        """
        {"lead":true}
        """
