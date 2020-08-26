 Feature: Create new lead
    In order to have leads
    I want to create a new lead

    Scenario: A valid non existing lead
        Given I make a POST request to "/leads" with body
        """
        {
            "name": "Víctor Falcón",
            "email": "victoor89@gmail.com"
        }
        """
        Then the response content should be empty
        And the response status code should be 201
