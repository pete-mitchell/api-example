Feature:
  In order to get stuff done
  As a user
  I want to keep track of my todo list

  Scenario: It saves a todo item
    When I add "pick up oatmeal at the grocery store" to my todo list
    Then I should have "pick up oatmeal at the grocery store" in my todo list
