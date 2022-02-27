# Laravel HATEOAS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gdebrauwer/laravel-hateoas.svg?style=flat-square)](https://packagist.org/packages/gdebrauwer/laravel-hateoas)
[![GitHub 'Run Tests' Workflow Status](https://img.shields.io/github/workflow/status/gdebrauwer/laravel-hateoas/run-tests?label=tests&style=flat-square&logo=github)](https://github.com/gdebrauwer/laravel-hateoas/actions?query=workflow%3Arun-tests)
[![Total Downloads](https://img.shields.io/packagist/dt/gdebrauwer/laravel-hateoas.svg?style=flat-square)](https://packagist.org/packages/gdebrauwer/laravel-hateoas)

[HATEOAS](https://en.wikipedia.org/wiki/HATEOAS) allows you to expose the authorization logic of your REST API.
This package makes it easy to add HATEOAS links to your Laravel API resources.

Each resource has its HATEOAS links, and only the accessible links per resource are returned.
If a link is not available on a resource, then the clients of your API can disable functionality linked to that HATEOAS link.

By default an array of links, in the following format, will be added to the JSON of a Laravel API resource:

```json
{
    "data": [
        {
            "id": 1,
            "text": "Hello world!",
            "_links": [
                {
                    "rel": "self",
                    "type": "GET",
                    "href": "http://localhost/message/1"
                },
                {
                    "rel": "delete",
                    "type": "DELETE",
                    "href": "http://localhost/message/1"
                }
            ]
        }
    ]
}
```


## Installation

You can install the package via composer:

```bash
composer require gdebrauwer/laravel-hateoas
```

## Usage

You can create a new HATEOAS class for a model using the following artisan command:

```bash
php artisan make:hateoas MessageHateoas --model=Message
```

In the created class you can define public methods that will be used to generate the links. A method should either return a link or `null`.

```php
class MessageHateoas
{
    use CreatesLinks;

    public function self(Message $message) : ?Link
    {
        if (! auth()->user()->can('view', $message)) {
            return;
        }

        return $this->link('message.show', ['message' => $message]);
    }

    public function delete(Message $message) : ?Link
    {
        if (! auth()->user()->can('delete', $message)) {
            return $this->link('message.archive', ['message' => $message]);
        }

        return $this->link('message.destroy', ['message' => $message]);
    }
}
```

To add the links to an API resource, you have to add the `HasLinks` trait and use the `$this->links()` method. The HATEOAS class will be automatically discovered.

```php
class MessageResource extends JsonResource
{
    use HasLinks;

    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            '_links' => $this->links(),
        ];
    }
}
```

## Customization

#### Formatting

You can customize the JSON links formatting by providing a formatter class that implements the `Formatter` interface to the `formatLinksUsing` method.
If the code to format the links is pretty small or you don't want to create a separate formatter class for it, you also have the option to provide a formatting callback function to the `formatLinksUsing` method.

```php
use GDebrauwer\Hateoas\Hateoas;
use GDebrauwer\Hateoas\LinkCollection;

// Provide your own Formatter class ...
Hateoas::formatLinksUsing(CustomFormatter::class);

// ... Or provide a callback
Hateoas::formatLinksUsing(function (LinkCollection $links) {
    // return array based on links
});
```

#### HATEOAS class discovery

By default, the HATEOAS classes of models will be auto-discovered. Specifically, the HATEOAS classes must be in a Hateoas directory below the directory that contains the models.
If you would like to provide your own HATEOAS class discovery logic, you can register a custom callback:

```php
use GDebrauwer\Hateoas\Hateoas;

Hateoas::guessHateoasClassNameUsing(function (string $class) {
    // return a HATEOAS class name
});
```

## Testing

```bash
composer test
```

## Linting

```bash
composer lint
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Günther Debrauwer](https://github.com/gdebrauwer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
