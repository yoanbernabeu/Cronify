# Cronify

Simply monitor your Cron

[![Pipeline-CI](https://github.com/yoanbernabeu/cronify/actions/workflows/ci.yml/badge.svg)](https://github.com/yoanbernabeu/cronify/actions/workflows/ci.yml) [![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](LICENSE)


![Pipeline-CI](public/img/logo_ban.png)

---

## What is cronify ?

Cronify is a simple tool to monitor the execution of your cron jobs.

The use is super simple:
1. Declare one or more applications
2. Declare one or more jobs for your applications
3. For each job, you only have to touch three addresses to log the execution:
    - An address to start a cron
    - An address to stop a cron
    - An address to indicate an error

## How to install the app ?

Cronify is a simple Symfony/PHP/PostgreSQL application.

This documentation offers a simplified installation FOR DEVELOPMENT ONLY with Docker. You can do without it if you already have PostgreSQL.

### Prerequisites

- [PHP 8.1](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)
- [Make](https://www.gnu.org/software/make/)
- [Symfony CLI](https://symfony.com/download)

### Clone and install

```bash
git clone https://github.com/yoanbernabeu/Cronify.git
cd Cronify
make install
```

### Create a new User

User creation is possible from the command line.

```bash
symfony console app:create-user username@mail.com password
```

## License

See the bundled [LICENSE](LICENCE) file.