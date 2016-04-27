# Transphporm-XMarkDown-Module
An extension for Transphporm that uses XMarkDown to process markdown

## Purpose
It allows you to have stuff edited in markdown and added into a document easily through Transphporm.

## Setup
Simply include the files in the src folder or set it up with your autoloader to use
The extension depends on Level2\XMarkdown so you must ensure that the library is available
To extend Transphporm you must load the module
```php
$template = new \Transphporm\Builder("test.xml", "test.tss"); // Create tranphporm instance. It doesn't matter how

// Add on the module
$template->loadModule(new \TransphpormXMarkDown\Module);
```
