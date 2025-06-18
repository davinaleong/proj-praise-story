# Test Group Readme

This document outlines the purpose of each PHPUnit test group in the application to help contributors understand and maintain the test suite effectively.

### ✅ **Authentication and Authorization**

| Name                    | Description                                                                                  |
| ----------------------- | -------------------------------------------------------------------------------------------- |
| `auth`                  | Core authentication-related tests and helpers, covering middleware and guards.               |
| `authentication`        | Tests for regular user login/logout flows, including session handling and credential checks. |
| `registration`          | Tests for the user registration process and validation flow.                                 |
| `password-reset`        | Tests for initiating and completing the password reset process using email tokens.           |
| `password-confirmation` | Tests ensuring sensitive actions require password confirmation from authenticated users.     |
| `password-update`       | Tests for changing passwords from profile or settings pages.                                 |
| `email-verification`    | Tests for verifying user email addresses post-registration or update.                        |

---

### ✅ **Admin Domain**

| Name                            | Description                                                                             |
| ------------------------------- | --------------------------------------------------------------------------------------- |
| `admin`                         | Parent tag for all admin-related routes, policies, and domain-specific test coverage.   |
| `admin-login`                   | Tests for admin login Livewire component, including validation and redirection.         |
| `admin-logout`                  | Tests for logout route/controller to ensure session and guard cleanup.                  |
| `admin-dashboard`               | Tests for the admin dashboard's summary widgets and data visibility.                    |
| `admin-user`                    | High-level group for tests managing users in the admin panel.                           |
| `admin-user-index`              | Tests for the user listing component in admin, including filters and pagination.        |
| `admin-user-show`               | Tests for viewing a single user's profile in the admin panel.                           |
| `admin-user-reset-password`     | Tests for sending password reset links to users from admin interface.                   |
| `admin-user-email-verification` | Tests for sending email verification requests to users from the admin panel.            |
| `admin-user-testimony`          | Tests related to managing a user’s testimonies in the admin panel.                      |
| `admin-user-testimony-index`    | Tests for listing all testimonies submitted by a user in the admin panel.               |
| `admin-testimony`               | General tests for testimony resources in admin.                                         |
| `admin-testimony-index`         | Tests for the testimony index view in the admin, filtering by status or visibility.     |
| `admin-message`                 | Tests for admin messages sent to users, including relationships and content validation. |
| `admin-message-index`           | Tests for the message listing component for admins.                                     |
| `admin-message-create`          | Tests for composing and submitting a message to a user from the admin interface.        |
| `admin-contact-index`           | Tests for listing contact form messages in the admin dashboard.                         |
| `admin-contact-show`            | Tests for viewing a specific contact message and responding if needed.                  |
| `admin-feedback-index`          | Tests for listing user feedback submissions in the admin view.                          |
| `admin-feedback-show`           | Tests for showing detailed feedback submitted by a user.                                |
| `special-content`               | Parent tag for tests covering special content features available to admins.             |
| `special-content-group`         | Tests for managing content groups for special content modules (e.g., sorting, titles).  |
| `special-content-item`          | Tests for individual content items within a group, including type, media, and linking.  |

---

### ✅ **User Domain**

| Name        | Description                                                                                |
| ----------- | ------------------------------------------------------------------------------------------ |
| `me`        | Tests for the authenticated user panel (me/), including testimony management and settings. |
| `profile`   | Tests for updating and displaying user profile details.                                    |
| `setting`   | Tests for personal preferences and configurable settings like notifications or visibility. |
| `dashboard` | Tests for the user dashboard widgets, summaries, and data visibility after login.          |

---

### ✅ **Testimony & Message System**

| Name                  | Description                                                                                    |
| --------------------- | ---------------------------------------------------------------------------------------------- |
| `testimony`           | Unit tests for the `Testimony` model and its logic, including relationships and UUID behavior. |
| `testimony-crud`      | Full flow tests for creating, editing, updating, and deleting testimonies.                     |
| `published-testimony` | Tests for displaying testimonies in cards (both public and private) with correct formatting.   |
| `public`              | Tests for viewing publicly available testimonies and ensuring private content is restricted.   |
| `private`             | Tests for accessing private testimonies, enforcing proper user authentication and ownership.   |
| `index`               | Tests for the general listing of testimonies and individual view enforcement.                  |
| `message`             | Model-level tests for the `Message` class, covering context types and notification logic.      |

---

### ✅ **Static Pages & Forms**

| Name                   | Description                                                                                 |
| ---------------------- | ------------------------------------------------------------------------------------------- |
| `contact`              | Tests for public-facing contact form: UI validation, form logic, and delivery checks.       |
| `feedback`             | Tests for feedback submission, spam prevention via honeypot, and backend persistence.       |
| `terms-and-conditions` | Tests for rendering and accessibility of terms and conditions page for both guest and user. |
| `information`          | Tests for the info/help pages, including markdown rendering and dynamic instructions.       |

---

### ✅ **Utilities, Traits, and Helpers**

| Name             | Description                                                                                    |
| ---------------- | ---------------------------------------------------------------------------------------------- |
| `date-formatter` | Unit tests for date formatting utilities, handling edge cases, locale, and display formatting. |
| `helper`         | General tests for custom-built utility functions used throughout the application.              |
| `has-uuid`       | Tests for the `HasUuid` trait, validating automatic UUID generation and lookup behavior.       |
| `trait`          | Unit tests for shared traits applied to Eloquent models, verifying expected behavior.          |
| `uuid`           | Tests for routing, querying, and resolving models by UUID across the application.              |

---

### ✅ **Testing Method Types**

| Name       | Description                                                                                         |
| ---------- | --------------------------------------------------------------------------------------------------- |
| `feature`  | High-level tests simulating complete user or admin flows with HTTP, session, and view assertions.   |
| `unit`     | Purely isolated logic tests without Laravel dependencies (e.g., services, helpers, transformers).   |
| `model`    | Tests for Eloquent models not tied to a specific domain like user/testimony (e.g., pivot behavior). |
| `livewire` | Tests focused on Livewire components: rendering, lifecycle, and UI interaction logic.               |

---

### **New**

| Name                           | Description |
| ------------------------------ | ----------- |
| `special-content-group-index`  |             |
| `special-content-group-create` |             |
| `special-content-group-show`   |             |
| `special-content-group-edit`   |             |
| `special-content-item-index`   |             |
| `special-content-item-create`  |             |
| `special-content-item-show`    |             |
| `special-content-item-edit`    |             |

---

✅ Run specific groups using:

```bash
php artisan test --group=profile,setting
```

🧪 Use `@group name` annotations in your test classes/methods to assign them to these groups.

```

Let me know if you’d like these descriptions reused in code comments or auto-generated test documentation.
```
