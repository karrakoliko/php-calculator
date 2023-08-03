<?php

namespace App\Controller;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operator\ArithmeticOperatorFactory;
use App\Calculator\CalculatorInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Exception\InvalidNumberException;
use App\Number\Number;
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

    public
    function showOperationForm(): Response
    {
        return $this->render('calculator/calculator.html.twig');
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

            return $this->showResult($result);

        } catch (\TypeError|InvalidNumberException $e) {
            return $this->showError('Вы ввели некорректное число');
        }
        return $this->render('calculator/calculator.html.twig');

    }

    public function showResult(ResultInterface $result)
    {
        return $this->render('calculator/calculator.html.twig',
            [
                'calc_result' => $result
            ]
        );
    }

    public function showError(string $message): Response
    {
        return $this->render('calculator/calculator.html.twig',
            [
                'error_message' => $message
            ]
        );
    }
}
