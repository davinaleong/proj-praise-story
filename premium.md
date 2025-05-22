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
