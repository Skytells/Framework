<?
Namespace Skytells\Core;
Class Resolver {

	/**
 	* Build an instance of the given class
	*
 	* @param string $class
 	* @return mixed
 	*
 	* @throws Exception
 	*/
	public function resolve($class)
	{
		$reflector = new \ReflectionClass($class);

		if( ! $reflector->isInstantiable())
 		{
 			throw new \Exception("[$class] is not instantiable");
 		}

 		$constructor = $reflector->getConstructor();

 		if(is_null($constructor))
 		{
 			return new $class;
 		}

 		$parameters = $constructor->getParameters();
 		$dependencies = $this->getDependencies($parameters);

 		return $reflector->newInstanceArgs($dependencies);
	}

	/**
	 * Build up a list of dependencies for a given methods parameters
	 *
	 * @param array $parameters
	 * @return array
	 */
	public function getDependencies($parameters)
	{
		$dependencies = array();

		foreach($parameters as $parameter)
		{
			$dependency = $parameter->getClass();

			if(is_null($dependency))
			{
				$dependencies[] = $this->resolveNonClass($parameter);
			}
			else
			{
				$dependencies[] = $this->resolve($dependency->name);
			}
		}

		return $dependencies;
	}

	/**
	 * Determine what to do with a non-class value
	 *
	 * @param ReflectionParameter $parameter
	 * @return mixed
	 *
	 * @throws Exception
	 */
	public function resolveNonClass(ReflectionParameter $parameter)
	{
		if($parameter->isDefaultValueAvailable())
		{
			return $parameter->getDefaultValue();
		}

		throw new Exception("Erm.. Cannot resolve the unkown!?");
	}
}
