<?php

namespace DoctrineEncryptModule\Factory;

class McryptAdapter implements \Zend\ServiceManager\Factory\FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        if (empty($config['doctrine']['encryption']['key'])) {
            throw new \InvalidArgumentException('You need to define a non-empty key in doctrine.encryption.key config');
        }
        $key = $config['doctrine']['encryption']['key'];

        $salt = null;
        if (!empty($config['doctrine']['encryption']['salt'])) {
            $salt = $config['doctrine']['encryption']['salt'];
        }

        $cipher = \Zend\Crypt\BlockCipher::factory('mcrypt');
        $cipher->setKey($key);
        if ($salt) {
            $cipher->setSalt($salt);
        }
        return $cipher;
    }
}
