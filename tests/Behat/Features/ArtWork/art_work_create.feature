Feature: Art work create
  In order to exhibit painting in my online gallery
  As an artist
  I want to create my own art works

#  @skip
  Scenario: Fields default values
    Given I open "Art Work Create Page"
    Then form should contain values:
#      | Is Published     | Unpublished                     |
      | In Stock         | Available                       |

  Scenario: Required fields for archive art works
    Given I open "Art Work Create Page"
    And fill form with:
      | In Stock         | Sold                            |
      | Is Published     | Unpublished                     |
    And I press "Create"
    Then I should see form errors:
      | Title            | This value should not be blank. |
      | Picture          | Picture is mandatory field.     |
      | Width            | This value should not be blank. |
      | Height           | This value should not be blank. |
      | Materials        | This value should not be blank. |
      | Creation date    | This value should not be blank. |
    And other fields has no errors

  @skip
  Scenario: Required fields for available works
    Given I open "Art Work Create Page"
    And fill form with:
      | In Stock         | Sold                            |
      | Is Published     | On front                        |
    And I press "Create"
    Then I should see form errors:
      | Title            | This value should not be blank. |
      | Picture          | This value should not be blank. |
      | Widht            | This value should not be blank. |
      | Height           | This value should not be blank. |
      | Materials        | This value should not be blank. |
      | Creation date    | This value should not be blank. |
      | Price            | This value should not be blank. |
    And other fields has no errors

#  @skip
  Scenario: Successful create art work
    Given I open "Art Work Create Page"
    And fill form with:
      | Title            | Sunset on koh Samui             |
      | Creation date    | 15/05/2017                      |
      | Price            | 100500                          |
      | Materials        | canvas, acrylic                 |
      | Width            | 60                              |
      | Height           | 80                              |
#      | Picture          | sunset.jpg                |
#      | Additional images | [sunset_in_progress1.jpg, sunset_in_progress2.jpg] |
#    And other fields has no errors
    And fill in "Full description" with a 500 character
    When I press "Create"
    Then I should see "Item \"Sunset on koh Samui\" has been successfully created."
