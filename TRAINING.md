# HelloWorld Module - Training Guide

Complete training progression for the Spryker Academy HelloWorld module.

## 📋 Module Overview

| Module | Version | Branch | Duration | Difficulty |
|--------|---------|--------|----------|-----------|
| Hello World Back Office | v1.0 | `ilt/202512.0/basics/hello-world-back-office` | 30 min | ⭐☆☆☆☆ |
| Data Transfer Objects | v2.0 | `ilt/202512.0/basics/data-transfer-object` | 45 min | ⭐⭐☆☆☆ |
| Message Table Schema | v3.0 | `ilt/202512.0/basics/message-table-schema` | 1 hour | ⭐⭐☆☆☆ |
| Module Layers | v4.0 | `ilt/202512.0/basics/module-layers` | 2 hours | ⭐⭐⭐☆☆ |

---

## Module 1: Hello World Back Office

### 🎯 Learning Objectives
- Understand Spryker module structure
- Create a Zed controller
- Create a Twig template
- Access Back Office pages via URL

### 📦 Installation

**Skeleton Version:**
```bash
composer require spryker-academy/hello-world:1.0.0-skeleton
```

**Complete Version:**
```bash
composer require spryker-academy/hello-world:1.0.0-complete
```

**Or use branch:**
```bash
composer require spryker-academy/hello-world:dev-ilt/202512.0/basics/hello-world-back-office/skeleton
```

### 📝 What You Need to Do

1. Create module directory structure:
   ```
   src/SprykerAcademy/Zed/HelloWorld/
   ├── Communication/Controller/
   └── Presentation/Index/
   ```

2. Create `IndexController.php` with `indexAction()` returning message data

3. Create `index.twig` extending Back Office layout and displaying the message

4. Test at: `http://backoffice.eu.spryker.local/hello-world`

### ✅ Completion Criteria
- [ ] Controller returns data to view
- [ ] Template displays Back Office layout
- [ ] Message appears in browser
- [ ] No errors in logs

---

## Module 2: Data Transfer Objects

### 🎯 Learning Objectives
- Define Transfer objects in XML
- Use Transfer objects for type-safe data passing
- Generate Transfer PHP classes
- Work with Transfer object methods

### 📦 Installation

```bash
composer require spryker-academy/hello-world:2.0.0-skeleton
```

### 📝 What You Need to Do

1. Create Transfer definition XML:
   ```
   src/SprykerAcademy/Shared/HelloWorld/Transfer/helloworld.transfer.xml
   ```

2. Define `HelloWorldMessage` transfer with properties:
   - message (string)
   - timestamp (string)

3. Generate transfer classes:
   ```bash
   vendor/bin/console transfer:generate
   ```

4. Update controller to use Transfer objects

5. Update template to access Transfer properties

### ✅ Completion Criteria
- [ ] Transfer XML defined correctly
- [ ] Transfer classes generated
- [ ] Controller uses HelloWorldMessageTransfer
- [ ] Type safety maintained throughout

---

## Module 3: Message Table Schema

### 🎯 Learning Objectives
- Define Propel schema in XML
- Create database tables with columns
- Use Propel behaviors (timestampable)
- Generate Propel entity classes

### 📦 Installation

```bash
composer require spryker-academy/hello-world:3.0.0-skeleton
```

### 📝 What You Need to Do

1. Create schema file:
   ```
   src/SprykerAcademy/Zed/HelloWorld/Persistence/Propel/Schema/pyz_message.schema.xml
   ```

2. Define `pyz_message` table with:
   - id_message (primary key, auto-increment)
   - message (VARCHAR, required)
   - created_at (timestampable)
   - updated_at (timestampable)

3. Generate Propel models:
   ```bash
   vendor/bin/console propel:install
   ```

4. Create controller action to save messages

5. Query and display saved messages

