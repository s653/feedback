# feedback

## 1. Setup SSH Keys (Optional)

Please refer to [this](https://confluence.atlassian.com/bitbucketserver/creating-ssh-keys-776639788.html) document for generating your SSH keys locally. Skip this if you already have set it up.

Add your public key to your **Github account**

---

## 2. Clone Repo

```
$ git clone git@github.com:Horizam/feedback.git
$ cd feedback
```

---

## 3. Copy .env files

```
cp .env.example .env
cp src/feedback/backend/.env.example src/feedback/backend/.env
cp docker-compose.example docker-compose.yaml
```

## 4. Build Docker image

```
$ docker-compose build
```

---

## 5. Run Containers

```
$ docker-compose up -d
```

---

## 6. Install dependencies

If using Git Bash on Windows, prepend **winpty** before each command i.e.

```
$ winpty docker exec -it feedback_backend_local composer install
```

Run in this order

```

$ docker exec -it feedback_backend_local composer install
$ docker exec -it feedback_backend_local php artisan key:generate
$ docker exec -it feedback_backend_local php artisan migrate
$ docker exec -it feedback_backend_local npm install

```

## 7. Add Hosts

Add the following host entries in hosts file

```

127.0.0.1 feedback.local.com
127.0.0.1 api.feedback.local.com

```

The following urls should be accessible

```

http://feedback.local.com
http://api.feedback.local.com

```


## Directory Structure

- src/ _(Microservices)_
  - feedback/
    - backend/
    - frontend/
- docker/ _(Docker / Nginx / Mysql )_
  - mysql/
  - nginx/
  - php/
- .env
- docker-compose.yaml

---

## Branches

- main _(For Production)_
- develop _(For Development)_

All development will be done in individual branch liked to JIRA Tickets.
After development for the ticket is completed, create a pull request to merge into **develop**

**DO NOT merge the branches manually**

---

## Cheatsheet

```

$ docker ps
$ docker images
$ docker container ls
$ docker-compose build
$ docker-compose up -d
$ docker-compose down
$ docker-compose down -v
$ docker-compose exec [SERVICE NAME] /bin/sh
$ docker-compose exec [SERVICE NAME] bash
$ docker-compose exec [SERVICE NAME] [COMMAND]
$ docker exec -it [CONTAINER NAME] /bin/sh
$ docker exec -it [CONTAINER NAME] bash
$ docker exec -it [CONTAINER NAME] [COMMAND]
$ sudo certbot certonly --standalone --preferred-challenges http -d domain.com
```
