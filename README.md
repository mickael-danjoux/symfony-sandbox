# Symfony Sandbox

This project is a sandbox for testing features in symfony project and some smalls POC.

## Content

### Configuration
- Docker
- Makefile

### Symfony experiments
- Messenger Component (Async emails and actions)
- Twig component
- Live component (simple example)
- Form with live component (with Entity Collection)

## Install

A Makefile make your life easier 😉

#### Install and start server
```shell
make sf-install-dev
```

#### Start containers and servers
```shell
make sf-start
```

#### Stop containers and servers
```shell
make sf-stop
```

#### Show all commands available
```shell
make help
```

Check [Makefile](./Makefile) to see more.
