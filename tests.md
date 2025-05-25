# Test Group Readme

This document outlines the purpose of each PHPUnit test group in the application to help contributors understand and maintain the test suite effectively.

| Name                    | Description                                                                                                                                                                    |
| ----------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `auth`                  | General authentication-related tests (alias for core auth features).                                                                                                           |
| `authentication`        | Specific tests for login and logout functionality.                                                                                                                             |
| `dashboard`             | Tests for dashboard views, widgets, or summary statistics visible post-login.                                                                                                  |
| `date-formatter`        | Unit tests for the `DateFormatter` helper, covering format consistency, input types, and error handling.                                                                       |
| `email-verification`    | Tests for verifying user emails after registration or profile changes.                                                                                                         |
| `feature`               | Feature tests covering full workflows, often hitting multiple components.                                                                                                      |
| `has-uuid`              | Tests for the `HasUuid` trait to verify UUID auto-generation and preservation logic on model creation.                                                                         |
| `helper`                | Tests for custom helper classes or utility functions (e.g., string formatters, converters).                                                                                    |
| `index`                 | Feature tests for listing public testimonies and enforcing access control on testimony detail views.                                                                           |
| `me`                    | Covers authenticated user functionality, including listing/viewing their non-draft testimonies, managing testimony CRUD operations, and updating profile settings.             |
| `password-confirmation` | Tests that ensure password confirmation is required for sensitive actions.                                                                                                     |
| `password-reset`        | Tests for initiating and completing password reset flows.                                                                                                                      |
| `password-update`       | Tests for updating the current user’s password (e.g., from profile settings).                                                                                                  |
| `profile`               | Tests for viewing and updating user profile details.                                                                                                                           |
| `private`               | Tests the PrivateTestimonyController to ensure only authenticated users can view all public and private testimonies, and only view specific testimonies if they are the owner. |
| `registration`          | Tests for new user registration processes and edge cases.                                                                                                                      |
| `setting`               | Tests for user-defined settings or system configuration options.                                                                                                               |
| `status`                | Tests related to content status logic such as draft, private, and public states.                                                                                               |
| `trait`                 | Unit tests for reusable model traits, ensuring correct behavior when applied to Eloquent models.                                                                               |
| `unit`                  | Unit tests for isolated classes, methods, or logic without framework dependencies.                                                                                             |
| `terms-and-conditions`  |                                                                                                                                                                                |
| `livewire`              |                                                                                                                                                                                |
| `contact`               |                                                                                                                                                                                |
| `feedback`              |                                                                                                                                                                                |
| `testimony`             |                                                                                                                                                                                |
| `public`                |                                                                                                                                                                                |

---

✅ Run specific groups using:

```bash
php artisan test --group=profile,setting
```

🧪 Use `@group name` annotations in your test classes/methods to assign them to these groups.

```

Let me know if you’d like these descriptions reused in code comments or auto-generated test documentation.
```
