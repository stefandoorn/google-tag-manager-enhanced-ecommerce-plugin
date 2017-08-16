# Google Tag Manager Enhanced Ecommerce plugin for Sylius 

[![License](https://img.shields.io/packagist/l/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin.svg)](https://packagist.org/packages/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin) [![Version](https://img.shields.io/packagist/v/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin.svg)](https://packagist.org/packages/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin) [![Build status on Linux](https://img.shields.io/travis/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin/master.svg)](http://travis-ci.org/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin) [![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin.svg)](https://scrutinizer-ci.com/g/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin/) [![Code Coverage](https://scrutinizer-ci.com/g/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/stefandoorn/google-tag-manager-enhanced-ecommerce-plugin/?branch=master)

Google Tag Manager Enhanced Ecommerce plugin for Sylius eCommerce Platform

## Installation

### 1. Composer

`composer require stefandoorn/google-tag-manager-enhanced-ecommerce-plugin`

### 2. Follow installation instructions of required sub bundle

https://github.com/stefandoorn/google-tag-manager-plugin

### 3. Load bundle

Add to the bundle list in `app/AppKernel.php`:

```php
new GtmEnhancedEcommercePlugin\GtmEnhancedEcommercePlugin(),
```

### 4. Adjust configurations

Configure the features you would like to use/not. Find a base configuration reference by running:

```
bin/console config:dump-reference GtmEnhancedEcommercePlugin
```

By default all features are enabled.

## Features

* `purchases`: Send purchases to GTM (https://developers.google.com/tag-manager/enhanced-ecommerce#purchases)
* `product_impressions`: Send impressions on product listings to GTM (https://developers.google.com/tag-manager/enhanced-ecommerce#product-impressions)
* `product_detail_impressions`: Send impression on product detail pages to GTM (https://developers.google.com/tag-manager/enhanced-ecommerce#details)

## Feature specifics

### Product Impressions

A 'productListType' variable is used to distinguish certain pages on which the products have been shown. The plugin currently does not know on which
taxon page the listing is shown, so it defaults to 'Category Product List'. Feel free to set your own naming in `window.productListType`.

@todo There is a PR submitted to Sylius to support reading the taxon name via an event, so we can implement this (https://github.com/Sylius/Sylius/pull/8405)
