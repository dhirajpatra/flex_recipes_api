<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'routing.loader.annotation' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/LoaderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/AnnotationClassLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Routing/AnnotatedRouteControllerLoader.php';

return $this->privates['routing.loader.annotation'] = new \Symfony\Bundle\FrameworkBundle\Routing\AnnotatedRouteControllerLoader(($this->privates['annotations.reader'] ?? $this->getAnnotations_ReaderService()));
