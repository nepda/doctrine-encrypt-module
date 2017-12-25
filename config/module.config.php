<?php

namespace DoctrineEncryptModule;

return array(
    // Factory mappings - used to define which factory to use to instantiate a particular doctrine
    // service type
    'doctrine_factories' => array(
        'encryption' => Service\DoctrineEncryptionFactory::class,
    ),

    'doctrine' => array(
        'encryption' => array(
            'orm_default' => array(
                'adapter' => Encryptors\ZendBlockCipherAdapter::class,
                'reader' => \Doctrine\Common\Annotations\AnnotationReader::class,
            ),
        ),

        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    'doctrine.encryption.orm_default',
                ),
            ),
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            Encryptors\ZendBlockCipherAdapter::class => Factory\McryptAdapter::class,
        ),
    ),
);
