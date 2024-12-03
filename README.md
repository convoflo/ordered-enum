# PHP Ordered Enum

This package gives your enums an order. It provides helper utilities such as `->greaterThan()`, `->lessThan()`, `::min()`, `::max()` and more.

## Installation

You can install the package via composer:

```bash
composer require convoflo/ordered-enum
```

## Usage

This is how an ordered enum can be defined.

```php
use \Convoflo\OrderedEnum\OrderedBackedEnum;
use \Convoflo\OrderedEnum\OrderedTrait;

enum UserRole: string implements OrderedBackedEnum
{
    use OrderedTrait;

    case Admin = 'admin';
    case Regular = 'user';
    case Basic = 'basic';

    public static function order(): array
    {
        return [self::Basic, self::Regular, self::Admin];
    }
}
```

Here's how ordered enums are used with their helpers:

```php
$showAdminConsole = $userRole->greaterThan(UserRole::Regular);
$showMinimalInterface = $userRole->lessThan(UserRole::Regular);

$isNotBasic = $userRole->greaterThanOrEqualsTo(UserRole::Regular);
$isNotAdmin = $userRole->lessThanOrEqualsTo(UserRole::Regular);

UserRole::min(UserRole::Basic, UserRole::Admin); // UserRole::Basic
UserRole::max(UserRole::Basic, UserRole::Admin); // UserRole::Admin

$highestRole = UserRole::max(); // UserRole::Admin
$lowestRole = UserRole::min(); // UserRole::Basic
```


## Credits

- [Alex Demers](https://github.com/alexdemers)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
