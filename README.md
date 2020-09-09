# 📡 PHP DDD Api

## 📁 Proyect structure

Our code, it's stored in the `src` folder. One for leads and another for event logging.

```bash
src
├── EventLogger
│   ├── Domain
│   ├── Infrastructure
│   └── Repository
├── Leads
│   ├── Command
│   ├── Domain
│   ├── Infrastructure
│   └── Repository
└── Shared
    ├── Domain
    └── Infrastructure
```

We have two domains: one for leads and another for event logging. Also, we have a `Shared` folder for some shared code between al domains.

### CQRS

We are implementing CQRS in our controllers in order to separate queries, commands, and most important, our code from symfony or other infrastructure code. We have a `InMemorySymfonyCommandBus.php` and a `InMemorySymfonyQueryBus.php` to dispatch any request we implement.

We also have a EventBus with two possible implementations: We have `InMemorySymfonyEventBus.php` and a `MySqlDoctrineEventBus.php` to dispatch events, store them in database and executed them assyncronous with a command.

## 👷 CI

We use GitHub Workflow to test our project and check style after every commit. If you go to the `Actions` tab you can see each execution. Also, you will receive an email if you commit something and don't pass through all our checks.

If you want yo can execute each of this tests with the following commands in this doc.

### 🧪 Testing

We have two testing suits with PHP Unit, one for unit testing an another for integration. You can execute any of them with:

```bash
make test/unit                  # Unit testing
make test/integration           # Integration testing
```

Also we use behat to test features. You can execute this tests with:

```bash
make test/functional            # Functional testing
```
If you want to execute all you can simply execute `make test/all`.

### 💅 Code style and error checker

To ensure that all the code write in this project follow the same style guide and it's free of error we have two types of code checks:

```bash
make style/code-style           # Code style
make style/static-analysis      # Static error checker
make style/all                  # Run both
```
