# silverstripe-customizableinputfield

## Requirements
* Silverstripe 3.*

## Installation
### Composer
* `composer require "nblum/silverstripe-customizableinputfield"`

### Manual
* Download and copy module in SilverStripe root directory

## Usage
Example for (german) mobile phone numbers:
Creates a field like this: 

+49 (0) ___ / _________

```php
  //creates a new part
  $part1 = new CustomizableInputFieldPart();
  $part1->setBefore('+49 (0)');
  $part1->setAfter('/');
  $part1->setMaxLength(3);
  $field->addPart($part1);

  //creates a second part
  $part2 = new CustomizableInputFieldPart();
  $part2->setMaxLength(9);
  $field->addPart($part2);

  //adds the customized fieldset to the tab
  $fields->addFieldToTab('Root.Main', $field, 'Content');
```
