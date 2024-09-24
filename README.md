
# Profanity Filter

A flexible PHP profanity filter that allows you to set custom bad words, replacement characters, and exclusion lists.

## Installation

You can install the package via Composer:

```
composer require lakshanjs/profanity-filter
```

## Usage

```php
require 'vendor/autoload.php';

use LakshanJS\ProfanityFilter\ProfanityFilter;

$filter = new ProfanityFilter();
$filter->setBadWords(['badword1', 'badword2']);
$filter->setReplacementChar('*');
$filteredMessage = $filter->censor("This is a badword1");
echo $filteredMessage; // Output: This is a ******
```
