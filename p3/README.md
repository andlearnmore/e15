*Any instructions/notes in italics should be removed from the template before submitting*

# Project 3
+ By: *Anne Dwojeski-Santos*
+ Production URL: <http://e15p3.andlearn.me>

## Feature summary
+ Visitors can see a list of countries and cities used in the app and the contact page.
+ Visitors can register/log in.
+ Registered users can click on any of the cities and see different places that they can visit. 
+ In a City view, users can select places to learn more about; clicking on a place, the user gets details about a place and has the option to ADD the place to their My Trip list.
+ On the My Trip page, the user can see all of the places they have added, and can REMOVE these from the list.
+ On Add a Place, the user can ADD a place to the database and then ADD it to their list.
  + Places that a user adds are visible on the corresponding City page; user-added places are not visible to other users.

+ There's a file uploader that's used to upload images for [?? Each location ?? ]
+ User's can toggle whether movies in their collection are public or private - CHANGE
+ Each user has a public profile page which presents a short bio about their movie tastes, as well as a list of public movies in their collection - CHANGE
+ Each user has their own account page where they can edit their bio, email, password - MODIFY
+ Users can clone movies from another user's public collection into their collection - CHANGE
+ The home page features
  + a stream of recently added public movies - CHANGE
  + a list of categories, with a link to each category that shows a page of movies (with links) within that category - CHANGE

  
## Database summary
*Describe the tables and relationships used in your database. Delete the examples below and replace with your own info.*

+ My application has 3 tables in total (`users`, `movies`, `categories`) - UPDATE
+ There's a many-to-many relationship between `movies` and `categories` - UPDATE
+ There's a one-to-many relationship between `movies` and `users` - UPDATE

## Outside resources
+ European Countries JSON file: jim-at-jibba/euro-countries.json
+ https://laracasts.com/discuss/channels/testing/factories-localization
+ https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_legend
+ https://magecomp.com/blog/make-admin-auth-in-laravel-8/
+ https://medium.com/@kaism/3-way-pivot-table-in-laravel-d42d60462b06#:~:text=The%20relationships%20between%20the%20three,tables%20like%20color_size%20or%20size_style%20.

## Notes for instructor
*Any notes for me to refer to while grading; if none, omit this section*

## Tests
*Include the full output of running `codecept run acceptance --steps`. If you’re taking this course for undergraduate credit and are opting out from testing, simply put "undergraduate - opting out" in this section*