<?php

namespace App\Controller;

use App\Calculator\Arithmetic\Expression\ArithmeticExpression;
use App\Calculator\Arithmetic\Expression\EqualityExpression;
use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operator\ArithmeticOperatorFactory;
use App\Calculator\CalculatorInterface;
use App\Calculator\Operation\OperationInterface;
use App\Calculator\Operator\OperatorInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Exception\InvalidNumberException;
use App\Number\Number;
use App\Number\NumberInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CalculatorController extends AbstractController
{

    private CalculatorInterface $calculator;

    public function __construct(CalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    public function index(Request $request): Response
    {
        if (!$request->isMethod('POST')) {
            return $this->showOperationForm();
        }

        try {
            return $this->calc($request);

        } catch (\TypeError $e) {
            return $this->showOperationForm();
        }

    }

    public function showError(string $message): Response
    {
        return $this->render('calculator/calculator.html.twig',
            [
                'error_message' => $message
            ]
        );
    }

    public
    function showOperationForm(): Response
    {
        return $this->render('calculator/calculator.html.twig');
    }

    public function showResult(OperationInterface $operation, ResultInterface $result)
    {

    }

    public
    function calc(Request $request): Response
    {
        $leftStr = $request->get('left');
        $operatorStr = $request->get('operator');
        $rightStr = $request->get('right');

        try {

            $left = new NumberOperand(Number::createFromString($leftStr));
            $operator = ArithmeticOperatorFactory::createByName($operatorStr);
            $right = new NumberOperand(Number::createFromString($rightStr));

            $result = $this->calculator->calculate($left, $operator, $right);

        } catch (\TypeError|InvalidNumberException $e) {
            return $this->showError('Вы ввели некорректное число');
        }

        return $this->render('calculator/calculator.html.twig');

    }
}
