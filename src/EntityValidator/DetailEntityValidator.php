<?php
/**
 * Created by PhpStorm.
 * User: siim
 * Date: 8.02.19
 * Time: 8:31
 */

namespace Sf4\ApiUser\EntityValidator;

use Sf4\Api\Entity\EntityInterface;
use Sf4\Api\EntityValidator\AbstractEntityValidator;
use Sf4\ApiUser\Entity\UserDetailFieldInterface;
use Sf4\ApiUser\Entity\User;
use Sf4\ApiUser\Entity\UserDetailInterface;
use Sf4\ApiUser\Entity\UserFieldsInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class DetailEntityValidator extends AbstractEntityValidator implements UserFieldsInterface, UserDetailFieldInterface
{

    const MESSAGE_NOT_BLANK_EMAIL = 'user.detail.validate.not_blank.email';
    const MESSAGE_NOT_BLANK_STATUS = 'user.detail.validate.not_blank.status';
    const MESSAGE_NOT_BLANK_FIRST_NAME = 'user.detail.validate.not_blank.first_name';
    const MESSAGE_NOT_BLANK_LAST_NAME = 'user.detail.validate.not_blank.last_name';

    const MESSAGE_EMAIL_EMAIL = 'user.detail.validate.email.email';

    const MESSAGE_MIN_LENGTH_FIRST_NAME = 'user.detail.validate.min_length.first_name';
    const MESSAGE_MIN_LENGTH_LAST_NAME = 'user.detail.validate.min_length.last_name';

    const MESSAGE_REGEX_FIRST_NAME = 'user.detail.validate.regex.first_name';
    const MESSAGE_REGEX_LAST_NAME = 'user.detail.validate.regex.last_name';

    /**
     * @param EntityInterface $entity
     * @return array
     */
    protected function getValidationRules(EntityInterface $entity): array
    {
        $rules = [];

        if ($entity instanceof User) {
            $userRules = $this->getUserValidationRules($entity);
            $userDetail = $entity->getUserDetail();
            $rules = array_merge($rules, $userRules);
            if ($userDetail instanceof UserDetailInterface) {
                $userDetailRules = $this->getUserDetailValidationRules($userDetail);
                $rules = array_merge($rules, $userDetailRules);
            }
        }

        return $rules;
    }

    /**
     * @param User $user
     * @return array
     */
    protected function getUserValidationRules(User $user): array
    {
        return [
            static::FIELD_EMAIL => [
                static::VALUE => $user->getEmail(),
                static::CONSTRAINTS => [
                    new NotBlank([
                        static::OPTION_MESSAGE => $this->translate(
                            static::MESSAGE_NOT_BLANK_EMAIL
                        )
                    ]),
                    new Email([
                        static::OPTION_MESSAGE => $this->translate(
                            static::MESSAGE_EMAIL_EMAIL
                        )
                    ])
                ]
            ],
            static::FIELD_STATUS => [
                static::VALUE => $user->getStatus(),
                static::CONSTRAINTS => [
                    new NotBlank([
                        static::OPTION_MESSAGE => $this->translate(
                            static::MESSAGE_NOT_BLANK_STATUS
                        )
                    ])
                ]
            ]
        ];
    }

    /**
     * @param UserDetailInterface $userDetail
     * @return array
     */
    protected function getUserDetailValidationRules(UserDetailInterface $userDetail): array
    {
        return [
            static::FIELD_FIRST_NAME => [
                static::VALUE => $userDetail->getFirstName(),
                static::CONSTRAINTS => [
                    new NotBlank([
                        static::OPTION_MESSAGE => $this->translate(
                            static::MESSAGE_NOT_BLANK_FIRST_NAME
                        )
                    ]),
                    new Length([
                        static::MIN => 3,
                        static::OPTION_MIN_MESSAGE => $this->translate(
                            static::MESSAGE_MIN_LENGTH_FIRST_NAME
                        )
                    ]),
                    new Regex([
                        static::PATTERN => static::NAME_REGEX,
                        static::OPTION_MESSAGE => $this->translate(
                            static::MESSAGE_REGEX_FIRST_NAME
                        )
                    ])
                ]
            ],
            static::FIELD_LAST_NAME => [
                static::VALUE => $userDetail->getLastName(),
                static::CONSTRAINTS => [
                    new NotBlank([
                        static::OPTION_MESSAGE => $this->translate(
                            static::MESSAGE_NOT_BLANK_LAST_NAME
                        )
                    ]),
                    new Length([
                        static::MIN => 3,
                        static::OPTION_MIN_MESSAGE => $this->translate(
                            static::MESSAGE_MIN_LENGTH_LAST_NAME
                        )
                    ]),
                    new Regex([
                        static::PATTERN => static::NAME_REGEX,
                        static::OPTION_MESSAGE => $this->translate(
                            static::MESSAGE_REGEX_LAST_NAME
                        )
                    ])
                ]
            ]
        ];
    }
}
