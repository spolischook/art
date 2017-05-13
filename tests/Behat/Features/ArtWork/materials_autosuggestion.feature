Feature: Materials autosuggestion
  In order to keep in order art works materials
  As an artist
  I would like to have suggestions to previous entered materials

  @skip
  Scenario: Autosuggestion by typing
    Given already created "canvas, acrylic" materials
    And I open "Art Work Create Page"
    And I type in "Materials" with "ca"
    And I should see "canvas" autosuggestion
    When I press "down" key
    And press "Enter" key
    Then the "Materials" field should contain "canvas"
