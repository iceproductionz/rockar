# Rockar Tech Test

## Description
To demonstrate your OOP and Unit Testing skills

### Assumptions 
- RPC type endpoints for this API
- Eields in query fields is the fields that should be returned
- Endpoints designed to only return one result

## Requirements
1. docker and docker-compose

## Usage
### Docker
 - host: localhost
 - port: 9191

### Customers Endpoint
 - path: api/v1/customers
 - queryFields: 
    - identifier: string 
    - identifierFields: [ email,forename, surname, contactNumber, postcode ]
    - fields[]: [ email,forename, surname, contactNumber, postcode ]

### Products Endpoint
 - path: api/v1/products
 - queryFields: 
    - identifier: string 
    - identifierFields: [ vin, colour, make, model, price ]
    - fields[]: [ vin, colour, make, model, price ]

### Example Urls
Get Customers
```bash
$ localhost:9191/api/v1/customers?identifier=Tom&identifierField=forename&fields[]=forename&fields[]=email&fields[]=surname
```

Get Products
```bash
$ localhost:9191/api/v1/products?identifier=WVGCV7AX7AW000784&identifierField=vin&fields[]=vin&fields[]=colour&fields[]=make
```

### Objective
To demonstrate your OOP and Unit Testing skills

### Task
Create an endpoint at which the designed data packet can be sent to.  

Create the response, as outlined in the design to response in a valid JSON format.  

The product.csv and customer.csv file contain dummy data in order to fulfil the request - it is expected that data can be sourced from either a .csv file or DB connection (to be configuration from an .env file).  

Whilst no external connection will be required, where appropriate stub out any external data connection.  

Following coding standards, please add unit tests, docblocks, comments, etc… 

Less is more, but sometimes a plugin will be more time efficient than writing something from scratch - use your best judgement and document any necessary setup requirements in the README.  

Submissions to be sent over as separate git repositories with suitable commits, messages, tags, etc… 

Please send all submissions to dominic.sutton@rockar.com  

### Design
(See design.png) 


### Assessment
Your submission will be assessed on your ability to present a practical understanding of the OOP Principles (Abstraction, Encapsulation, Polymorphism, Implementation), APIs, coding standards and unit testing.  

Points will be deducted for any redundant code left over or for any code not fully refactored.
