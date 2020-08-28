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

    Scenario: A valid non existing lead without name
        Given I make a POST request to "/leads" with body
        """
        {
            "email": "victoor89@gmail.com"
        }
        """
        Then the response content should be empty
        And the response status code should be 201

    Scenario: Duplicated lead error
        Given I make a POST request to "/leads" with body
        """
        {
            "name": "Víctor Falcón",
            "email": "victoor89@gmail.com"
        }
        """
        And I make a POST request to "/leads" with body
        """
        {
            "name": "Random name",
            "email": "victoor89@gmail.com"
        }
        """
        Then the response content should be empty
        And the response status code should be 400