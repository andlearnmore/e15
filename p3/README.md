
# Project 3
+ By: *Anne Dwojeski-Santos*
+ Production URL: <http://e15p3.andlearn.me>

## Feature summary
+ Visitors can see a list of countries and cities used in the app and the contact page.
+ Visitors can register/log in.
+ Registered users can click on any of the cities and see different places that they can visit. 
+ In a City view, users can select places to learn more about; clicking on a place, the user gets details about a place and has the option to ADD the place to their My Trip list.
+ On the My Trip page, the user can see all of the places they have added, and can REMOVE these from the list.
+ On Add a Place, the user can ADD a new place to the database and then ADD it to their list.
+ Places that a user adds are visible on the corresponding City page; user-added places are not visible to other users.
+ Users have a profile page on which they can edit their name or add information about themselves.

  
## Database summary
*Describe the tables and relationships used in your database. Delete the examples below and replace with your own info.*

+ My application has  tables in total (`users`, `cities`, `countries`, `places`) - UPDATE
+ There's a many-to-many relationship between `users` and `places` - UPDATE
+ There's a one-to-many relationship between `countries` and `cities` and between `cities` and `places`- UPDATE

## Outside resources
+ European Countries JSON file: jim-at-jibba/euro-countries.json
+ https://laracasts.com/discuss/channels/testing/factories-localization
+ https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_legend
+ https://magecomp.com/blog/make-admin-auth-in-laravel-8/
## I was hoping to do a place_tag_user feature, but wasn't able to complete it.
+ https://medium.com/@kaism/3-way-pivot-table-in-laravel-d42d60462b06#:~:text=The%20relationships%20between%20the%20three,tables%20like%20color_size%20or%20size_style%20.
# Uploading images: I tried to do this as a new feature, but couldn't get it to work.
+ https://laravel.com/docs/10.x/filesystem 
+ https://dev.to/shanisingh03/how-to-upload-image-in-laravel-9--4dkf
+ https://stackoverflow.com/questions/34836602/laravel-uploading-file-unable-to-write-in-directory
+ https://larainfo.com/blogs/laravel-9-image-file-upload-example

## Notes for instructor
+ As you're looking at this, Berlin is the city with the most real data, which makes it the easiest to look at!

+ I really need a class in front-end or at least CSS--it's hard to look at such an ugly site and I'm sorry!

+ I used Login tests from your examples, among others I created.

## Tests
Acceptance Tests (10) -------------------------------------------------------------
AllCitiesCest: User can see details
Signature: AllCitiesCest:UserCanSeeDetails
Test: tests/acceptance/AllCitiesCest.php:UserCanSeeDetails
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/cities"
 I click "[test=city-link]"
 I see "Explore places to visit"
 PASSED 

AllCitiesCest: User cant add place already in my trip
Signature: AllCitiesCest:UserCantAddPlaceAlreadyInMyTrip
Test: tests/acceptance/AllCitiesCest.php:UserCantAddPlaceAlreadyInMyTrip
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/DE/berlin/sherwood-forest-playground"
 I don't see "[test=add-button"
 PASSED 

AllCitiesCest: User can add place not in my trip
Signature: AllCitiesCest:UserCanAddPlaceNotInMyTrip
Test: tests/acceptance/AllCitiesCest.php:UserCanAddPlaceNotInMyTrip
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/2"
 I am on page "/DE/berlin/altes-museum"
 I click "Save to My Trip"
 I see "Altes Museum was added to My Trip."
 PASSED 

LoginProcessCest: User can register
Signature: LoginProcessCest:userCanRegister
Test: tests/acceptance/LoginProcessCest.php:userCanRegister
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","test@email.com"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirmation-input]","asdfasdf"
 I click "[test=register-button]"
 I see "Test User"
 PASSED 

LoginProcessCest: Registration is validated
Signature: LoginProcessCest:registrationIsValidated
Test: tests/acceptance/LoginProcessCest.php:registrationIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/register"
 I fill field "[test=name-input]","Test User"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I fill field "[test=password-confirmation-input]","asdfasdf"
 I click "[test=register-button]"
 I see "This email already exists."
 PASSED 

LoginProcessCest: User can log in
Signature: LoginProcessCest:userCanLogIn
Test: tests/acceptance/LoginProcessCest.php:userCanLogIn
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","asdfasdf"
 I click "[test=login-button]"
 I see "Jill Harvard"
 I see "Logout","nav"
 PASSED 

LoginProcessCest: User can logout
Signature: LoginProcessCest:userCanLogout
Test: tests/acceptance/LoginProcessCest.php:userCanLogout
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/1"
 I am on page "/"
 I click "[test=logout-button]"
 I see element "[test=login-link]"
 PASSED 

LoginProcessCest: Login is validated
Signature: LoginProcessCest:loginIsValidated
Test: tests/acceptance/LoginProcessCest.php:loginIsValidated
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/login"
 I fill field "[test=email-input]","jill@harvard.edu"
 I fill field "[test=password-input]","bad-password"
 I click "[test=login-button]"
 I see "These credentials do not match our records."
 PASSED 

MyTripCest: User with empty my trip
Signature: MyTripCest:UserWithEmptyMyTrip
Test: tests/acceptance/MyTripCest.php:UserWithEmptyMyTrip
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/test/login-as/3"
 I am on page "/mytrip"
 I see element "[test=no-places]"
 PASSED 

UnregisteredUserCest: Cant access city details
Signature: UnregisteredUserCest:CantAccessCityDetails
Test: tests/acceptance/UnregisteredUserCest.php:CantAccessCityDetails
Scenario --
 I am on page "/test/refresh-database"
 I am on page "/cities"
 I see element "[test=login-encourage]"
 I am on page "/AT/gmunden"
 I see "Login"
 PASSED 

-----------------------------------------------------------------------------------


Time: 41.18 seconds, Memory: 20.66 MB

OK (10 tests, 12 assertions)