### ✅ Completion Criteria
- [ ] Schema XML is valid
- [ ] Database table created
- [ ] Entity classes generated
- [ ] Can save and retrieve data
- [ ] Timestamps auto-populate

---

## Module 4: Module Layers

### 🎯 Learning Objectives
- Implement Business layer (Facade pattern)
- Create Persistence layer (Repository/EntityManager)
- Build Client layer (Zed-Yves gateway)
- Integrate Yves layer (Storefront)
- Understand layer responsibilities

### 📦 Installation

```bash
composer require spryker-academy/hello-world:4.0.0-skeleton
```

### 📝 What You Need to Do

1. **Business Layer:**
   - Create `HelloWorldFacade` and `HelloWorldFacadeInterface`
   - Create `HelloWorldBusinessFactory`
   - Implement `MessageWriter` and `MessageReader`

2. **Persistence Layer:**
   - Create `HelloWorldRepository` and `HelloWorldEntityManager`
   - Implement `MessageMapper`
   - Create query methods

3. **Client Layer:**
   - Create `HelloWorldClient` and factory
   - Implement stub for Zed gateway communication
   - Add DependencyProvider

4. **Yves Layer:**
   - Create `HelloWorldPage` module
   - Add controller and route provider
   - Create Twig templates

### ✅ Completion Criteria
- [ ] Facade exposes business operations
- [ ] Repository handles reads
- [ ] EntityManager handles writes
- [ ] Client communicates with Zed
- [ ] Yves displays data from Client
- [ ] Full request flow works end-to-end

---

## 🔄 Version Mapping

| Exercise | Skeleton Tag | Complete Tag | Branch Pattern |
|----------|-------------|-------------|----------------|
| Module 1 | v1.0.0-skeleton | v1.0.0-complete | `ilt/202512.0/basics/hello-world-back-office/*` |
| Module 2 | v2.0.0-skeleton | v2.0.0-complete | `ilt/202512.0/basics/data-transfer-object/*` |
| Module 3 | v3.0.0-skeleton | v3.0.0-complete | `ilt/202512.0/basics/message-table-schema/*` |
| Module 4 | v4.0.0-skeleton | v4.0.0-complete | `ilt/202512.0/basics/module-layers/*` |

---

## 🛠️ Common Commands

### Generate Code
```bash
# Generate Transfer objects
vendor/bin/console transfer:generate

# Install Propel (creates DB schema)
vendor/bin/console propel:install

# Build navigation cache
vendor/bin/console navigation:build-cache

# Clear cache
vendor/bin/console cache:empty-all
```

### Check Installation
```bash
# View installed version
composer show spryker-academy/hello-world

# List available versions
composer show spryker-academy/hello-world --all
```

### Switch Versions
```bash
# Move to next exercise
composer require spryker-academy/hello-world:2.0.0-skeleton

# Check solution
composer require spryker-academy/hello-world:2.0.0-complete

# Back to skeleton
composer require spryker-academy/hello-world:2.0.0-skeleton
```

---

## 📚 Next Steps

After completing the HelloWorld module, continue with:

**Supplier Module** - Learn intermediate and advanced Spryker concepts:
- Back Office CRUD operations
- Data Import from CSV
- Publish & Synchronize pattern
- Elasticsearch integration
- REST API with Glue
- Order Management System (OMS)

```bash
composer require spryker-academy/supplier:6.0.0-skeleton
```

---

## 🆘 Troubleshooting

### Issue: Transfer classes not found
**Solution:** Run `vendor/bin/console transfer:generate`

### Issue: Database table doesn't exist
**Solution:** Run `vendor/bin/console propel:install`

### Issue: 404 on Back Office URL
**Solution:** Clear cache with `vendor/bin/console cache:empty-all`

### Issue: Namespace not recognized
**Solution:** Ensure `SprykerAcademy` is added to `KernelConstants::CORE_NAMESPACES` in config

---

**Happy Learning! 🎓**
