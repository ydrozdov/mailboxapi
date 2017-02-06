# Message API

## Requirements

* PHP >= 7.0.0
* MongoDB

## Import messages from a JSON file

`./bin/console import-messages`

## REST API
**List messages**
----
  Retrieves a paginateable list of all messages.

* **URL**

  /api/list/:page

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `page=[integer]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"page":3,"totalPages":9,"items":{"58949f14ac52299d9394bdd6":{"uid":25,"sender":"James Joyce","subject":"nuclear engineer","message":"The story is about an ugly nuclear engineer. It starts in a manufacturing city in Africa. The future of warfare is a major part of this story.","time_sent":1456733427,"read":null,"archived":null},"58949f14ac52299d9394bdd7":{"uid":26,"sender":"Jane Austen","subject":"treasure-hunter","message":"The story is about a treasure-hunter and a treasure-hunter who is constantly annoyed by a misguided duke. It takes place on a forest planet in a galaxy-spanning commonwealth. The critical element of the story is a door being opened","time_sent":1456730427,"read":null,"archived":null}}}`
 
* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
  
  OR

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "You are unauthorized to make this request." }`

**List archived messages**
----
  Retrieve a paginateable list of all archived messages.

* **URL**

  /api/list/archived/:page

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `page=[integer]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"page":3,"totalPages":9,"items":{"58949f14ac52299d9394bdd6":{"uid":25,"sender":"James Joyce","subject":"nuclear engineer","message":"The story is about an ugly nuclear engineer. It starts in a manufacturing city in Africa. The future of warfare is a major part of this story.","time_sent":1456733427,"read":null,"archived":true},"58949f14ac52299d9394bdd7":{"uid":26,"sender":"Jane Austen","subject":"treasure-hunter","message":"The story is about a treasure-hunter and a treasure-hunter who is constantly annoyed by a misguided duke. It takes place on a forest planet in a galaxy-spanning commonwealth. The critical element of the story is a door being opened","time_sent":1456730427,"read":null,"archived":true}}}`
 
* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
  
  OR

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "You are unauthorized to make this request." }`

**Show message**
----
  Retrieve message by id, include read status and if message is achived.

* **URL**

  /api/show/:uid

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `uid=[integer]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"uid":21,"sender":"Ernest Hemingway","subject":"animals","message":"This is a tale about nihilism. The story is about a combative nuclear engineer who hates animals. It starts in a ghost town on a world of forbidden magic. The story begins with a legal dispute and ends with a holiday celebration.","time_sent":1459239867,"read":true,"archived":null}`
 
* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
  
  OR

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "You are unauthorized to make this request." }`

**Read message**
----
  This action “reads” a message and marks it as read in database.

* **URL**

  /api/read/:uid

* **Method:**

  `GET`
  
*  **URL Params**

   **Required:**
 
   `uid=[integer]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"uid":21,"sender":"Ernest Hemingway","subject":"animals","message":"This is a tale about nihilism. The story is about a combative nuclear engineer who hates animals. It starts in a ghost town on a world of forbidden magic. The story begins with a legal dispute and ends with a holiday celebration.","time_sent":1459239867,"read":true,"archived":null}`
 
* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
  
  OR

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "You are unauthorized to make this request." }`

**Archive message**
----
  This action sets a message to archived.

* **URL**

  /api/archive/:uid

* **Method:**

  `PATCH`
  
*  **URL Params**

   **Required:**
 
   `uid=[integer]`

* **Data Params**

  None

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** `{"uid":21,"sender":"Ernest Hemingway","subject":"animals","message":"This is a tale about nihilism. The story is about a combative nuclear engineer who hates animals. It starts in a ghost town on a world of forbidden magic. The story begins with a legal dispute and ends with a holiday celebration.","time_sent":1459239867,"read":true,"archived":true}`
 
* **Error Response:**

  * **Code:** 404 NOT FOUND <br />
  
  OR

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "You are unauthorized to make this request." }`

## HTTP basic authentication

API uses an HTTP basic authentication with user *admin* and password *foo*


