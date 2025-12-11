# Unpoly demo app, ported to Laravel

This is a demo of [Unpoly](https://unpoly.com), a JavaScript library for progressive enhancement of web applications. This demo is a clone of the original Unpoly demo (see [https://demo.unpoly.com/](https://demo.unpoly.com/)), written in Laravel (PHP) instead of Ruby. It is not publically deployed anywhere, but you can clone it, install it and investigate it.

## Installation / running

```bash
# Clone the demo
git clone https://github.com/adamkiss/unpoly-demo-laravel.git unpoly-demo-laravel
cd unpoly-demo-laravel

# Install dependencies
composer install -no
pnpm i

# Run the vite dev server
./task
# Or just build the css/js
./task prod
```

## Known Issues

- When creating a new company during creation of a project, the company select isn't updated with just the company you've just created
- From time to time, `#index-placeholder` is reported missing 🤷🏻‍♂️
