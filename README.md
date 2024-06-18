Postman documentation link is in the description.

Notes:
The middleware that handles access to certain routes is not working properly. Auth::attempt returns true, but Auth::user() doesn't store any information as well as Auth::check() always returning false. Since this happens, users are always directed to login API when they have logged on in this API. The middleware applications are commented in the api.php. To see the middleware in action, the semicolon has to be deleted with the middleware application uncommented. Users do not have to be logged in to retrieve all book data. Non admin users could also add a new book, update an existing book, and delete a book by ISBN.
