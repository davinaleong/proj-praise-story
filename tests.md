# Test Group Readme

This document outlines the purpose of each PHPUnit test group in the application to help contributors understand and maintain the test suite effectively.

| Name                    | Description                                                                                                                                                        |
| ----------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `auth`                  | General authentication-related tests (alias for core auth features).                                                                                               |
| `authentication`        | Specific tests for login and logout functionality.                                                                                                                 |
| `contact`               | Tests for contact form display, validation, and submission flow.                                                                                                   |
| `dashboard`             | Tests for dashboard views, widgets, or summary statistics visible post-login.                                                                                      |
| `date-formatter`        | Unit tests for the `DateFormatter` helper, covering format consistency, input types, and error handling.                                                           |
| `email-verification`    | Tests for verifying user emails after registration or profile changes.                                                                                             |
| `feature`               | Feature tests covering full workflows, often hitting multiple components.                                                                                          |
| `feedback`              | Tests for feedback form UI, submission validation, spam protection (honeypot), and persistence.                                                                    |
| `has-uuid`              | Tests for the `HasUuid` trait to verify UUID auto-generation and preservation logic on model creation.                                                             |
| `helper`                | Tests for custom helper classes or utility functions (e.g., string formatters, converters).                                                                        |
| `index`                 | Feature tests for listing public testimonies and enforcing access control on testimony detail views.                                                               |
| `information`           | Tests for the Information page component showing testimony types and markdown guide.                                                                               |
| `livewire`              | Tests related to Livewire component rendering, mount logic, and interactions.                                                                                      |
| `me`                    | Covers authenticated user functionality, including listing/viewing their non-draft testimonies, managing testimony CRUD operations, and updating profile settings. |
| `password-confirmation` | Tests that ensure password confirmation is required for sensitive actions.                                                                                         |
| `password-reset`        | Tests for initiating and completing password reset flows.                                                                                                          |
| `password-update`       | Tests for updating the current user’s password (e.g., from profile settings).                                                                                      |
| `private`               | Tests for viewing private testimonies. Ensures proper access control and rendering for authenticated users only.                                                   |
| `profile`               | Tests for viewing and updating user profile details.                                                                                                               |
| `public`                | Tests for displaying public testimonies and preventing access to non-public ones.                                                                                  |
| `published-testimony`   | Tests for showing the user’s published testimonies (public, private, and published statuses) in a card layout.                                                     |
| `registration`          | Tests for new user registration processes and edge cases.                                                                                                          |
| `setting`               | Tests for user-defined settings or system configuration options.                                                                                                   |
| `status`                | Tests related to content status logic such as draft, private, and public states.                                                                                   |
| `terms-and-conditions`  | Tests for public and authenticated views of the Terms and Conditions page.                                                                                         |
| `testimony`             | Tests for Testimony model behavior, relationships, UUID logic, and factory defaults.                                                                               |
| `testimony-crud`        | Tests for creating, viewing, editing, updating, and deleting testimonies via the Livewire components.                                                              |
| `trait`                 | Unit tests for reusable model traits, ensuring correct behavior when applied to Eloquent models.                                                                   |
| `unit`                  | Unit tests for isolated classes, methods, or logic without framework dependencies.                                                                                 |

---

✅ Run specific groups using:

```bash
php artisan test --group=profile,setting
```

🧪 Use `@group name` annotations in your test classes/methods to assign them to these groups.

```

Let me know if you’d like these descriptions reused in code comments or auto-generated test documentation.
```
