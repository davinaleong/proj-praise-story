# Test Group Readme

This document outlines the purpose of each PHPUnit test group in the application to help contributors understand and maintain the test suite effectively.

| Name                    | Description                                                                                                           |
| ----------------------- | --------------------------------------------------------------------------------------------------------------------- |
| `admin`                 | Tests related to the admin domain, including routes, authorization, and access control.                               |
| `admin-login`           | Tests for the admin login Livewire component, including credential validation and redirection.                        |
| `admin-logout`          | Tests for the admin logout route/controller, ensuring session termination and redirection.                            |
| `auth`                  | General authentication-related tests and helpers. Alias for core auth features.                                       |
| `authentication`        | Specific tests for login and logout flows for regular users.                                                          |
| `contact`               | Tests for the contact form UI, validation, and submission behavior.                                                   |
| `dashboard`             | Tests for the user dashboard interface, widgets, and visibility of statistics after login.                            |
| `date-formatter`        | Unit tests for the `DateFormatter` helper, covering date formatting consistency and error handling.                   |
| `email-verification`    | Tests for verifying user emails after registration or profile updates.                                                |
| `feedback`              | Tests for the feedback form, including spam protection (honeypot), validation, and data persistence.                  |
| `feature`               | High-level feature tests that simulate full user interactions, often covering multiple components in a single flow.   |
| `has-uuid`              | Tests for the `HasUuid` trait to ensure automatic UUID assignment and correct behavior.                               |
| `helper`                | Tests for custom helper classes (e.g., formatters, utility functions).                                                |
| `index`                 | Feature tests for listing public testimonies and enforcing access control on testimony detail views.                  |
| `information`           | Tests for the Information page component showing testimony types and markdown formatting help.                        |
| `livewire`              | Tests for Livewire component rendering, mount behavior, lifecycle hooks, and interaction logic.                       |
| `me`                    | Tests for authenticated user views: listing testimonies, managing CRUD operations, and editing profile/settings.      |
| `message`               | Tests for the `Message` model, covering UUID handling, relationships (user, admin, context), and soft deletion logic. |
| `model`                 | General model-related tests that don’t fit under a specific domain model tag (e.g., admin or testimony).              |
| `password-confirmation` | Tests that ensure password confirmation is required for sensitive user actions.                                       |
| `password-reset`        | Tests for initiating and completing password reset flows, including email links and token validation.                 |
| `password-update`       | Tests for updating the authenticated user’s password (e.g., from settings or profile page).                           |
| `private`               | Tests for viewing private testimonies, ensuring proper access control for authenticated users.                        |
| `profile`               | Tests for viewing and updating user profile details, such as name and email.                                          |
| `public`                | Tests for displaying public testimonies and restricting access to unpublished content.                                |
| `published-testimony`   | Tests for displaying published testimonies (public/private) in a card layout for the user.                            |
| `registration`          | Tests for the user registration process, edge cases, and success/failure states.                                      |
| `setting`               | Tests for user preferences and global/system configuration options.                                                   |
| `status`                | Tests related to status management (draft, published, private), including transitions and enforcement.                |
| `terms-and-conditions`  | Tests for rendering the Terms and Conditions page for both guests and authenticated users.                            |
| `testimony`             | Model-level tests for the `Testimony` model, including relationships, UUID logic, and factory defaults.               |
| `testimony-crud`        | Feature tests for creating, viewing, editing, and deleting testimonies using Livewire components.                     |
| `trait`                 | Unit tests for shared model traits and their effects when applied to Eloquent models.                                 |
| `unit`                  | Pure unit tests targeting isolated logic, utility classes, or internal calculations without Laravel dependencies.     |
| `user`                  | Tests specific to the `User` model and its behavior, including relationships, UUID logic, and factories.              |
| `uuid`                  | Tests validating models using UUIDs for routing, lookup, and querying.                                                |
| `livewire`              |                                                                                                                       |
| `admin-dashboard`       |                                                                                                                       |
| `admin-user-index`      |                                                                                                                       |
| `admin-user-show`       |                                                                                                                       |

---

✅ Run specific groups using:

```bash
php artisan test --group=profile,setting
```

🧪 Use `@group name` annotations in your test classes/methods to assign them to these groups.

```

Let me know if you’d like these descriptions reused in code comments or auto-generated test documentation.
```
