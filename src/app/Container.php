<?php

namespace App;

use App\Exceptions\Container\ContainerException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use \Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $entries = [];
    /**
     * @inheritDoc
     */
    public function get(string $id)
    {
        if($this->has($id)){
            $entry = $this->entries[$id];
            if(is_callable($entry)){
                return $entry($this);
            }
            $id = $entry;
        }

        //throw new NotFoundException('Not found entry for '. $id . 'in the container!');
        return $this->resolve($id);

    }

    /**
     * @inheritDoc
     */
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete)
    {
        if(! $this->has($id)){
            $this->entries[$id] = $concrete;
        }
    }

    public function resolve(string $id)
    {
        //1- Get the class we are trying to resolve
        $reflectorClass = new \ReflectionClass($id);

        if(! $reflectorClass->isInstantiable()){
            throw new ContainerException(
                "Not able to resolve the " . $id . "class out of the container as it is not instanciable!"
            );
        }

        //2- Get the constructor
        $constructor = $reflectorClass->getConstructor();

        if(! $constructor){
            return new $id;
        }

        //3- Get the parameters
        $parameters = $constructor->getParameters();
        if(empty($parameters)){
            return new $id;
        }

        $dependencies = array_map(function (\ReflectionParameter $parameter) use($id){
            $name = $parameter->getName();
            $type = $parameter->getType();

            if($type instanceof \ReflectionUnionType){
                throw new ContainerException(
                   "Unable to resolve the class instances for ". $id . "as Union types is not supported!"
                );
            }

            if(! $type){
                throw new ContainerException(
                    "Unable to resolve the class instance as it is not typed hinted"
                );
            }

            if($type instanceof \ReflectionNamedType && ! $type->isBuiltin()){
                return $this->get($type);
            }

        }, $parameters);



        //3- Get the instance.
        return $reflectorClass->newInstanceArgs($dependencies);
    }
}