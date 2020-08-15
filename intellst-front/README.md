# IntellST-frontend

## Project setup

```
npm install
```

### Compiles and hot-reloads for development

```
npm run serve
```

### Compiles and minifies for production

```
npm run build
```

### Lints and fixes files

```
npm run lint
```

### Customize configuration

See [Configuration Reference](https://cli.vuejs.org/config/).

### List with endpoints 

` http://intellst-back.local/api/entreprises/1 `  edit enterprise, method: Post

data:
{
   temperature: float,
   restrictionPeriod: integer
}

example {
           "temperature": 38.0,
           "restrictionPeriod": "14"
        }

` http://intellst-back.local/api/identified-case ` add identified case && show all identified cases,
method: GET, POST

data:
{
   name: string,
   temperature: float
}

example: 
{
   "name": "/home/images",
   "temperature": "41"
}
 
` http://intellst-back.local/api/identified-case/1 ` edit allow entrance, method: POST

` http://localhost/login_check ` login  check, method: POST

data
{
    username: string, email,
    password: string
}

example
{
    "username":"user@gmail.com",
    "password":"user"
}