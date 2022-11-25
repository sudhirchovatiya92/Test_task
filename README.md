# Test_task
Full Stack Test Task
Task

create an API to add money to the wallet. we assume we have a users table(which comes with Laravel installation), and you need to write migration as well for this new field(i.e wallet) you can increase that field when a user adds the money.

create another API to buy a cookie with a rate of $1 per cookie. as soon as, the user buys the cookie, the wallet should be decreased.



Special notes

API should be with proper semantics, HTTP verb, and proper payload(i.e JSON).

log the error in a log file.

wrap your code in try-catch.

should use validation, middleware, authentication, Authorization, tokens, and gates wherever possible.

proper checking of Bad or invalid requests.



constraints

Users can add a minimum of $3 and a maximum of $100 to their wallet in a single operation. Obviously, he can call the API subsequently to add more money to their wallet and the user can also enter the decimal values up to 2 places.

The user needs to buy at least one cookie to perform the "buy a cookie" operation.



Output

upload the laravel code to a server available online or upload to github and send us the link to the repo.

also provide a .json export of the API from postman.

