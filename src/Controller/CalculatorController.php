<?php

namespace App\Controller;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Exception\DivisionByZeroException;
use App\Calculator\Arithmetic\Operator\ArithmeticOperatorFactory;
use App\Calculator\CalculatorInterface;
use App\Calculator\Exception\InvalidOperandTypeException;
use App\Calculator\Operation\OperationInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Exception\InvalidNumberException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TypeError;

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

        } catch (TypeError $e) {
            return $this->showOperationForm();
        }

    }

    public function showOperationForm(): Response
    {
        return $this->render('calculator/calculator.html.twig', [
            'calc_operations_supported' => $this->calculator->getOperationsSupported()
        ]);
    }

    public
    function calc(Request $request): Response
    {
        $leftStr = $request->get('left','');
        $operatorStr = $request->get('operator','');
        $rightStr = $request->get('right','');

        if ($leftStr === '' || $operatorStr === '' || $rightStr === '') {
            return $this->showOperationForm();
        }

        try {

            $left = NumberOperand::createFromString($leftStr);
            $operator = ArithmeticOperatorFactory::createByOperationName($operatorStr);
            $right = NumberOperand::createFromString($rightStr);

            $result = $this->calculator->calculate($left, $operator, $right);

            return $this->showResult($result);

        } catch (TypeError|InvalidNumberException|InvalidOperandTypeException $e) {
            return $this->showError('Вы ввели некорректное число');
        } catch (DivisionByZeroException $e) {
            return $this->showError('Деление на 0');
        }

    }

    public function showResult(ResultInterface $result)
    {
        return $this->render('calculator/calculator.html.twig',
            [
                'calc_result' => $result,
                'calc_operations_supported' => $this->calculator->getOperationsSupported()
            ]
        );
    }

    public function showError(string $message): Response
    {
        return $this->render('calculator/calculator.html.twig',
            [
                'error_message' => $message,
                'calc_operations_supported' => $this->calculator->getOperationsSupported()
            ]
        );
    }
}
