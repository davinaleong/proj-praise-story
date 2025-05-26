# Protect Premium

```php
@auth
    @if (auth()->user()->isPremium())
        <!-- Premium Content -->
    @else
        <!-- CTA to subscribe -->
    @endif
@endauth
```

## Features

-   Private testimonies
-   Bonus content from the creator
