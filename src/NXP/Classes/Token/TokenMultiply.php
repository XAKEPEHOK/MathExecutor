<?php
/**
* This file is part of the MathExecutor package
*
* (c) Alexander Kiryukhin
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code
*/

namespace NXP\Classes\Token;

use NXP\Exception\IncorrectExpressionException;

/**
* @author Alexander Kiryukhin <alexander@symdev.org>
*/
class TokenMultiply extends AbstractOperator
{
    /**
     * @return string
     */
    public static function getRegex()
    {
        return '\*';
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return 2;
    }

    /**
     * @return string
     */
    public function getAssociation()
    {
        return self::LEFT_ASSOC;
    }

    /**
     * @param InterfaceToken[] $stack
     *
     * @return $this
     *
     * @throws \NXP\Exception\IncorrectExpressionException
     */
    public function execute(&$stack)
    {
        $op2 = array_pop($stack);
        $op1 = array_pop($stack);

        if ($op1 === null || $op2 === null) {
            throw new IncorrectExpressionException("Multiplication requires two operators");
        }

        $result = $op1->getValue() * $op2->getValue();

        return new TokenNumber($result);
    }
}
