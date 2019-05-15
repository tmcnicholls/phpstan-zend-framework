<?php
namespace PHPStan\Reflection\ZendMvc;

use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\Type;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\Php\PhpMethodReflection;

class PluginMethodReflection implements MethodReflection
{
    private $broker;
    private $name;
    private $className;
    private $returnType;

    public function __construct(
        $broker,
        $name,
        $className,
        $returnType
    ) {
        $this->broker = $broker;
        $this->name = $name;
        $this->className = $className;
        $this->returnType = $returnType;
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->broker->getClass($this->className);
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this;
    }

    public function isStatic(): bool
    {
        return false;
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isPublic(): bool
    {
        return true;
    }

    /**
     * @return \PHPStan\Reflection\ParameterReflection[]
     */
    public function getParameters(): array
    {
        return [];
    }

    public function isVariadic(): bool
    {
        return false;
    }

    public function getReturnType(): Type
    {
        return $this->returnType;
    }

    /**
     * @return \PHPStan\Reflection\ParametersAcceptor[]
     */
    public function getVariants(): array
    {
        return [
            new FunctionVariant($this->getParameters(), $this->isVariadic(), $this->getReturnType())
        ];
    }
}
