<?php

namespace App\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\Expression\ArithmeticExpression;
use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operator\ArithmeticOperatorAbstract;
use App\Calculator\Expression\Exception\UnableToBuildExpression;
use App\Calculator\Expression\ExpressionInterface;
use App\Calculator\Operation\OperationInterface;

abstract class MathOperationAbstract implements OperationInterface
{
    /**
     * @var NumberOperand[]
     */
    protected array $operands = [];

    public function toExpression(): ExpressionInterface
    {
        $expression = new ArithmeticExpression();
        /** @var ArithmeticOperatorAbstract $operator */
        $operator = $this->getOperator();

        $operandsCnt = count($this->operands);
        if ($operandsCnt < 2) {
            throw new UnableToBuildExpression(sprintf('Minimum 2 operands required to build expression, %s given', $operandsCnt));
        }

        $keyLast = array_key_last($this->operands);

        foreach ($this->getOperands() as $key => $operand) {

            $expression->addMember($operand->getValue());

            if($key !== $keyLast){
                $expression->addMember($operator->getSign());
            }

        }

        return $expression;
    }

    /**
     * @return NumberOperand[]
     */
    public function getOperands(): array
    {
        return $this->operands;
    }


}