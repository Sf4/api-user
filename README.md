# api-user

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]




## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practices by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require sf4/api-user
```

## Usage

config/packages/doctrine.yaml
``` yaml
doctrine:
    # ...
    orm:
        # ...
        mappings:
            # ...
            Sf4\ApiUser:
                is_bundle: false
                type: annotation
                dir: '%kernel.project_dir%/vendor/sf4/api-user/src/Entity'
                prefix: 'Sf4\ApiUser\Entity'
                alias: Sf4\ApiUser
```

config/routes.yaml
``` yaml
# ...
api_user:
    resource: '../vendor/sf4/api-user/src/Routes/api-user.yaml'
    prefix: /user
```

config/services.yaml
``` yaml
services:
    # ...
    
    Sf4\Api\Repository\RepositoryFactory:
        class: Sf4\Api\Repository\RepositoryFactory
        arguments:
            $entityManager: '@Doctrine\ORM\EntityManagerInterface'
            $entities:
                user: Sf4\ApiUser\Entity\User
                user_detail: Sf4\ApiUser\Entity\UserDetail

    # ...
    Sf4\Api\RequestHandler\RequestHandlerInterface:
        # ...
        -   method: setAvailableRoutes
            arguments:
                -   api_default: 'Sf4\Api\Request\DefaultRequest'
                    # ...
                    api_user_list: 'Sf4\ApiUser\Request\ListRequest'
                    api_user_detail: 'Sf4\ApiUser\Request\DetailRequest'
                    api_user_save_detail: 'Sf4\ApiUser\Request\SaveDetailRequest'
```

config/packages/translation.yaml
```
framework:
    # ...
    translator:
        # ...
        paths:
            # ...
            - '%kernel.project_dir%/vendor/sf4/api-user/src/translations'
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email siim.liimand@gmail.com instead of using the issue tracker.

## Credits

- [Siim Liimand][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sf4/api-user.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/sf4/api-user/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/sf4/api-user.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/sf4/api-user.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sf4/api-user.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/sf4/api-user
[link-travis]: https://travis-ci.org/sf4/api-user
[link-scrutinizer]: https://scrutinizer-ci.com/g/sf4/api-user/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/sf4/api-user
[link-downloads]: https://packagist.org/packages/sf4/api-user
[link-author]: https://github.com/siimliimand
