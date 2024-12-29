# myCompanyApi

## Description
A example of rest api app with some endpoints, with one domain.
Two entities Company , Employee.

## How to set up project (in ubuntu)
### install php 8.3+
### install make 

### make up environment

```
cd ./myCompanyApi
make up
```

### set up migrations 

```
php bin/console doctrine:migrations:migrate
```

## unittests tests and endpoint tests

```
cd ./myCompanyApi
/bin/php vendor/phpunit/phpunit/phpunit --bootstrap tests/bootstrap.php --configuration tests/phpunit.xml tests --teamcity 
```



## examples of requests

### create company
```
curl --location 'http://127.0.0.1:8000/api/company' \
--header 'Content-Type: application/json' \
--data '{
    "taxIdNumber": "9570982830",
    "name": "Efg inc.",
    "address": "Majowa 27",
    "city": "Rozyny",
    "postalCode": "83-031"
}'

```

### add employee to company
```
curl --location 'http://127.0.0.1:8000/api/employee' \
--header 'Content-Type: application/json' \
--data-raw '{
    "companyId": 5,
    "name": "Kamil",
    "surname": "Kowalski",
    "email": "kamil.kowalski@gmail.com",
    "phone": "567123123"
}'
```

### replace company
```
curl --location --request PUT 'http://127.0.0.1:8000/api/company' \
--header 'Content-Type: application/json' \
--data '{
    "companyId": 5,
    "name": "Piotr Kowerzanow inc.",
    "taxIdNumber": "1234567890",
    "address": "Majowa 24",
    "city": "Rozyny",
    "postalCode": "83-031"
}'
```

### replace employee
```
curl --location --request PUT 'http://127.0.0.1:8000/api/employee' \
--header 'Content-Type: application/json' \
--data-raw '{
    "companyId": 3,
    "name": "Kamil1",
    "surname": "Kowalski1",
    "email": "kamil.kowalski@gmail.com1",
    "phone": "56712312-1",
    "employeeId": 7
}'
```

### update employee
```
curl --location --request PATCH 'http://127.0.0.1:8000/api/employee' \
--header 'Content-Type: application/json' \
--data '{
    "companyId": 3,
    "phone": "56712312",
    "employeeId": 7
}'
```

### update company
```
curl --location --request PATCH 'http://127.0.0.1:8000/api/company' \
--header 'Content-Type: application/json' \
--data '{
    "companyId": 3,
    "postalCode": "83-035"
}'
```

### delete company
```
curl --location --request DELETE 'http://127.0.0.1:8000/api/company' \
--header 'Content-Type: application/json' \
--data '{
    "companyId": 5
}'
```

### delete employee
```
curl --location --request DELETE 'http://127.0.0.1:8000/api/employee' \
--header 'Content-Type: application/json' \
--data '{
    "employeeId": 5
}'
```

### get companies
```
curl --location 'http://127.0.0.1:8000/api/companies/10/0'
```

### get company details
```
curl --location --request GET 'http://127.0.0.1:8000/api/company' \
--header 'Content-Type: application/json' \
--data '{
    "companyId": 2
}'
```

### get employees
```
curl --location --request GET 'http://127.0.0.1:8000/api/employees' \
--header 'Content-Type: application/json' \
--data '{
    "companyId": 2
}'
```

### get employee (details)
```
curl --location --request GET 'http://127.0.0.1:8000/api/employee' \
--header 'Content-Type: application/json' \
--data '{
    "employeeId": 2
}'
```