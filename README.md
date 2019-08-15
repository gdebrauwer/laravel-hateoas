# Laravel HATEOAS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gdebrauwer/laravel-hateoas.svg?style=flat-square)](https://packagist.org/packages/gdebrauwer/laravel-hateoas)
[![Build Status](https://img.shields.io/travis/gdebrauwer/laravel-hateoas/master.svg?style=flat-square)](https://travis-ci.org/gdebrauwer/laravel-hateoas)
[![Quality Score](https://img.shields.io/scrutinizer/g/gdebrauwer/laravel-hateoas.svg?style=flat-square)](https://scrutinizer-ci.com/g/gdebrauwer/laravel-hateoas)
[![Total Downloads](https://img.shields.io/packagist/dt/gdebrauwer/laravel-hateoas.svg?style=flat-square)](https://packagist.org/packages/gdebrauwer/laravel-hateoas)

> This package is a work in progress.

Do you want to easily expose your REST API authorization logic? HATEOAS is technique to expose that logic usings links. This package makes it very easy to add links to your API resources in Laravel.

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

    /**
     * Get the HATEOAS link to view the message.
     *
     * @param \App\Message $message
     *
     * @return mixed
     */
    public function self(Message $message)
    {
        if (! auth()->user()->can('view', $message)) {
            return;
        }

        return $this->link('message.show', ['message' => $message]);
    }

    /**
     * Get the HATEOAS link to delete the message.
     *
     * @param \App\Message $message
     *
     * @return mixed
     */
    public function delete(Message $message)
    {
        if (! auth()->user()->can('delete', $message)) {
            return $this->link('message.archive', ['message' => $message]);
        }

        return $this->link('message.destroy', ['message' => $message]);
    }
}
```

To add the links to an API resource, you have to add the `HasLinks` trait and use the `$this->links()` method.

```php
class MessageResource extends JsonResource
{
    use HasLinks;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            '_links' => $this->links(),
        ];
    }
}
```

This will result in the following JSON:

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


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Günther Debrauwer](https://github.com/gdebrauwer)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
