# Changelog

All notable changes to `laravel-customer-io` will be documented in this file.

## 1.1.5 - 2021-02-15

* Default model in config file is now `App\Models\User`, instead of `App\Users`

## 1.1.4 - 2020-11-19

* Fixed issue where you'd sometimes get Serialization of 'Closure' is not allowed when saving model data.

## 1.1.3 - 2020-10-29

* Updated `printu/customerio`, should also fix any Guzzle dependency issues when updating to Laravel 8.

## 1.1.2 - 2020-09-09

* Added support for Laravel 8

## 1.1.1 - 2020-08-17

* Added `optional()` to timestamps to fix issues when they're not available.

## 1.1.0 - 2020-08-03

* Added config for customer.io model
* Added sync customers command

## 1.0.0 - 2020-07-15

* initial release
