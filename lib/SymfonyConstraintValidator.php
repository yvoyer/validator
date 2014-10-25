<?php
/**
 * This file is part of the validator.local project.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\Validator;

use Star\Component\Validator\Handler\NotificationHandler;
use Star\Component\Validator\Message\StringMessage;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;

/**
 * Class SymfonyConstraintValidator
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\Validator
 */
class SymfonyConstraintValidator implements Validator
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var Constraint
     */
    private $constraint;

    /**
     * @var array
     */
    private $groups;

    /**
     * @param mixed $value
     * @param Constraint $constraint
     * @param array $groups
     */
    public function __construct($value, Constraint $constraint, array $groups = array())
    {
        $this->value = $value;
        $this->constraint = $constraint;
        $this->groups = $groups;
    }

    /**
     * @param NotificationHandler $handler
     */
    public function validate(NotificationHandler $handler)
    {
        $validator = Validation::createValidator();
        /**
         * @var ConstraintViolationInterface[] $violations
         */
        $violations = $validator->validateValue($this->value, $this->constraint, $this->groups);

        foreach ($violations as $violation) {
            $handler->notifyError(new StringMessage($violation->getMessage()));
        }
    }
}
 